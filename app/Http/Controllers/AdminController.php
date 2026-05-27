<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Pengguna Aktif (Online in the last 15 minutes)
        $activeUsers = DB::table('sessions')
            ->whereNotNull('user_id')
            ->where('last_activity', '>=', time() - 900)
            ->distinct('user_id')
            ->count('user_id');

        // Proyek Aktif
        $activeProjects = Project::where('status_proyek', 'open')->count();

        // Total Pengguna
        $totalUsers = User::count();

        // Chart Data: Projects created per month for the current year
        $projectsPerMonth = Project::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartLabels = [];
        $chartData = [];
        
        // Initialize all 12 months with 0
        for ($i = 1; $i <= 12; $i++) {
            $monthName = Carbon::create()->month($i)->translatedFormat('F');
            $chartLabels[] = $monthName;
            $chartData[$i] = 0;
        }

        foreach ($projectsPerMonth as $data) {
            $chartData[$data->month] = $data->count;
        }

        $chartDataValues = array_values($chartData);

        return view('admin.dashboardAdmin', compact(
            'activeUsers',
            'activeProjects',
            'totalUsers',
            'chartLabels',
            'chartDataValues'
        ));
    }

    public function pengguna(Request $request)
    {
        $query = $request->input('q', '');

        $penggunaList = User::where('role', '!=', 'admin') // Opsional: sembunyikan admin lain dari daftar
            ->when($query, function ($q) use ($query) {
                $q->where(function ($inner) use ($query) {
                    $inner->where('name', 'like', "%{$query}%")
                          ->orWhere('email', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.manajemenPengguna', compact('penggunaList', 'query'));
    }

    public function searchUsersApi(Request $request)
    {
        $query = $request->input('q', '');

        $penggunaList = User::where('role', '!=', 'admin')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($inner) use ($query) {
                    $inner->where('name', 'like', "%{$query}%")
                          ->orWhere('email', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->paginate(10);

        $data = $penggunaList->map(function($user) {
            $foto = $user->foto_profil_url ?? '/assets/pfp.png';
            $isSuspended = $user->suspended_until && $user->suspended_until > now();
            $sisaHari = $isSuspended ? round(now()->diffInDays($user->suspended_until)) : 0;
            
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'foto' => $foto,
                'isSuspended' => $isSuspended,
                'sisaHari' => $sisaHari,
                'toggleUrl' => route('admin.pengguna.toggle', $user->id)
            ];
        });

        return response()->json([
            'data' => $data,
            'total' => $penggunaList->total(),
            'query' => $query,
            'has_pages' => $penggunaList->hasPages(),
            'links' => (string) $penggunaList->links()
        ]);
    }

    public function toggleUserStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Jika user sedang disuspend (dan suspended_until lebih dari waktu sekarang), kita aktifkan lagi
        if ($user->suspended_until && $user->suspended_until > now()) {
            $user->suspended_until = null;
            $user->save();
            return back()->with('success', 'Pengguna berhasil diaktifkan kembali.');
        } 
        
        // Jika user aktif, kita suspend selama 30 hari
        $user->suspended_until = now()->addDays(30);
        $user->save();
        
        return back()->with('success', 'Pengguna berhasil dinonaktifkan selama 30 hari.');
    }
}

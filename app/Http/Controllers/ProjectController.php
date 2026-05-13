<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectApplication;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function indexDikelola()
    {
        $projects = Project::with('roles')->where('user_id', Auth::id())->latest()->get();
        return view('projects.proyekSaya', compact('projects'));
    }

    public function cariProyek(Request $request)
    {
        $query = $request->input('q', '');

        $projects = Project::with(['roles', 'owner'])
            ->where('status_proyek', 'open')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($inner) use ($query) {
                    $inner->where('nama_proyek', 'like', "%{$query}%")
                          ->orWhere('deskripsi', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('projects.cariProyek', compact('projects', 'query'));
    }


    public function dashboardDikelola()
    {
        $projects = Project::where('user_id', Auth::id())
            ->latest()
            ->take(3)
            ->get();

        $notifications = Notification::where('user_id', Auth::id())
            ->where('status_baca', false)
            ->latest()
            ->take(5)
            ->get();

        $recommendations = Project::with(['roles', 'owner'])
            ->where('status_proyek', 'open')
            ->where('user_id', '!=', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('projects.dikelola', compact('projects', 'notifications', 'recommendations'));
    }

    public function dashboardDiikuti()
    {
        $applications = ProjectApplication::with(['project.owner', 'project.roles'])
            ->where('user_id', Auth::id())
            ->latest()
            ->take(3)
            ->get();

        $notifications = Notification::where('user_id', Auth::id())
            ->where('status_baca', false)
            ->latest()
            ->take(5)
            ->get();

        $recommendations = Project::with(['roles', 'owner'])
            ->where('status_proyek', 'open')
            ->where('user_id', '!=', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('projects.diikuti', compact('applications', 'notifications', 'recommendations'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:200',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'project_field' => 'nullable|string',
            'description' => 'required|string',
            'roles' => 'required|array|min:1',
            'roles.*.name' => 'required|string',
            'roles.*.count' => 'required|integer|min:1',
            'questions' => 'nullable|array',
            'accepted_info' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $project = Project::create([
                    'user_id'           => Auth::id(),
                    'nama_proyek'       => $request->project_name,
                    'deskripsi'         => $request->description,
                    'status_proyek'     => 'open',
                    'periode_awal'      => $request->periode_awal,
                    'periode_akhir'     => $request->periode_akhir,
                    'bidang'            => is_string($request->project_field)
                                            ? json_decode($request->project_field, true)
                                            : $request->project_field,
                    'pertanyaan'        => $request->questions ?? [],
                    'informasi_pelamar' => $request->accepted_info,
                ]);

                foreach ($request->roles as $roleData) {
                    Role::create([
                        'project_id' => $project->project_id,
                        'nama_peran' => $roleData['name'],
                        'jumlah_dibutuhkan' => $roleData['count'],
                    ]);
                }
            });

            return redirect()->route('dashboard.dikelola')->with('success', 'Proyek berhasil dipublikasikan!');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal membuat proyek: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $project = Project::with(['roles', 'applications.user', 'applications.role'])->findOrFail($id);

        if ($project->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        return view('projects.proyekDikelola', compact('project'));
    }

    public function detailProyek($id)
    {
        $project = Project::with(['roles', 'owner'])->findOrFail($id);
        return view('projects.detailProyek', compact('project'));
    }

    public function createLamaran($id)
    {
        $project = Project::with('roles')->findOrFail($id);
        
        // Cek jika user memilikinya (tidak boleh melamar proyek sendiri)
        if ($project->user_id === Auth::id()) {
            return redirect()->route('detailProyek', $id)->with('error', 'Anda tidak bisa melamar proyek Anda sendiri.');
        }

        return view('projects.lamarProyek', compact('project'));
    }

    public function storeLamaran(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,roles_id',
            'jawaban' => 'nullable|array',
        ]);

        $project = Project::findOrFail($id);

        if ($project->user_id === Auth::id()) {
            return redirect()->route('detailProyek', $id)->with('error', 'Anda tidak bisa melamar proyek Anda sendiri.');
        }

        // Cek apakah sudah pernah melamar role ini
        $existing = ProjectApplication::where('user_id', Auth::id())
            ->where('project_id', $project->project_id)
            ->where('roles_id', $request->role_id)
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah melamar posisi ini di proyek ini.');
        }

        ProjectApplication::create([
            'user_id' => Auth::id(),
            'project_id' => $project->project_id,
            'roles_id' => $request->role_id,
            'status_lamaran' => 'pending',
            'jawaban_pertanyaan' => $request->jawaban ?? [],
        ]);

        return redirect()->route('lamaranSaya')->with('success', 'Lamaran berhasil dikirim!');
    }

    public function edit($id)
    {
        $project = Project::with('roles')->findOrFail($id);

        if ($project->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('projects.editProyek', compact('project'));
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'project_name' => 'required|string|max:200',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'project_field' => 'nullable|array',
            'description' => 'required|string',
            'accepted_info' => 'nullable|string',
            'roles' => 'required|array|min:1',
            'roles.*.id' => 'nullable|exists:roles,roles_id',
            'roles.*.name' => 'required|string',
            'roles.*.count' => 'required|integer|min:1',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $project = Project::findOrFail($id);
                
                if ($project->user_id !== Auth::id()) {
                    abort(403, 'Anda tidak memiliki hak akses untuk mengedit proyek ini.');
                }

                $project->update([
                    'nama_proyek' => $request->project_name,
                    'deskripsi' => $request->description,
                    'periode_awal' => $request->periode_awal,
                    'periode_akhir' => $request->periode_akhir,
                    'bidang' => is_string($request->project_field)
                                ? json_decode($request->project_field, true)
                                : $request->project_field,
                    'pertanyaan' => $request->questions ?? [],
                    'informasi_pelamar' => $request->accepted_info,
                ]);

                $incomingRoleIds = collect($request->roles)->pluck('id')->filter()->toArray();
                $project->roles()->whereNotIn('roles_id', $incomingRoleIds)->delete();

                foreach ($request->roles as $roleData) {
                    Role::updateOrCreate(
                        ['roles_id' => $roleData['id'], 'project_id' => $project->project_id],
                        [
                            'nama_peran' => $roleData['name'],
                            'jumlah_dibutuhkan' => $roleData['count'],
                        ]
                    );
                }
            });

            return redirect()->route('dashboard.dikelola')->with('success', 'Informasi proyek berhasil diperbarui!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui proyek: ' . $e->getMessage());
        }
    }

    public function destroy($id) 
    {
        try {
            $project = Project::findOrFail($id);

            if ($project->user_id !== Auth::id()) {
                abort(403, 'Akses ditolak.');
            }

            $project->delete();

            return redirect()->route('dashboard.dikelola')->with('success', 'Proyek berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus proyek.');
        }
    }
}
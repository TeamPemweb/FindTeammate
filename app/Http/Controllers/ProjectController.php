<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:200',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'project_field' => 'nullable|array',
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
                    'user_id' => Auth::id(),
                    'nama_proyek' => $request->project_name,
                    'deskripsi' => $request->description,
                    'status_proyek' => 'open',
                    'periode_awal' => $request->periode_awal,
                    'periode_akhir' => $request->periode_akhir,
                    'bidang' => $request->project_field,
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
        $project = Project::with(['roles', 'applications.user'])->findOrFail($id);

        if ($project->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        return view('projects.proyekDikelola', compact('project'));
    }

    public function update(Request $request, $id) 
    {
        // Implementasi edit informasi proyek (FT-F-6-04)
    }

    public function destroy($id) 
    {
        // Implementasi hapus proyek
    }
}
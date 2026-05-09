<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProjectController extends Controller
{
    private $file = 'projects.json';

    private function readData()
    {
        $disk = Storage::disk('public');
        return $disk->exists($this->file)
            ? json_decode($disk->get($this->file), true)
            : [];
    }

    private function writeData($data)
    {
        $disk = storage_path('app/public/' . $this->file);
        file_put_contents($disk, json_encode($data, JSON_PRETTY_PRINT));    
    }

    public function store(Request $request)
    {
        $projects = $this->readData();

        $newProject = [
            'id' => uniqid(),
            'project_name' => $request->project_name,
            'application_period' => $request->application_period,
            'project_field' => $request->project_field,
            'project_plan' => $request->project_plan,
            'roles' => $request->roles ?? [],
            'questions' => $request->questions ?? [],
            'accepted_info' => $request->accepted_info,
        ];

        $projects[] = $newProject;
        $this->writeData($projects);

        return redirect()->route('proyekSaya.dikelola')->with('success', 'Proyek berhasil dibuat!');
    }

    public function indexDikelola()
    {
        $projects = $this->readData();
        $projects = array_reverse($projects);
        return view('projects.proyekSaya', compact('projects'));
    }

    public function dashboardDikelola()
    {
        $projects = $this->readData();
        $projects = array_slice(array_reverse($projects), 0, 3);
        return view('projects.dikelola', compact('projects'));
    }

    public function show($id)
    {
        $projects = $this->readData();
        $project = collect($projects)->firstWhere('id', $id);

        if (!$project) {
            abort(404, 'Proyek tidak ditemukan');
        }

        return view('projects.proyekDikelola', compact('project'));
    }

    public function update(Request $request, $id) {}
    public function destroy($id)
    {
        $projects = $this->readData();
        $filtered = array_filter($projects, function($project) use ($id) {
            return $project['id'] !== $id;
        });

        // re-index the array just in case
        $this->writeData(array_values($filtered));

        return back()->with('success', 'Proyek berhasil dihapus.');
    }
}
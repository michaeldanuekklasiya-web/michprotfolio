<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Support\ImageUploader;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->orderByDesc('id')->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form', [
            'project' => new Project([
                'is_published' => true,
                'category' => 'web',
                'sort_order' => (Project::max('sort_order') ?? 0) + 1,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image_file')) {
            $data['image'] = ImageUploader::store($request->file('image_file'), 'projects', 1400);
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('status', 'Project berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $this->validated($request);

        if ($request->hasFile('image_file')) {
            ImageUploader::delete($project->image);
            $data['image'] = ImageUploader::store($request->file('image_file'), 'projects', 1400);
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('status', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        ImageUploader::delete($project->image);
        $project->delete();

        return back()->with('status', 'Project dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:150',
            'category' => ['required', Rule::in(array_keys(Project::CATEGORIES))],
            'client' => 'nullable|string|max:120',
            'year' => 'nullable|string|max:10',
            'description' => 'nullable|string|max:1000',
            'tags' => 'nullable|string|max:300',
            'url' => 'nullable|url|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'image_file' => 'nullable|image|max:8192',
        ]);
        unset($data['image_file']);

        $data['tags'] = collect(explode(',', $data['tags'] ?? ''))
            ->map(fn ($t) => trim($t))->filter()->values()->all();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }
}

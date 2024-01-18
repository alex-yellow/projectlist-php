<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private function checkUserAuth()
    {
        $user = session('user');
        if(!$user){
            redirect('/login')->send();
            exit();
        }
        return $user;
    }

    public function index()
    {
        $user = $this->checkUserAuth();

        $projects = Project::paginate(5);
        return view('project.index', compact('projects'));
    }

    public function create()
    {
        $user = $this->checkUserAuth();
        return view('project.create');
    }

    public function store(Request $request)
    {
        $user = $this->checkUserAuth();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'user_id' => $user['id'],
        ]);

        return redirect()->route('project.index')->with('success', 'Project add success');
    }

    public function edit(Project $project)
    {
        $user = $this->checkUserAuth();

        return view('project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $user = $this->checkUserAuth();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project->update([
            'name' => $request->name,
        ]);

        return redirect()->route('project.index')->with('success', 'Project edit success');
    }

    public function delete(Project $project)
    {
        $user = $this->checkUserAuth();

        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project delete success');

    }
}

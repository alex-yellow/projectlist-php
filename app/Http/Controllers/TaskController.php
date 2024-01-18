<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private function checkUserAuth()
    {
        $user = session('user');
        if (!$user) {
            redirect('/login')->send();
            exit();
        }
        return $user;
    }

    public function index(Request $request, Project $project)
    {
        $user = $this->checkUserAuth();

        $priorities = Priority::all();
        $query = Task::query()->where('project_id', $project->id);

        // Поиск по названию, учитывая совпадение хотя бы двух букв
        if ($request->has('search')) {
            $searchTask = $request->input('search');
            $query->where('title', 'LIKE', '%' . $searchTask . '%');
        }
        // Фильтрация по приоритету
        if ($request->has('priority_id')) {
            $selectedPriority = $request->input('priority_id');
            $query->where('priority_id', $selectedPriority);
        }
        $tasks = $query->orderBy('id', 'desc')->paginate(5);

        return view('task.index', compact('tasks', 'priorities', 'project'));
    }

    public function create(Project $project)
    {
        $user = $this->checkUserAuth();
        $priorities = Priority::all();
        $project_id = $project->id;
        return view('task.create', compact('priorities', 'project_id', 'project'));
    }

    public function store(Project $project, Request $request)
    {
        $user = $this->checkUserAuth();

        $request->validate([
            'title' => 'required|string|max:255',
            'priority_id' => 'required',
            'project_id' => 'required',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'project_id' => $request->project_id,
            'priority_id' => $request->priority_id,
        ]);

        return redirect()->route('task.index', ['project' => $project->id])->with('success', 'Task add success');
    }

    public function edit(Project $project, Task $task)
    {
        $user = $this->checkUserAuth();

        $priorities = Priority::all();
        return view('task.edit', compact('task', 'project',  'priorities'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $user = $this->checkUserAuth();

        $request->validate([
            'title' => 'required|string|max:255',
            'priority_id' => 'required'
        ]);

        $task->update([
            'title' => $request->title,
            'priority_id' => $request->priority_id,
        ]);

        return redirect()->route('task.index', ['project' => $project->id])->with('success', 'Task updated successfully');
    }

    public function delete(Project $project, Task $task)
    {
        $user = $this->checkUserAuth();

        $task->delete();

        return redirect()->route('task.index', compact('project'))->with('success', 'Task deleted successfully');
    }

    public function complete(Project $project, Task $task)
    {
        $user = $this->checkUserAuth();

        $task->completed = !$task->completed;
        $task->save();

        return redirect()->route('task.index', compact('project'))->with('success', 'Task complete success');

    }
}

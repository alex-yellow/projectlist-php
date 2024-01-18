@extends('layouts.app', ['title' => 'Tasks'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Task List</div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert" id="mess">
                        {{session('success')}}
                    </div>
                    @endif
                    <form method="GET" action="{{ route('task.index', $project->id) }}" class="mb-3">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <select name="priority_id" class="form-select" aria-label="Select Priority">
                                    <option value="" selected disabled>Select Priority</option>
                                    @foreach($priorities as $priority)
                                    <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search">
                                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <ul class="list-group">
                        @foreach($tasks as $task)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="{{$task->completed ? 'completed' : '' }}">{{$task->title}}</span>
                            <div>
                            <a href="{{ route('task.edit', [$project->id, $task->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('task.delete', [$project->id, $task->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('you want delete task?')">Delete</button>
                                </form>
                                <a href="{{ route('task.complete', [$project->id, $task->id]) }}" class="btn btn-success btn-sm">{{$task->completed ? 'Incomplete' : 'Complete'}}</a>
                            </div>
                        </li>
                        @endforeach
                        @if($tasks->isEmpty())
                        <li class="list-group-item">No tasks found.</li>
                        @endif
                    </ul>
                    <div class="my-pag mt-3">
                        {{$tasks->withQueryString()->links()}}
                    </div>
                    <div class="mt-3">
                        <a href="{{route('task.create', $project->id)}}" class="btn btn-primary">Create Task</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

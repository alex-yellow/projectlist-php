@extends('layouts.app', ['title' => 'Create Task'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Task</div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('task.store', $project->id) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Task Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="priority_id" class="form-label">Task Priority</label>
                                <select name="priority_id" id="priority_id" class="form-control">
                                    @foreach($priorities as $priority)
                                        <option value="{{$priority->id}}">{{$priority->name}}</option>
                                    @endforeach
                                </select>
                                @error('priority_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="project_id" id="project_id" value="{{ $project->id }}">
                            <button type="submit" class="btn btn-primary">Create Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

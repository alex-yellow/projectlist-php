@extends('layouts.app', ['title' => 'Edit Project'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Project</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('project.update', $project->id)}}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="title" class="form-label">Project Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Project</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app', ['title' => 'Projects'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Project List</div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert" id="mess">
                        {{session('success')}}
                    </div>
                    @endif
                    <ul class="list-group">
                        @foreach($projects as $project)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><a href="{{route('task.index', $project->id)}}">{{$project->name}}</a></span>
                            <div>
                                <a href="{{route('project.edit', $project->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{route('project.delete', $project->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('you want delete project?')">Delete</button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                        @if($projects->isEmpty())
                        <li class="list-group-item">No projects found.</li>
                        @endif
                    </ul>
                    <div class="my-pag mt-3">
                        {{$projects->withQueryString()->links()}}
                    </div>
                    <div class="mt-3">
                        <a href="{{route('project.create')}}" class="btn btn-primary">Create Projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

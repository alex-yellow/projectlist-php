@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Project Manager</div>
                    <div class="card-body">
                    @if (session('user'))
                        {{-- Пользователь вошел в систему, отображаем ссылку на logout --}}
                        <h2><a class="btn btn-danger" href="{{route('auth.logout')}}">Logout</a></h2>
                        <h2><a class="btn btn-primary" href="{{route('project.index')}}">Projects</a></h2>
                    @else
                        {{-- Пользователь не вошел в систему, отображаем ссылки на регистрацию и вход --}}
                        <h2><a class="btn btn-success" href="{{route('auth.registerForm')}}">Register</a></h2>
                        <h2><a class="btn btn-primary" href="{{route('auth.loginForm')}}">Login</a></h2>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

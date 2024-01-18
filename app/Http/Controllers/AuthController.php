<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255|unique:users',
            'password'=> 'required|string|min:5',
        ]);
        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/login')->with('success', 'registration was successful');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Поиск пользователя по имени
        $user = User::where('name', $request->input('name'))->first();
        // Проверка пароля
        if($user && Hash::check($request->input('password'), $user->password)){
            // Аутентификация успешна
            session(['user'=> $user->toArray()]);
            return redirect('/')->with('success', 'Welcome!');
        }
        return back()->withErrors(['name' => 'Invalid name or password']);
    }

    public function logout()
    {
        session()->forget('user');
        return redirect('/login');
    }
}

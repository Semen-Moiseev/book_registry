<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Author;

class LoginController extends Controller
{
    public function home(Request $request) {
        return view('home');
    }

    public function login(Request $request) {
        return view('login');
    }

    public function authentication(Request $request) {
        $arr = $request->only(['email', 'password']);
        Auth::attempt($arr);
        return redirect('home');
    }

    public function register(Request $request) {
        return view('register');
    }

    public function registerCreate(Request $request) {
        User::create($request->only(['name', 'email', 'password'])); // Создание пользователя
        Author::create($request->only(['name'])); // Создание автора
        return redirect('login');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }

    public function admin_panel(Request $request) {
        return view('admin_panel');
    }
}

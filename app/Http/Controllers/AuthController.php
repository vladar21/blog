<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use App\Category;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function registerForm()
    {
        $categories = Category::all();
        return view('pages.register', compact('categories'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::add($request->all());
        $user->generatePassword($request->get('password'));

        return redirect('/login');
    }

    public function loginForm()
    {
        $categories = Category::all();
        return view('pages.login', compact('categories'));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'email' => 'required|email'
        ]);

        if(Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]))
        {
            return redirect('/');
        }
        return redirect()->back()->with('status', 'Неправильный логин или пароль');

    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}

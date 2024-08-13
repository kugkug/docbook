<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    //
    public function index() {
        $data = [
            'title' => 'User',
            'header' => 'User',
        ];
        return view("admin.maintenance.users.index", $data);
    }

    public function create() {
        $data = [
            'title' => 'User Add',
            'header' => 'New - User Account',
        ];
        return view("admin.maintenance.users.create", $data);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            "name" => ['required', 'min:4'],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => 'required|confirmed|min:8',
            "user_type" => 'required|min:6'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        return redirect("/");
    }

    public function edit($id) {
        $data = [
            'title' => 'User Edit',
            'header' => 'Edit - User Account',
        ];
        return view("admin.maintenance.users.edit", $data);
    }


    public function authenticate(Request $request) {
        
        $validated = $request->validate([            
            "email" => ['required', 'email'],
            "password" => 'required'
        ]);

        
        if (auth()->attempt($validated)) {
            $request->session()->regenerateToken();

            return redirect("/admin/dashboard");
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil data user beserta profilnya
        $users = User::withCount('posts')->get();

        dd($users);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Membuat profil baru
        $user->profile()->create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'gender' => $request->gender,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        // Mengambil data user berdasarkan id
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil data user beserta profilnya
        $users = User::with('profile')->paginate(10);

        //dd($users);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        // dd($request->file('image'));

        // Membuat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_image', 'public');

            // dd($imagePath);

            $user->image()->create([
                'url_image' => $imagePath,
            ]);
        }

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

    public function destroy($id)
    {
        // Menghapus user berdasarkan id
        $user = User::findOrFail($id);

        // Menghapus profil user
        $user->profile->delete();

        // menghapus gambar user
        Storage::disk('public')->delete($user->image->url_image);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
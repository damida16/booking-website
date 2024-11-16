<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();
        return view('users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name', // Using role name from Spatie roles
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the profile picture
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Assign role to user using Spatie
        $user->assignRole($request->input('role'));

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Store the profile picture and get the path
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Save the path of the profile picture in the database
            $user->profile_picture = $path;
            $user->save();
        }

        // Redirect or return a response (customize as needed)
        return redirect()->route('dashboard.users.index')->with('success', 'User created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the user by their ID
        $user = User::findOrFail($id);

        // Pass the user details to the view
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();

        return view('users.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'password' => 'nullable|string|min:8|confirmed', // Optional password change
            'role' => 'required|string|exists:roles,name', // Using role name from Spatie roles
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate the profile picture
        ]);

        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        // Sync or assign the new role using Spatie
        $user->syncRoles($request->input('role'));

        // Handle the profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Store the profile picture and get the path
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            if ($user->profile_picture) {
                // Delete the existing profile picture file from the storage
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Save the path of the profile picture in the database
            $user->profile_picture = $path;
            $user->save();
        }

        // Redirect or return a response (customize as needed)
        return redirect()->route('dashboard.users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find the user by ID

        if ($user->profile_picture) {
            // Delete the existing profile picture file from the storage
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete(); // Delete the user

        return redirect()->route('dashboard.users.index')->with('success', 'User deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; // Tambahkan ini untuk validasi

class AdminController extends Controller
{
    public function courseManagement()
    {
        $courses = Course::all();
        return view('Dashboard.Admin.course-management', ['courses' => $courses]);
    }

    public function userManagement(Request $request)
    {
        $users = User::paginate(10);
        return view('Dashboard.Admin.user-management', ['users' => $users]);
    }

    public function createUser()
    {
        return view('Dashboard.Admin.create-user');
    }

    public function storeUser(Request $request)
    {
        // Validasi data user
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,teacher,student,guest',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user-management')->with('success', 'User berhasil ditambahkan!');
    }

    public function editUser(User $user)
    {
        return view('Dashboard.Admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Validasi data user
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,teacher,student,guest',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user-management')->with('success', 'User berhasil diubah!');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user-management')->with('success', 'User berhasil dihapus!');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $user = $request->user(); // Mengambil objek user

            if ($user->role === 'admin') {
                return view('dashboard.admin.home'); 
            } elseif ($user->role === 'teacher') {
                return view('dashboard.teacher.home'); 
            } elseif ($user->role === 'student') {
                return view('dashboard.student.home'); 
            } else { // role == 'guest'
                return view('dashboard.guest.home'); 
            }
        } else {
            return redirect('login');
        }
    }
    
}
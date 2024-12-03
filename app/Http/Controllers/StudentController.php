<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment; // Pastikan model Enrollment diimport
use App\Models\Course; // Pastikan model Course diimport jika diperlukan

class StudentController extends Controller
{
    // Menampilkan kursus yang diikuti oleh siswa
    public function myCourses()
    {
        $courses = Enrollment::where('user_id', Auth::id())->with('course')->get();
        
        // Perbarui nama tampilan di sini
        return view('Dashboard.Student.my_courses', compact('courses'));
    }
    
}

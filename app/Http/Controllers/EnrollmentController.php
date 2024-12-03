<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, $courseId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk mendaftar kursus.');
        }

        // Validasi: Pastikan user belum terdaftar di kursus ini
        $existingEnrollment = Enrollment::where('user_id', Auth::user()->id)
                                    ->where('course_id', $courseId)
                                    ->exists();

        if ($existingEnrollment) {
            return redirect()->back()->with('error', 'Kamu sudah terdaftar di kursus ini!');
        }

        // Buat enrollment baru
        Enrollment::create([
            'user_id' => Auth::user()->id,
            'course_id' => $courseId,
            'role' => 'student', 
        ]);

        return redirect()->back()->with('success', 'Kamu berhasil terdaftar di kursus ini!');
    }
    public function index()
    {
        $courses = Course::with(['teacher', 'enrollments.user'])->get(); // Pastikan ini ada
        return view('course.catalog', compact('courses'));
    }
 

}

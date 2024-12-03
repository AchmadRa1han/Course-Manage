<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function courseManagement(Request $request)
    {
        $userId = Auth::id();
        $courses = Course::where('teacher_id', $userId)->get();
        return view('Dashboard.Teacher.course-management', ['courses' => $courses]);
    }

    public function createCourse()
    {
        return view('Dashboard.Teacher.create-course');
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->route('teacher.course-management')->with('success', 'Kursus berhasil ditambahkan!');
    }

    public function editCourse(Course $course)
    {
        if (Auth::check() && $course->teacher_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        return view('Dashboard.Teacher.edit-course', compact('course'));
    }

    public function updateCourse(Request $request, Course $course)
    {
        if (Auth::check() && $course->teacher_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('teacher.course-management')->with('success', 'Kursus berhasil diubah!');
    }

    public function destroyCourse(Course $course)
    {
        if (Auth::check() && $course->teacher_id !== Auth::user()->id) {
            abort(403, 'Unauthorized');
        }

        $course->delete();

        return redirect()->route('teacher.course-management')->with('success', 'Kursus berhasil dihapus!');
    }
}
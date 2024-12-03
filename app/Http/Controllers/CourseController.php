<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
// CourseController.php

public function index(Request $request)
{
    if ($request->user()->role === 'teacher') {
        $courses = Course::where('teacher_id', $request->user()->id)->paginate(10); // Ubah get() menjadi paginate()
    } else {
        $courses = Course::with('teacher')->paginate(10); // Ubah get() menjadi paginate()
    }

    return view('Dashboard.Admin.course-management', ['courses' => $courses]);
}

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('Dashboard.Admin.create-course', ['teachers' => $teachers]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'teacher_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('admin.course-management')->with('success', 'Kursus berhasil ditambahkan!');
    }

    public function edit(Course $course)
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('Dashboard.Admin.edit-course', compact('course', 'teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'teacher_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('admin.course-management')->with('success', 'Kursus berhasil diubah!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.course-management')->with('success', 'Kursus berhasil dihapus!');
    }
    public function viewStudents($courseId)
    {
        $course = Course::with(['enrollments.user', 'contents'])->findOrFail($courseId);
        return view('Dashboard.Teacher.view_students', compact('course')); // Perbarui path tampilan
    }
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

}
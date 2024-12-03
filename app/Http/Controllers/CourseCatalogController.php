<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseCatalogController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari request
        $search = $request->get('search');

        // Query untuk mengambil kursus dengan pencarian
        $courses = Course::with('teacher')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->get();

        return view('Dashboard.Student.course-catalog', ['courses' => $courses]);
    }
}

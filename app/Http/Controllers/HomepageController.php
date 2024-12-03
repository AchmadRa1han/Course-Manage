<?php 
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $popularCourses = Course::withCount('enrollments')
            ->orderBy('enrollments_count', 'desc')
            ->take(5)
            ->get();
 
        // Debugging untuk melihat detail setiap kursus

 
        return view('layouts.homepage', compact('popularCourses'));
    }
 
 
 
}

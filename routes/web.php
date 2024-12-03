<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\CourseCatalogController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContentController;

Route::get('/', [HomepageController::class, 'index'])->name('homepage');


Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/courses/{courseId}/enroll', [EnrollmentController::class, 'enroll'])->middleware('auth')->name('courses.enroll');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('course.show');
Route::get('/courses', [CourseCatalogController::class, 'index'])->name('courses.index');
Route::post('/content/{contentId}/mark-as-done', [ContentController::class, 'markAsDone'])->name('content.markAsDone');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/course-management', [TeacherController::class, 'courseManagement'])->name('course-management');
        Route::get('/courses/create', [TeacherController::class, 'createCourse'])->name('courses.create');
        Route::post('/courses', [TeacherController::class, 'storeCourse'])->name('courses.store');
        Route::get('/courses/{course}/edit', [TeacherController::class, 'editCourse'])->name('courses.edit');
        Route::put('/courses/{course}', [TeacherController::class, 'updateCourse'])->name('courses.update');
        Route::delete('/courses/{course}', [TeacherController::class, 'destroyCourse'])->name('courses.destroy');
    });
    
    
});

require __DIR__.'/auth.php';
// Ambil 5 course terpopuler jika diperlukan
// $popularCourses = Course::withCount('enrollment')->orderBy('enrollment_count', 'desc')->take(5)->get();
// 'popularCourses' => $popularCourses, // Uncomment jika Anda ingin menampilkan kursus
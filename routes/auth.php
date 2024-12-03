<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\UserlistController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\StudentController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');


        Route::resource('Userlist', UserlistController::class)->middleware('admin');
        Route::get('/admin/user-management', [AdminController::class, 'userManagement'])->name('admin.user-management');
        Route::get('/admin/create-user', [AdminController::class, 'createUser'])->middleware(['role:admin'])->name('admin.create-user');
        Route::post('/admin/users', [AdminController::class, 'storeUser'])->middleware(['role:admin'])->name('admin.store-user');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->middleware(['role:admin'])->name('admin.edit-user');
        Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->middleware(['role:admin'])->name('admin.update-user');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->middleware(['role:admin'])->name('admin.destroy-user');

        Route::get('/admin/course-management', [CourseController::class, 'index'])->middleware(['role:admin'])->name('admin.course-management');
        Route::get('/admin/courses/create', [CourseController::class, 'create'])->middleware(['role:admin'])->name('admin.courses.create');
        Route::post('/admin/courses', [CourseController::class, 'store'])->middleware(['role:admin'])->name('admin.courses.store');
        Route::get('/admin/courses/{course}/edit', [CourseController::class, 'edit'])->middleware(['role:admin'])->name('admin.courses.edit');
        Route::put('/admin/courses/{course}', [CourseController::class, 'update'])->middleware(['auth', 'role:admin'])->name('admin.courses.update');
        Route::delete('/admin/courses/{course}', [CourseController::class, 'destroy'])->middleware(['role:admin'])->name('admin.courses.destroy');

        Route::get('/courses/{courseId}/content/create', [ContentController::class, 'create'])->name('content.create')->middleware('role:teacher,admin');
        Route::post('/content', [ContentController::class, 'store'])->name('content.store')->middleware('role:teacher,admin');
        Route::get('/courses/{courseId}/content', [ContentController::class, 'show'])->name('content.show');



        Route::get('/content/{id}/edit', [ContentController::class, 'edit'])->name('content.edit')->middleware('role:teacher,admin');
        Route::put('/content/{id}', [ContentController::class, 'update'])->name('content.update')->middleware('role:teacher,admin');
        Route::delete('/content/{id}', [ContentController::class, 'destroy'])->name('content.destroy')->middleware('role:teacher,admin');
        Route::get('/courses/{courseId}/content/create', [ContentController::class, 'create'])->name('content.create')->middleware('role:teacher,admin');
        Route::post('/content', [ContentController::class, 'store'])->name('content.store')->middleware('role:teacher,admin');

        Route::get('/student/my-courses', [StudentController::class, 'myCourses'])->name('student.my-courses');
        Route::get('/courses/{courseId}/students', [CourseController::class, 'viewStudents'])->name('courses.viewStudents')->middleware('role:teacher,admin');






        
        


        // Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
        // Route::post('/forum/{forumId}/posts', [ForumController::class, 'createPost'])->name('forum.posts.create');
});


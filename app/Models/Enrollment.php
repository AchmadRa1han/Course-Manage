<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $table = 'enrollment';

    protected $fillable = [
        'user_id',
        'course_id',
        'role', // 'teacher' atau 'student'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
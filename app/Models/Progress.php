<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'content_id', 
        'status', 
        'completion_date', 
    ];

    // Relasi dengan User (Student)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Relasi dengan Content
    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
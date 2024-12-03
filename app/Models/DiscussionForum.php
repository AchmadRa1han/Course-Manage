<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionForum extends Model
{
    use HasFactory;

    protected $table = 'discussionforum'; // Menetapkan nama tabel

    protected $fillable = [
        'course_id',
        'topic',
    ];

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi dengan ForumPost
    public function posts()
    {
        return $this->hasMany(ForumPost::class, 'forum_id');
    }
}

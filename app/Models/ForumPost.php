<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    use HasFactory;

    protected $table = 'forumpost'; // Menetapkan nama tabel jika berbeda

    protected $fillable = [
        'forum_id', 
        'user_id', 
        'content', 
        'timestamp', 
    ];

    // Relasi dengan DiscussionForum
    public function forum()
    {
        return $this->belongsTo(DiscussionForum::class);
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

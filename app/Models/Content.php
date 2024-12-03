<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content_text',
        'course_id', 
    ];

    protected $table = 'content'; // Pastikan ini sesuai dengan nama tabel di database
    protected $primaryKey = 'content_id'; // Ganti 'id' dengan 'content_id'

    // Relasi dengan Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id'); // Menentukan kolom foreign key
    }

    // Relasi dengan Progress
    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
}

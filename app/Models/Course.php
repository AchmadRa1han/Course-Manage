<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course'; // Pastikan ini sesuai dengan nama tabel di database
    protected $primaryKey = 'course_id'; // Pastikan ini benar

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'teacher_id',
    ];

    public function contents()
    {
        return $this->hasMany(Content::class, 'course_id');
    }



    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

   public function enrollments()
   {
       return $this->hasMany(Enrollment::class, 'course_id', 'course_id');
   }


    public function forum()
    {
        return $this->hasOne(DiscussionForum::class);
    }
}

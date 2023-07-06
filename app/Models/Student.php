<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\Course;



class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'surname', 'address', 'email'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student')->onDelete('cascade');
    }

    public function documentables()
    {
        return $this->morphMany(Document::class, 'documentable');
    }


}

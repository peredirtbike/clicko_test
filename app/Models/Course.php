<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'course_category')->withTimestamps();
    }

    public function documentables()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

}

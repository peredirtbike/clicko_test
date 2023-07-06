<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;
use App\Models\Document;
use App\Models\Student;




class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {

        //Category

          $category1 = Category::create([
            'name' => 'Cursos de informática',
            'description' => 'Cursos de informática fsdfsdaf',
        ]);

        $category2 = Category::create([
            'name' => 'Cursos de administración',
            'description' => 'Cursos de administración dsadasd',
        ]);

        $category3 = Category::create([
            'name' => 'Cursos de mindfullness',
            'description' => 'MindFullness xcassdfasf',
        ]);

        //Course

        $course1 = Course::create([
            'name' => 'Curso de Python',
            'description' => 'Descripción del curso 1',
        ]);
        
        $course1->categories()->attach([1]);
        
        $course2 = Course::create([
            'name' => 'Curso de MindFullnes completo',
            'description' => 'Dfsadfsadfsa',
        ]);
        
        $course2->categories()->attach([3]);
        
        $course3 = Course::create([
            'name' => 'Curso de Excel',
            'description' => 'Excel dsafas',
        ]);
        
        $course3->categories()->attach([2]);
 
        //Student

        $student1 = Student::create([
            'name' => 'Pere',
            'surname' => 'Garcia Grau',
            'address' => 'fasfasrfa',
            'email' => 'pere@example.com',
        ]);

        $student2 = Student::create([
            'name' => 'Joan',
            'surname' => 'Giralt',
            'address' => 'fsafas',
            'email' => 'joan@example.com',
        ]);

        $course1->students()->attach($student1);
        $course2->students()->attach($student1);

      

        //Document
        $document1 = Document::create([
            'name' => 'Documento 1',
            'file_path' => 'documento1.pdf',
            'documentable_type' => 'App\Models\Course',
            'documentable_id' => 1,

        ]);

        $document2 = Document::create([
            'name' => 'Documento 2',
            'file_path' => 'documento2.pdf',
            'documentable_type' => 'App\Models\Course',
            'documentable_id' => 2,

        ]);

        $document3 = Document::create([
            'name' => 'Documento 3',
            'file_path' => 'documento3.pdf',
            'documentable_type' => 'App\Models\Student',
            'documentable_id' => 1,
        ]);

    }
}

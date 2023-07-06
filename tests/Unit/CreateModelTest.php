<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Course;
use App\Models\Document;
use App\Models\Student;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CreateModelTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCategory()
    {
        // Preparation
        $data = [
            'name' => 'Category 1',
            'description' => 'Category description',
        ];

        // Execution
        $response = $this->post('/api/v1/categories', $data);

        // Verification
        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Categoría creada exitosamente',
            'data' => [
                'name' => 'Category 1',
                'description' => 'Category description',
            ]
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Category 1',
            'description' => 'Category description',
        ]);
    }

    public function testCreateCourse()
{
    // Preparation
    $data = [
        'name' => 'Programming Course',
        'description' => 'Learn to program from scratch',
        'categories' => [2]
    ];

    // Check if the category exists, otherwise create it
    if (!Category::find(2)) {
        Category::factory()->create(['id' => 2]);
    }

    // Execution
    $response = $this->postJson('/api/v1/courses', $data);

    // Verification
    $response->assertCreated();
    $response->assertJson([
        'message' => 'Curso creado exitosamente',
        'data' => [
            'name' => 'Programming Course',
            'description' => 'Learn to program from scratch'
        ]
    ]);

    $this->assertDatabaseHas('courses', [
        'name' => 'Programming Course',
        'description' => 'Learn to program from scratch'
    ]);
}

  
public function testCreateDocument()
{
    // Preparation
    $file = \Illuminate\Http\UploadedFile::fake()->create('document.pdf', 1024);

    $data = [
        'name' => 'Document 1',
        'file_path' => $file,
    ];

    // Execution
    $response = $this->post('/api/v1/documents', $data);

    // Verification
    $response->assertStatus(201);
    $response->assertJson([
        'message' => 'Documento creado exitosamente',
        'data' => [
            'name' => 'Document 1',
        ]
    ]);

    $this->assertDatabaseHas('documents', [
        'name' => 'Document 1',
    ]);
}

    public function testCreateStudent()
    {
        // Preparation
        $data = [
            'name' => 'John',
            'surname' => 'Doe',
            'address' => '123 Main St',
            'email' => 'john@example.com',
        ];

        // Execution
        $response = $this->post('/api/v1/students', $data);

        // Verification
        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Estudiante creado exitosamente',
            'data' => [
                'name' => 'John',
                'surname' => 'Doe',
                'address' => '123 Main St',
                'email' => 'john@example.com',
            ]
        ]);

        $this->assertDatabaseHas('students', [
            'name' => 'John',
            'surname' => 'Doe',
            'address' => '123 Main St',
            'email' =>'john@example.com',
        ]);
    }
}
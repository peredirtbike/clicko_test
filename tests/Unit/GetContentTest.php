<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;
use App\Models\Course;
use App\Models\Document;
use App\Models\Student;

class GetContentTest extends TestCase
{
    use RefreshDatabase;

    public function testGetCourses()
    {
        // Preparation
        Course::factory()->count(3)->create();

        // Execution
        $response = $this->get('/api/v1/courses');

        // Verification
        $response->assertOk();
        $response->assertJsonCount(3, 'data');
    }

    public function testGetCategories()
    {
        // Preparation
        Category::factory()->count(3)->create();

        // Execution
        $response = $this->get('/api/v1/categories');

        // Verification
        $response->assertOk();
        $response->assertJsonCount(3, 'data');
    }
}
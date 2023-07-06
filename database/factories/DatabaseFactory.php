<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseFactory extends Factory
{
    protected static $namespace = 'Database\\Factories\\';

    public function __construct($faker, $definitions = [])
    {
        parent::__construct($faker, $definitions);

        $this->define(App\Models\Category::class, CategoryFactory::class);
        $this->define(App\Models\Course::class, CourseFactory::class);
        $this->define(App\Models\Document::class, DocumentFactory::class);
        $this->define(App\Models\Student::class, StudentFactory::class);
    }
}
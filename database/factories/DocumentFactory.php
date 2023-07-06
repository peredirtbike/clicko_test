<?php

namespace Database\Factories;

use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'file_path' => $this->faker->file('/path/to/files'),
        ];
    }
}
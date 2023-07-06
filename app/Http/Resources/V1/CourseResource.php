<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->categories->pluck('name')->toArray(),
            'student_count' => $this->students->count()
        ];
    }
}

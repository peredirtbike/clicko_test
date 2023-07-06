<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CourseResource;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CourseResource::collection(Course::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);


        $course = Course::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $course->categories()->sync($request->input('categories'));

        return response()->json([
            'message' => 'Curso creado exitosamente',
            'data' => $course,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'categories' => 'required|array|min:1', // Se requiere al menos una categoría
            'categories.*' => 'exists:categories,id', // Las categorías deben existir en la tabla categories
        ]);
        
        $course->fill([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
    
        $course->save();
    
        // Actualiza las categorías relacionadas con el curso
        $categories = $request->input('categories');
        $course->categories()->sync($categories);
    
        return response()->json([
            'message' => 'Curso actualizado correctamente',
            'data' => $course,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        if ($course->delete()){
            return response()->json([
                'message' => 'Success'
            ],204);
        }
        return response()->json([
            'message'=>'Not found'
        ],404);
    }
}

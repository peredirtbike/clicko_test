<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\V1\CategoryResource;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
  
        ]);

        return response()->json([
            'message' => 'Categoría creada exitosamente',
            'data' => new CategoryResource($category),
        ], 201);     
    }

    /**
     * Display the specified resource.
     */


    public function destroy(Category $category)
    {
        if ($category->delete()){
            return response()->json([
                'message' => 'Success'
            ],204);
        }
        return response()->json([
            'message'=>'Not found'
        ],404);
    }   
}

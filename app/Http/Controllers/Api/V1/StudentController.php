<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\V1\StudentResource;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StudentResource::collection(Student::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);

        $student = Student::create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
        ]);

        return response()->json([
            'message' => 'Estudiante creado exitosamente',
            'data' => new StudentResource($student),
        ], 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'sometimes',
            'surname' => 'sometimes',
            'address' => 'sometimes',
            'email' => 'sometimes',
        ]);
                
        $data = [];
        
        if ($request->has('name')) {
            $data['name'] = $request->input('name');
        }
        
        if ($request->has('surname')) {
            $data['surname'] = $request->input('surname');
        }
        
        if ($request->has('address')) {
            $data['address'] = $request->input('address');
        }
        
        if ($request->has('email')) {
            $data['email'] = $request->input('email');
        }
        
        $student->fill($data);
        $student->save();
        
        return response()->json([
            'message' => 'Estudiante modificado correctamente',
            'data' => $student,
        ], 200);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if ($student->delete()){
            return response()->json([
                'message' => 'Success'
            ],204);
        }
        return response()->json([
            'message'=>'Not found'
        ],404);
    }
}

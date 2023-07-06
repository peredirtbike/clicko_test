<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DocumentResource;
use Illuminate\Support\Facades\Storage;



class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DocumentResource::collection(Document::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'file_path' => 'required|file',
    ]);

    // Obtener el archivo adjunto
    $file = $request->file('file_path');

    // Guardar el archivo en una ubicación deseada sin cambiar el nombre
    $storedFile = $file->store('documents');

    // Verificar si el archivo se guardó correctamente
    if (!$storedFile) {
        return response()->json([
            'message' => 'Error al guardar el archivo',
        ], 500);
    }

    // Crear el documento en la base de datos
    $document = Document::create([
        'name' => $request->input('name'),
        'file_path' => $storedFile,
        'documentable_id' => $request->input('documentable_id'),
        'documentable_type' => $request->input('documentable_type'),
    ]);

    return response()->json([
        'message' => 'Documento creado exitosamente',
        'data' => $document,
    ], 201);
}

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        return new DocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'name' => 'required',
            'file_path' => 'required|file',
        ]);
        
        // Obtén el nombre del archivo adjunto actual antes de actualizarlo
        $oldFilePath = $document->file_path;
        
        // Subir el nuevo archivo
        $file = $request->file('file_path');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('documents', $fileName);
        
        // Actualizar el documento con los campos y el archivo adjunto
        $document->update([
            'name' => $request->input('name'),
            'file_path' => $fileName,
        ]);
        
        // Eliminar el archivo anterior si existe
        if ($oldFilePath) {
            Storage::delete('documents/' . $oldFilePath);
        }
        
        return response()->json([
            'message' => 'Documento actualizado correctamente',
            'data' => $document,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        if ($document->delete()) {
            return response()->json([
                'message' => 'El archivo se ha borrado correctamente'
            ], 204);
        }
        
        return response()->json([
            'message' => 'No se encontró el archivo'
        ], 404);
    }
}

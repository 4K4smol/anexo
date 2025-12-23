<?php

namespace App\Http\Controllers;

use App\Models\Coleccion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ColeccionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Coleccion::with('editorial')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre'       => ['required', 'string', 'max:255'],
            'editorial_id' => ['required', 'integer', 'exists:editoriales,id'],
        ]);

        $coleccion = Coleccion::create($data);

        return response()->json($coleccion->load('editorial'), 201);
    }

    public function show(Coleccion $coleccion): JsonResponse
    {
        return response()->json($coleccion->load('editorial'));
    }

    public function update(Request $request, Coleccion $coleccion): JsonResponse
    {
        $data = $request->validate([
            'nombre'       => ['sometimes', 'string', 'max:255'],
            'editorial_id' => ['sometimes', 'integer', 'exists:editoriales,id'],
        ]);

        $coleccion->update($data);

        return response()->json($coleccion->load('editorial'));
    }

    public function destroy(Coleccion $coleccion): JsonResponse
    {
        $coleccion->delete();

        return response()->json(['mensaje' => 'Colección eliminada correctamente.']);
    }
}

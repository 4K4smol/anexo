<?php

namespace App\Http\Controllers;

use App\Models\Ideologia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IdeologiaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Ideologia::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre'      => ['required', 'string', 'max:255', 'unique:ideologias,nombre'],
            'descripcion' => ['nullable', 'string'],
        ]);

        $ideologia = Ideologia::create($data);

        return response()->json($ideologia, 201);
    }

    public function show(Ideologia $ideologia): JsonResponse
    {
        return response()->json($ideologia);
    }

    public function update(Request $request, Ideologia $ideologia): JsonResponse
    {
        $data = $request->validate([
            'nombre'      => ['sometimes', 'string', 'max:255', 'unique:ideologias,nombre,' . $ideologia->id],
            'descripcion' => ['nullable', 'string'],
        ]);

        $ideologia->update($data);

        return response()->json($ideologia);
    }

    public function destroy(Ideologia $ideologia): JsonResponse
    {
        $ideologia->delete();

        return response()->json(['mensaje' => 'Ideología eliminada correctamente.']);
    }
}

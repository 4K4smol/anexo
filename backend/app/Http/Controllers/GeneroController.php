<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Genero::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:generos,nombre'],
        ]);

        $genero = Genero::create($data);

        return response()->json($genero, 201);
    }

    public function show(Genero $genero): JsonResponse
    {
        return response()->json($genero);
    }

    public function update(Request $request, Genero $genero): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['sometimes', 'string', 'max:255', 'unique:generos,nombre,' . $genero->id],
        ]);

        $genero->update($data);

        return response()->json($genero);
    }

    public function destroy(Genero $genero): JsonResponse
    {
        $genero->delete();

        return response()->json(['mensaje' => 'Género eliminado correctamente.']);
    }
}

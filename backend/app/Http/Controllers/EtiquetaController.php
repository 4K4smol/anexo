<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Etiqueta::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:etiquetas,nombre'],
        ]);

        $etiqueta = Etiqueta::create($data);

        return response()->json($etiqueta, 201);
    }

    public function show(Etiqueta $etiqueta): JsonResponse
    {
        return response()->json($etiqueta);
    }

    public function update(Request $request, Etiqueta $etiqueta): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['sometimes', 'string', 'max:255', 'unique:etiquetas,nombre,' . $etiqueta->id],
        ]);

        $etiqueta->update($data);

        return response()->json($etiqueta);
    }

    public function destroy(Etiqueta $etiqueta): JsonResponse
    {
        $etiqueta->delete();

        return response()->json(['mensaje' => 'Etiqueta eliminada correctamente.']);
    }
}

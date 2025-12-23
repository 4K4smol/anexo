<?php

namespace App\Http\Controllers;

use App\Models\Edicion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EdicionController extends Controller
{
    public function index(): JsonResponse
    {
        $ediciones = Edicion::with(['obra', 'editorial', 'coleccion'])->get();

        return response()->json($ediciones);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'obra_id'        => ['required', 'integer', 'exists:obras,id'],
            'editorial_id'   => ['required', 'integer', 'exists:editoriales,id'],
            'coleccion_id'   => ['required', 'integer', 'exists:colecciones,id'],
            'isbn'           => ['required', 'string', 'max:255'],
            'traductor'      => ['required', 'string', 'max:255'],
            'anio'           => ['required', 'integer'],
            'paginas'        => ['required', 'integer'],
            'numero_edicion' => ['required', 'integer'],
            'fuente_externa' => ['nullable', 'string', 'max:255'],
            'id_externo'     => ['nullable', 'string', 'max:255'],
        ]);

        $edicion = Edicion::create($data);

        return response()->json($edicion->load(['obra', 'editorial', 'coleccion']), 201);
    }

    public function show(Edicion $edicion): JsonResponse
    {
        return response()->json($edicion->load(['obra', 'editorial', 'coleccion']));
    }

    public function update(Request $request, Edicion $edicion): JsonResponse
    {
        $data = $request->validate([
            'obra_id'        => ['sometimes', 'integer', 'exists:obras,id'],
            'editorial_id'   => ['sometimes', 'integer', 'exists:editoriales,id'],
            'coleccion_id'   => ['sometimes', 'integer', 'exists:colecciones,id'],
            'isbn'           => ['sometimes', 'string', 'max:255'],
            'traductor'      => ['sometimes', 'string', 'max:255'],
            'anio'           => ['sometimes', 'integer'],
            'paginas'        => ['sometimes', 'integer'],
            'numero_edicion' => ['sometimes', 'integer'],
            'fuente_externa' => ['nullable', 'string', 'max:255'],
            'id_externo'     => ['nullable', 'string', 'max:255'],
        ]);

        $edicion->update($data);

        return response()->json($edicion->load(['obra', 'editorial', 'coleccion']));
    }

    public function destroy(Edicion $edicion): JsonResponse
    {
        $edicion->delete();

        return response()->json(['mensaje' => 'Edición eliminada correctamente.']);
    }
}

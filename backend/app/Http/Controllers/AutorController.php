<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function index(): JsonResponse
    {
        $autores = Autor::with(['ideologias', 'obras'])->get();

        return response()->json($autores);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre'            => ['required', 'string', 'max:255'],
            'biografia'         => ['nullable', 'string'],
            'fecha_nacimiento'  => ['nullable', 'date'],
            'fecha_defuncion'   => ['nullable', 'date'],
            'nacionalidad'      => ['nullable', 'string', 'max:255'],
            'ideologia_ids'     => ['sometimes', 'array'],
            'ideologia_ids.*'   => ['integer', 'exists:ideologias,id'],
        ]);

        $ideologiaIds = $data['ideologia_ids'] ?? [];
        unset($data['ideologia_ids']);

        $autor = Autor::create($data);

        if (!empty($ideologiaIds)) {
            $autor->ideologias()->sync($ideologiaIds);
        }

        return response()->json($autor->load(['ideologias', 'obras']), 201);
    }

    public function show(Autor $autor): JsonResponse
    {
        return response()->json($autor->load(['ideologias', 'obras']));
    }

    public function update(Request $request, Autor $autor): JsonResponse
    {
        $data = $request->validate([
            'nombre'            => ['sometimes', 'string', 'max:255'],
            'biografia'         => ['nullable', 'string'],
            'fecha_nacimiento'  => ['nullable', 'date'],
            'fecha_defuncion'   => ['nullable', 'date'],
            'nacionalidad'      => ['nullable', 'string', 'max:255'],
            'ideologia_ids'     => ['sometimes', 'array'],
            'ideologia_ids.*'   => ['integer', 'exists:ideologias,id'],
        ]);

        $ideologiaIds = $data['ideologia_ids'] ?? null;
        unset($data['ideologia_ids']);

        $autor->update($data);

        if (is_array($ideologiaIds)) {
            $autor->ideologias()->sync($ideologiaIds);
        }

        return response()->json($autor->load(['ideologias', 'obras']));
    }

    public function destroy(Autor $autor): JsonResponse
    {
        $autor->delete();

        return response()->json(['mensaje' => 'Autor eliminado correctamente.']);
    }
}

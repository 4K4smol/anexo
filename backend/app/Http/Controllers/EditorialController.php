<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Editorial::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:editoriales,nombre'],
            'pais'   => ['nullable', 'string', 'max:255'],
        ]);

        $editorial = Editorial::create($data);

        return response()->json($editorial, 201);
    }

    public function show(Editorial $editorial): JsonResponse
    {
        return response()->json($editorial);
    }

    public function update(Request $request, Editorial $editorial): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['sometimes', 'string', 'max:255', 'unique:editoriales,nombre,' . $editorial->id],
            'pais'   => ['nullable', 'string', 'max:255'],
        ]);

        $editorial->update($data);

        return response()->json($editorial);
    }

    public function destroy(Editorial $editorial): JsonResponse
    {
        $editorial->delete();

        return response()->json(['mensaje' => 'Editorial eliminada correctamente.']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Saga;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SagaController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Saga::all());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre'      => ['required', 'string', 'max:255', 'unique:sagas,nombre'],
            'descripcion' => ['nullable', 'string'],
        ]);

        $saga = Saga::create($data);

        return response()->json($saga, 201);
    }

    public function show(Saga $saga): JsonResponse
    {
        return response()->json($saga);
    }

    public function update(Request $request, Saga $saga): JsonResponse
    {
        $data = $request->validate([
            'nombre'      => ['sometimes', 'string', 'max:255', 'unique:sagas,nombre,' . $saga->id],
            'descripcion' => ['nullable', 'string'],
        ]);

        $saga->update($data);

        return response()->json($saga);
    }

    public function destroy(Saga $saga): JsonResponse
    {
        $saga->delete();

        return response()->json(['mensaje' => 'Saga eliminada correctamente.']);
    }
}

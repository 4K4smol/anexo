<?php

namespace App\Http\Controllers;

use App\Models\UsuarioEdicion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioEdicionController extends Controller
{
    protected array $estados = ['leyendo', 'leido', 'quiero_leer'];

    public function index(): JsonResponse
    {
        $usuarioEdiciones = UsuarioEdicion::with(['usuario', 'edicion'])->get();

        return response()->json($usuarioEdiciones);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'user_id'      => ['required', 'integer', 'exists:users,id'],
            'edicion_id'   => ['required', 'integer', 'exists:ediciones,id'],
            'estado'       => ['required', Rule::in($this->estados)],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin'    => ['nullable', 'date'],
        ]);

        $usuarioEdicion = UsuarioEdicion::create($data);

        return response()->json($usuarioEdicion->load(['usuario', 'edicion']), 201);
    }

    public function show(UsuarioEdicion $usuarioEdicion): JsonResponse
    {
        return response()->json($usuarioEdicion->load(['usuario', 'edicion']));
    }

    public function update(Request $request, UsuarioEdicion $usuarioEdicion): JsonResponse
    {
        $data = $request->validate([
            'user_id'      => ['sometimes', 'integer', 'exists:users,id'],
            'edicion_id'   => ['sometimes', 'integer', 'exists:ediciones,id'],
            'estado'       => ['sometimes', Rule::in($this->estados)],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin'    => ['nullable', 'date'],
        ]);

        $usuarioEdicion->update($data);

        return response()->json($usuarioEdicion->load(['usuario', 'edicion']));
    }

    public function destroy(UsuarioEdicion $usuarioEdicion): JsonResponse
    {
        $usuarioEdicion->delete();

        return response()->json(['mensaje' => 'Registro de usuario y edición eliminado correctamente.']);
    }
}

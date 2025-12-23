<?php

namespace App\Http\Controllers;

use App\Models\Anotacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnotacionController extends Controller
{
    protected array $tipos = ['cita', 'idea', 'concepto', 'resumen'];

    public function index(): JsonResponse
    {
        $anotaciones = Anotacion::with(['usuario', 'obra', 'edicion', 'etiquetas'])->get();

        return response()->json($anotaciones);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'user_id'        => ['required', 'integer', 'exists:users,id'],
            'obra_id'        => ['required', 'integer', 'exists:obras,id'],
            'edicion_id'     => ['required', 'integer', 'exists:ediciones,id'],
            'tipo'           => ['required', Rule::in($this->tipos)],
            'contenido'      => ['required', 'string'],
            'cita'           => ['nullable', 'string'],
            'pagina_inicio'  => ['nullable', 'integer'],
            'pagina_fin'     => ['nullable', 'integer'],
            'etiqueta_ids'   => ['sometimes', 'array'],
            'etiqueta_ids.*' => ['integer', 'exists:etiquetas,id'],
        ]);

        $etiquetas = $data['etiqueta_ids'] ?? [];
        unset($data['etiqueta_ids']);

        $anotacion = Anotacion::create($data);

        if (!empty($etiquetas)) {
            $anotacion->etiquetas()->sync($etiquetas);
        }

        return response()->json($anotacion->load(['usuario', 'obra', 'edicion', 'etiquetas']), 201);
    }

    public function show(Anotacion $anotacion): JsonResponse
    {
        return response()->json($anotacion->load(['usuario', 'obra', 'edicion', 'etiquetas']));
    }

    public function update(Request $request, Anotacion $anotacion): JsonResponse
    {
        $data = $request->validate([
            'user_id'        => ['sometimes', 'integer', 'exists:users,id'],
            'obra_id'        => ['sometimes', 'integer', 'exists:obras,id'],
            'edicion_id'     => ['sometimes', 'integer', 'exists:ediciones,id'],
            'tipo'           => ['sometimes', Rule::in($this->tipos)],
            'contenido'      => ['sometimes', 'string'],
            'cita'           => ['nullable', 'string'],
            'pagina_inicio'  => ['nullable', 'integer'],
            'pagina_fin'     => ['nullable', 'integer'],
            'etiqueta_ids'   => ['sometimes', 'array'],
            'etiqueta_ids.*' => ['integer', 'exists:etiquetas,id'],
        ]);

        $etiquetas = $data['etiqueta_ids'] ?? null;
        unset($data['etiqueta_ids']);

        $anotacion->update($data);

        if (is_array($etiquetas)) {
            $anotacion->etiquetas()->sync($etiquetas);
        }

        return response()->json($anotacion->load(['usuario', 'obra', 'edicion', 'etiquetas']));
    }

    public function destroy(Anotacion $anotacion): JsonResponse
    {
        $anotacion->delete();

        return response()->json(['mensaje' => 'Anotación eliminada correctamente.']);
    }
}

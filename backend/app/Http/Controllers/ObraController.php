<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObraController extends Controller
{
    public function index(): JsonResponse
    {
        $obras = Obra::with(['autor', 'generos', 'ideologias', 'sagas', 'ediciones'])->get();

        return response()->json($obras);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'titulo'           => ['required', 'string', 'max:255'],
            'autor_id'         => ['required', 'integer', 'exists:autores,id'],
            'fuente_externa'   => ['nullable', 'string', 'max:255'],
            'id_externo'       => ['nullable', 'string', 'max:255'],
            'genero_ids'       => ['sometimes', 'array'],
            'genero_ids.*'     => ['integer', 'exists:generos,id'],
            'ideologia_ids'    => ['sometimes', 'array'],
            'ideologia_ids.*'  => ['integer', 'exists:ideologias,id'],
            'sagas'            => ['sometimes', 'array'],
            'sagas.*.id'       => ['required_with:sagas', 'integer', 'exists:sagas,id'],
            'sagas.*.orden'    => ['nullable', 'integer'],
        ]);

        $generoIds = $data['genero_ids'] ?? [];
        $ideologiaIds = $data['ideologia_ids'] ?? [];
        $sagas = $data['sagas'] ?? [];

        unset($data['genero_ids'], $data['ideologia_ids'], $data['sagas']);

        $obra = Obra::create($data);

        if (!empty($generoIds)) {
            $obra->generos()->sync($generoIds);
        }

        if (!empty($ideologiaIds)) {
            $obra->ideologias()->sync($ideologiaIds);
        }

        if (!empty($sagas)) {
            $obra->sagas()->sync($this->mapSagas($sagas));
        }

        return response()->json($obra->load(['autor', 'generos', 'ideologias', 'sagas', 'ediciones']), 201);
    }

    public function show(Obra $obra): JsonResponse
    {
        return response()->json($obra->load(['autor', 'generos', 'ideologias', 'sagas', 'ediciones']));
    }

    public function update(Request $request, Obra $obra): JsonResponse
    {
        $data = $request->validate([
            'titulo'           => ['sometimes', 'string', 'max:255'],
            'autor_id'         => ['sometimes', 'integer', 'exists:autores,id'],
            'fuente_externa'   => ['nullable', 'string', 'max:255'],
            'id_externo'       => ['nullable', 'string', 'max:255'],
            'genero_ids'       => ['sometimes', 'array'],
            'genero_ids.*'     => ['integer', 'exists:generos,id'],
            'ideologia_ids'    => ['sometimes', 'array'],
            'ideologia_ids.*'  => ['integer', 'exists:ideologias,id'],
            'sagas'            => ['sometimes', 'array'],
            'sagas.*.id'       => ['required_with:sagas', 'integer', 'exists:sagas,id'],
            'sagas.*.orden'    => ['nullable', 'integer'],
        ]);

        $generoIds = $data['genero_ids'] ?? null;
        $ideologiaIds = $data['ideologia_ids'] ?? null;
        $sagas = $data['sagas'] ?? null;

        unset($data['genero_ids'], $data['ideologia_ids'], $data['sagas']);

        $obra->update($data);

        if (is_array($generoIds)) {
            $obra->generos()->sync($generoIds);
        }

        if (is_array($ideologiaIds)) {
            $obra->ideologias()->sync($ideologiaIds);
        }

        if (is_array($sagas)) {
            $obra->sagas()->sync($this->mapSagas($sagas));
        }

        return response()->json($obra->load(['autor', 'generos', 'ideologias', 'sagas', 'ediciones']));
    }

    public function destroy(Obra $obra): JsonResponse
    {
        $obra->delete();

        return response()->json(['mensaje' => 'Obra eliminada correctamente.']);
    }

    protected function mapSagas(array $sagas): array
    {
        $pivotData = [];

        foreach ($sagas as $saga) {
            if (!isset($saga['id'])) {
                continue;
            }

            $pivotData[$saga['id']] = ['orden' => $saga['orden'] ?? null];
        }

        return $pivotData;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::all();
        return EquipmentResource::collection($equipment);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255|unique:equipment,name',
                'description' => 'nullable|string',
                'quantity' => 'required|integer|min:1',
                'weight' => 'nullable|numeric|min:0',
                'condition' => 'required|boolean',
                'type_id' => 'required|exists:types,id',
            ],
            [
                'name.required' => 'El nombre es obligatorio.',
                'name.unique' => 'Ya existe un equipo con ese nombre.',
                'quantity.required' => 'La cantidad es obligatoria.',
                'quantity.min' => 'La cantidad debe ser al menos 1.',
                'condition.required' => 'La condición es obligatoria.',
                'condition.boolean' => 'La condición debe ser verdadero o falso.',
                'type_id.exists' => 'El tipo seleccionado no es válido.',
            ]
        );

        $equipment = Equipment::create($validated);

        return response()->json(
            [
                'message' => 'Equipo creado exitosamente',
                'equipment' => $equipment,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $equipment = Equipment::find($id);

        if (!$equipment) {
            return response()->json([
                'message' => 'Equipo no encontrado'
            ], 404);
        }

        return new EquipmentResource($equipment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipment = Equipment::find($id);

        if (!$equipment) {
            return response()->json(
                [
                    'message' => 'Equipo no encontrado'
                ],
                404
            );
        }

        $validated = $request->validate(
            [
                'name' => 'sometimes|required|string|max:255|unique:equipment,name,' . $equipment->id,
                'description' => 'nullable|string',
                'quantity' => 'sometimes|required|integer|min:1',
                'weight' => 'sometimes|nullable|numeric|min:0',
                'condition' => 'sometimes|required|boolean',
                'type_id' => 'sometimes|required|exists:types,id',
            ]
        );

        $equipment->update($validated);

        return response()->json([
            'message' => 'Equipo actualizado exitosamente',
            'equipment' => $equipment,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipment = Equipment::find($id);

        if (!$equipment) {
            return response()->json([
                'message' => 'Equipo no encontrado'
            ], 404);
        }

        $equipment->delete();

        return response()->json([
            'mensage' => 'Equipo eliminado exitosamente'
        ], 200);
    }
}

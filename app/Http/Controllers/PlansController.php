<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlansResource;
use App\Models\Plans;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plans::all();
        return PlansResource::collection($plans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:plans,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Ya existe un plan con ese nombre.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número válido.',
            'price.min' => 'El precio no puede ser negativo.',
        ]);

        $plan = Plans::create($validated);

        return response()->json([
            'plan' => $plan,
            'message' => 'Plan creado exitosamente',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plan = Plans::where('id', $id)->first();

        if(!$plan) {
            return response()->json(['message' => 'Plan no encontrado'], 404);
        }
        
        return new PlansResource($plan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plan = Plans::where('id', $id)->first();

        if (!$plan) {
            return response()->json(['message' => 'Plan no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:plans,name,' . $plan->id,
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $plan->update($validated);

        return response()->json([
            'plan' => $plan,
            'message' => 'Plan actualizado exitosamente',
        ]);

        $plan->update($validated);

        return response()->json([
            'plan' => $plan,
            'message' => 'Plan actualizado exitosamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plans::where('id', $id)->first();

        if (!$plan) {
            return response()->json(['message' => 'Plan no encontrado'], 404);
        }

        $plan->delete();

        return response()->json(['message' => 'Plan eliminado exitosamente']);
    }
}

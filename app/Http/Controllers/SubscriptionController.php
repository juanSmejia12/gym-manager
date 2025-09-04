<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
                'user_id' => 'required|exists:users,id',
                'plan_id' => 'requiref|exists:plans,id',
                'status' => 'required|boolean',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ],
            [
                'user_id.required' => 'El ID de usuario es obligatorio.',
                'user_id.exists' => 'El usuario seleccionado no es válido.',
                'plan_id.required' => 'El ID del plan es obligatorio.',
                'plan_id.exists' => 'El plan seleccionado no es válido.',
                'status.required' => 'El estado es obligatorio.',
                'status.boolean' => 'El estado debe ser verdadero o falso.',
                'start_date.required' => 'La fecha de inicio es obligatoria.',
                'start_date.date' => 'La fecha de inicio no es una fecha válida.',
                'end_date.required' => 'La fecha de fin es obligatoria.',
                'end_date.date' => 'La fecha de fin no es una fecha válida.',
                'end_date.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',
            ]
        );

        $subscription = Subscription::create($validated);

        return response()->json(
            [
                'message' => 'Suscripción creada exitosamente',
                'subscription' => $subscription,
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

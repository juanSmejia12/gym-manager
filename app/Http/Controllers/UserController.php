<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UsersResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UsersResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'document' => 'required|integer|unique:users,document',
            'email' => 'required|email|unique:users,email',
            'email_verified_at	' => 'nullable|date',
            'password' => 'required|string|min:8',
            'remember_token' => 'nullable|string|max:100',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Ya existe un empleado con ese nombre.',
            'document.required' => 'El documento es obligatorio.',
            'document.unique' => 'Ya existe un empleado con ese documento.',
            'email.unique' => 'Ese correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $user = User::create($validated);

        return response()->json([
            'user' => $user,
            'message' => 'Usuario creado exitosamente',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $document)
    {
        $user = User::where('document', $document)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return new UsersResource($user);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $document)
    {
        $user = User::where('document', $document)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:users,name,' . $user->id,
            'document' => 'sometimes|required|integer|unique:users,document,' . $user->id,
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->update($validated);

        return response()->json([
            'user' => $user,
            'message' => 'Usuario actualizado exitosamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $document)
    {
        $user = User::where('document', $document)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado exitosamente']);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return EmployeeResource::collection($employees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:employees,name',
            'document' => 'required|integer|unique:employees,document',
            'email' => 'required|email|unique:employees,email',
            'role_id' => 'required|exists:roles,id',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.unique' => 'Ya existe un empleado con ese nombre.',
            'document.required' => 'El documento es obligatorio.',
            'document.unique' => 'Ya existe un empleado con ese documento.',
            'email.unique' => 'Ese correo ya está registrado.',
            'role_id.exists' => 'El rol seleccionado no es válido.',
        ]);

        $employee = Employee::create($validated);

        return response()->json([
            'employee' => $employee,
            'message' => 'Empleado creado exitosamente',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $document)
    {
        $employee = Employee::where('document', $document)->first();

        if (!$employee) {
            return response()->json([
                'message' => 'Empleado no encontrado'
            ], 404);
        }

        return new EmployeeResource($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $document)
    {
        $employee = Employee::where('document', $document)->first();

        if (!$employee) {
            return response()->json([
                'message' => 'Empleado no encontrado'
            ], 404);
        }

        // Validar datos 
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'document' => 'sometimes|required|integer|unique:employees,document,' . $employee->id,
            'email' => 'sometimes|required|email|unique:employees,email,' . $employee->id,
            'role_id' => 'sometimes|required|exists:roles,id',
        ]);

        // Actualizar empleado
        $employee->update($validated);

        return response()->json([
            'message' => 'Empleado actualizado exitosamente',
            'employee' => $employee
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $document)
    {
        $employee = Employee::where('document', $document)->first();

        if (!$employee) {
            return response()->json([
                'message' => 'Empleado no encontrado'
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'message' => 'Empleado eliminado exitosamente'
        ], 200);
    }
}

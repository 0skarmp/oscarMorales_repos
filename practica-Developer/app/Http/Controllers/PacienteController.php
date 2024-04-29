<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
class PacienteController extends Controller
{


    public function index()
    {
        // Si obtenemos todos los pacientes, retornamos la respuesta exitosa
        $pacientes = Paciente::all();
        return response()->json($pacientes, 200);
    }

    public function show($id)
    {
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }
        return response()->json($paciente, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            // Aquí puedes agregar más validaciones según tus requisitos
        ]);

        $paciente = new Paciente();
        $paciente->nombre = $request->nombre;
        $paciente->apellido = $request->apellido;
        // Aquí puedes asignar más campos según tu tabla de pacientes
        $paciente->save();

        return response()->json($paciente, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            // Aquí puedes agregar más validaciones según tus requisitos
        ]);

        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        $paciente->nombre = $request->nombre;
        $paciente->apellido = $request->apellido;
        // Aquí puedes actualizar más campos según tu tabla de pacientes
        $paciente->save();

        return response()->json($paciente, 200);
    }

    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        $paciente->delete();

        return response()->json(['message' => 'Paciente eliminado correctamente'], 204);
    }
}


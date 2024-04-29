<?php

namespace App\Http\Controllers;

use App\Models\CentroMedico;
use Illuminate\Http\Request;

class CentroMedicoController extends Controller
{
    public function index()
    {
        $centromedicos = CentroMedico::all();

        return response()->json($centromedicos);
    }
}

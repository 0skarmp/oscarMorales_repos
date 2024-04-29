<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\MedicalTest;

class OrderController extends Controller
{
    // Método para almacenar una nueva orden
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'medical_tests' => 'required|array',
            'medical_tests.*.id' => 'exists:medical_tests,id',
        ]);

        // Generación de un código de orden aleatorio
        $orderCode = 'ORD-' . strtoupper(substr(uniqid(), -6));

        // Calcular el precio total de la orden
        $totalPrice = 0;
        foreach ($request->medical_tests as $medicalTest) {
            $test = MedicalTest::findOrFail($medicalTest['id']);
            $totalPrice += $test->price;
        }

        // Crear la orden en la base de datos
        $order = new Order();
        $order->code = $orderCode;
        $order->patient_id = $request->patient_id;
        $order->doctor_id = $request->doctor_id;
        $order->total_price = $totalPrice;
        $order->user_id = auth()->id(); // Asociar el usuario de la sesión actual
        $order->save();

        // Asociar los exámenes a la orden en la tabla pivot
        foreach ($request->medical_tests as $medicalTest) {
            $order->medicalTests()->attach($medicalTest['id']);
        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('orders.index')->with('success', 'La orden se ha creado correctamente.');
    }

    // Método para mostrar el formulario de creación de una orden
    public function create()
    {
        // Lógica para cargar los pacientes y médicos disponibles en el formulario
        $patients = Patient::all();
        $doctors = Doctor::all();
        $medicalTests = MedicalTest::all();
        
        return view('orders.create', compact('patients', 'doctors', 'medicalTests'));
    }

    // Método para mostrar la lista de órdenes existentes
    public function index()
    {
        // Lógica para recuperar y mostrar la lista de órdenes
        $orders = Order::all();
        
        return view('orders.index', compact('orders'));
    }
}

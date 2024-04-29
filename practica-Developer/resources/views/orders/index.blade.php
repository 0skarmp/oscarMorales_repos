<div>
    <!-- Life is available only in the present moment. - Thich Nhat Hanh -->
    @extends('layouts.app')

@section('content')
    <h1>Listado de Órdenes</h1>

    <a href="{{ route('orders.create') }}">Crear Nueva Orden</a>

    <table>
        <thead>
            <tr>
                <th>Código de Orden</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->code }}</td>
                    <td>{{ $order->patient->name }}</td>
                    <td>{{ $order->doctor->name ?? 'No Asignado' }}</td>
                    <td>{{ $order->total_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

</div>

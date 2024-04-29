<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    @extends('layouts.app')

@section('content')
    <h1>Crear nueva orden</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <!-- Aquí irán los campos del formulario para crear una orden -->

        <button type="submit">Crear Orden</button>
    </form>
@endsection

</div>

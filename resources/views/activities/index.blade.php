@extends('layouts.app')

@section('content')
    <h1>Listado de Actividades</h1>

    <a href="{{ route('activities.create') }}" class="btn btn-primary">Crear Nueva Actividad</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Cupo Total</th>
                <th>Cupo Disponible</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity['activityId'] }}</td>
                    <td>{{ $activity['name'] }}</td>
                    <td>{{ $activity['description'] }}</td>
                    <td>{{ $activity['reservationDate'] }}</td>
                    <td>{{ $activity['totalCapacity'] }}</td>
                    <td>{{ $activity['availableCapacity'] }}</td>
                    <td>
                        <a href="{{ route('activities.edit', $activity['activityId']) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('activities.destroy', $activity['activityId']) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

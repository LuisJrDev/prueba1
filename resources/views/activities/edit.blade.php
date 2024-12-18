@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($activity) ? 'Editar Actividad' : 'Crear Actividad' }}</h1>
    <form action="{{ isset($activity) ? route('activities.update', $activity['activityId']) : route('activities.store') }}" method="POST">
        @csrf
        @if(isset($activity))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $activity['name'] ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control" required>{{ $activity['description'] ?? '' }}</textarea>
        </div>

        <div class="form-group">
            <label for="reservationDate">Fecha de Reserva</label>
            <input type="date" name="reservationDate" class="form-control" value="{{ $activity['reservationDate'] ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="totalCapacity">Capacidad Total</label>
            <input type="number" name="totalCapacity" class="form-control" value="{{ $activity['totalCapacity'] ?? '' }}" required>
        </div>

        <div class="form-group">
            <label for="availableCapacity">Capacidad Disponible</label>
            <input type="number" name="availableCapacity" class="form-control" value="{{ $activity['availableCapacity'] ?? '' }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">{{ isset($activity) ? 'Actualizar' : 'Guardar' }}</button>
    </form>
</div>
@endsection

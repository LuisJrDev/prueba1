@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Actividad</h1>

    <form action="{{ route('activities.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Descripción</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="reservationDate">Fecha</label>
            <input type="date" name="reservationDate" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="totalCapacity">Cupo Total</label>
            <input type="number" name="totalCapacity" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="availableCapacity">Cupo Disponible</label>
            <input type="number" name="availableCapacity" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('activities.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection

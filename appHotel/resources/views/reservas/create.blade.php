@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Criar Nova Reserva</h1>
        <p class="text-muted">Preencha os dados abaixo para adicionar uma nova reserva.</p>
    </div>

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome_hospede" class="form-label">Nome do Hospede</label>
            <input type="text" class="form-control" id="nome_hospede" name="nome_hospede" required>
        </div>
        <div class="mb-3">
            <label for="data_checkin" class="form-label">Data de Check-in</label>
            <input type="date" class="form-control" id="data_checkin" name="data_checkin" required>
        </div>
        <div class="mb-3">
            <label for="data_checkout" class="form-label">Data de Check-out</label>
            <input type="date" class="form-control" id="data_checkout" name="data_checkout" required>
        </div>
        <button type="submit" class="btn btn-success">Criar Reserva</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection

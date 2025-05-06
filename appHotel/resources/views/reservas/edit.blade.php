@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Editar Reserva</h1>
        <p class="text-muted">Atualize os detalhes da reserva.</p>
    </div>

    <!-- Exibir mensagens de sucesso ou erro -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulário para editar a reserva -->
    <form action="{{ route('reservas.update', $reserva['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome_hospede" class="form-label">Nome do Hóspede</label>
            <input type="text" class="form-control @error('nome_hospede') is-invalid @enderror" id="nome_hospede" name="nome_hospede" value="{{ old('nome_hospede', $reserva['nome_hospede']) }}" required>
            @error('nome_hospede')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="data_checkin" class="form-label">Data de Check-in</label>
            <input type="date" class="form-control @error('data_checkin') is-invalid @enderror" id="data_checkin" name="data_checkin" value="{{ old('data_checkin', $reserva['data_checkin']) }}" required>
            @error('data_checkin')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="data_checkout" class="form-label">Data de Check-out</label>
            <input type="date" class="form-control @error('data_checkout') is-invalid @enderror" id="data_checkout" name="data_checkout" value="{{ old('data_checkout', $reserva['data_checkout']) }}" required>
            @error('data_checkout')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Atualizar Reserva</button>
        </div>
    </form>
</div>
@endsection

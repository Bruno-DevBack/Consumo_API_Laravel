@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Quarto</h2>
    <form action="{{ route('quartos.update', $quarto['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="numero" class="form-label">Número do Quarto</label>
            <input type="text" class="form-control" id="numero" name="numero" value="{{ $quarto['numero'] }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $quarto['tipo'] }}" required>
        </div>
        <div class="mb-3">
            <label for="preco_diaria" class="form-label">Preço da Diária</label>
            <input type="number" class="form-control" id="preco_diaria" name="preco_diaria" value="{{ $quarto['preco_diaria'] }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Quarto</button>
    </form>
</div>
@endsection

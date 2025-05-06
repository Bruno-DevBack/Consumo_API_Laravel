@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Criar Quarto</h2>
    <form action="{{ route('quartos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="numero" class="form-label">Número do Quarto</label>
            <input type="text" class="form-control" id="numero" name="numero" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required>
        </div>
        <div class="mb-3">
            <label for="preco_diaria" class="form-label">Preço da Diária</label>
            <input type="number" class="form-control" id="preco_diaria" name="preco_diaria" required>
        </div>
        <button type="submit" class="btn btn-primary">Criar Quarto</button>
    </form>
</div>
@endsection

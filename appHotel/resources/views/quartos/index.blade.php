@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Lista de Quartos</h1>
        <p class="text-muted">Veja abaixo os quartos disponíveis.</p>
    </div>

    <!-- Botão para Adicionar Novo Quarto -->
    <div class="text-center mb-4">
        <a href="{{ route('quartos.create') }}" class="btn btn-success btn-lg">Adicionar Novo Quarto</a>
    </div>

    <div class="row">
        @foreach($quartos as $quarto)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">Quarto #{{ $quarto['numero'] }}</h5>
                    <p class="card-text">
                        Tipo: {{ $quarto['tipo'] }}<br>
                        Preço: R$ {{ number_format($quarto['preco_diaria'], 2, ',', '.') }} / noite
                    </p>
                    <a href="{{ route('quartos.edit', $quarto['id']) }}" class="btn btn-primary btn-sm">Editar</a>

                    <!-- Formulário de Exclusão com Confirmação -->
                    <form action="{{ route('quartos.destroy', $quarto['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este quarto?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

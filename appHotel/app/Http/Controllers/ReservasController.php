<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReservasController extends Controller
{
    private $urlApi = 'http://127.0.0.1:8000/api/reservas';

    // Listar todas as reservas
    public function index()
    {
        $response = Http::get($this->urlApi);

        if ($response->failed()) {
            return view('reservas.index', [
                'reservas' => [],
                'message' => 'Erro ao carregar as reservas. Tente novamente mais tarde.'
            ]);
        }

        $data = $response->json();
        
        // Se não houver dados ou erro, garantimos uma boa resposta
        if (isset($data['success']) && !$data['success']) {
            return view('reservas.index', [
                'reservas' => [],
                'message' => $data['message'] ?? 'Erro desconhecido ao carregar as reservas.'
            ]);
        }

        return view('reservas.index', [
            'reservas' => $data['data'] ?? [],
            'message' => $data['message'] ?? ''
        ]);
    }

    // Exibir formulário de criação
    public function create()
    {
        return view('reservas.create');
    }

    // Armazenar nova reserva
    public function store(Request $request)
    {
        $response = Http::post($this->urlApi, $request->only('nome_hospede', 'data_checkin', 'data_checkout'));

        if ($response->successful()) {
            return redirect()->route('reservas.index')->with('success', 'Reserva cadastrada com sucesso!');
        }

        $data = $response->json();
        $errorMessage = $data['message'] ?? 'Erro ao cadastrar a reserva. Tente novamente mais tarde.';

        return redirect()->route('reservas.create')->with('error', $errorMessage);
    }

    // Exibir formulário de edição
    public function edit($id)
    {
        $response = Http::get("{$this->urlApi}/{$id}");
        $reserva = $response->json()['data'] ?? null;

        if (!$reserva) {
            return redirect()->route('reservas.index')->with('error', 'Reserva não encontrada.');
        }

        return view('reservas.edit', compact('reserva'));
    }

    // Atualizar reserva
    public function update(Request $request, $id)
    {
        $response = Http::put("{$this->urlApi}/{$id}", $request->only('nome_hospede', 'data_checkin', 'data_checkout'));

        if ($response->successful()) {
            return redirect()->route('reservas.index')->with('success', 'Reserva atualizada com sucesso!');
        }

        $data = $response->json();
        $errorMessage = $data['message'] ?? 'Erro ao atualizar a reserva. Tente novamente mais tarde.';

        return redirect()->route('reservas.edit', $id)->with('error', $errorMessage);
    }

    // Excluir reserva
    public function destroy($id)
    {
        $response = Http::delete("{$this->urlApi}/{$id}");

        if ($response->successful()) {
            return redirect()->route('reservas.index')->with('success', 'Reserva excluída com sucesso!');
        }

        $data = $response->json();
        $errorMessage = $data['message'] ?? 'Erro ao excluir a reserva. Tente novamente mais tarde.';

        return redirect()->route('reservas.index')->with('error', $errorMessage);
    }
}

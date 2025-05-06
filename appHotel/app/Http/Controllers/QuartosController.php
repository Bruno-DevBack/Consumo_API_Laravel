<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuartosController extends Controller
{
    // Definindo a URL base da API de quartos
    private $urlApi = 'http://127.0.0.1:8000/api/quartos';

    /**
     * Exibir a lista de quartos.
     */
    public function index()
    {
        // Requisição GET à API para pegar todos os quartos
        $response = Http::get($this->urlApi);
        $data = $response->json();

        // Verificando se a resposta foi bem-sucedida
        if (!$response->successful()) {
            return view('quartos.index', [
                'message' => 'Erro ao carregar os quartos.'
            ]);
        }

        // Passando os dados para a view
        return view('quartos.index', [
            'quartos' => $data['data'] ?? [],
            'message' => $data['message'] ?? ''
        ]);
    }

    /**
     * Exibir o formulário de criação de quarto.
     */
    public function create()
    {
        return view('quartos.create');
    }

    /**
     * Armazenar um novo quarto.
     */
    public function store(Request $request)
    {
        // Enviando dados via POST para a API
        $response = Http::post($this->urlApi, $request->only('numero', 'tipo', 'preco_diaria'));

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return redirect()->route('quartos.index');
        } else {
            return redirect()->route('quartos.create')->with('error', 'Erro ao cadastrar o quarto.');
        }
    }

    /**
     * Exibir o formulário de edição de quarto.
     */
    public function edit($id)
    {
        // Requisição GET à API para pegar o quarto por ID
        $response = Http::get("$this->urlApi/$id");
        $quarto = $response->json()['data'] ?? null;

        // Verificando se o quarto foi encontrado
        if (!$quarto) {
            return redirect()->route('quartos.index')->with('error', 'Quarto não encontrado.');
        }

        // Passando o quarto para a view de edição
        return view('quartos.edit', compact('quarto'));
    }

    /**
     * Atualizar um quarto existente.
     */
    public function update(Request $request, $id)
    {
        // Enviando dados via PUT para a API
        $response = Http::put("$this->urlApi/$id", $request->only('numero', 'tipo', 'preco_diaria'));

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return redirect()->route('quartos.index');
        } else {
            return redirect()->route('quartos.edit', $id)->with('error', 'Erro ao atualizar o quarto.');
        }
    }

    /**
     * Excluir um quarto.
     */
    public function destroy($id)
    {
        // Enviando requisição DELETE para a API
        $response = Http::delete("$this->urlApi/$id");

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return redirect()->route('quartos.index');
        } else {
            return redirect()->route('quartos.index')->with('error', 'Erro ao excluir o quarto.');
        }
    }

    /**
     * Listar quartos com paginação.
     */
    public function listar(Request $request)
    {
        // Requisição GET para a API com paginação
        $response = Http::get($this->urlApi, [
            'page' => $request->input('page', 1) // Pega o número da página da requisição
        ]);

        // Se a resposta da API falhar, retorna um erro
        if (!$response->successful()) {
            return response()->json(['message' => 'Erro ao carregar os quartos.'], 500);
        }

        // Retorna os quartos com paginação no formato JSON
        return response()->json($response->json());
    }
}

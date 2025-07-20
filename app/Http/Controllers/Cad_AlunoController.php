<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alunos;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Cad_AlunoController extends Controller
{
    // Cadastrar aluno com senha aleatória
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:aluno_cadastrado,email',
            'turma_id' => 'required|exists:turma_cadastrada,id',
        ]);

        // Geração de senha aleatória (8 caracteres)
        $senhaGerada = Str::random(8);

        // Cadastro do aluno
        Alunos::create([
            'nome_aluno' => $request->nome,
            'email' => $request->email,
            'password' => $senhaGerada, // sem criptografar
            'turma_id' => $request->turma_id,
            'user_id' => auth()->id(), // salva quem cadastrou
        ]);

        // Redirecionar com a senha visível
        return redirect()->back()->with('success', 'Aluno cadastrado com sucesso! Senha: ' . $senhaGerada);
    }

    // Listar alunos (ex: histórico)
    public function index()
    {
        $alunos = Alunos::where('user_id', auth()->id())->get(); // ✅ correto
        Log::info($alunos); // Agora funciona
        return view('historico', compact('alunos'));
    }
}

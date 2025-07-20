<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alunos;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Cad_AlunoController extends Controller
{
    // Cadastrar aluno e associar com turmas (senha única para todas)
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'turma_id' => 'required|exists:turma_cadastrada,id', // permite várias turmas
            'turma_id.*' => 'exists:turma_cadastrada,id',
        ]);

        // Verifica se o aluno já existe
        $aluno = Alunos::where('email', $request->email)->first();

        if (!$aluno) {
            // Criar novo aluno com senha aleatória
            $senhaGerada = Str::random(8);

            $aluno = Alunos::create([
                'nome_aluno' => $request->nome,
                'email' => $request->email,
                'password' => $senhaGerada, // salvar direto, ou criptografar se necessário
                'user_id' => auth()->id(),
            ]);

            $novaSenha = $senhaGerada;
        } else {
            // Aluno já existe
            $novaSenha = $aluno->senha;
        }
        

        // Relacionar com as turmas (sem remover anteriores)
        $aluno->turmas()->syncWithoutDetaching($request->turma_id);

        return redirect()->back()->with('success', 'Aluno vinculado com sucesso!');
    }

    // (opcional) Mostrar alunos do professor logado
    public function index()
    {
        $alunos = Alunos::where('user_id', auth()->id())->get();
        Log::info($alunos);
        return view('historico', compact('alunos'));
    }
}

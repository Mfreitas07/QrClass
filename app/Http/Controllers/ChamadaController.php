<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Chamada;
use App\Models\Presenca;
use App\Models\Alunos;
use App\Models\TurmaCadastrada;

class ChamadaController extends Controller
{
    public function gerar($turma_id)
    {
        $codigo = Str::uuid();

        $chamada = Chamada::create([
            'codigo' => $codigo,
            'turma_id' => $turma_id,
        ]);

        return redirect()->route('chamada.painel', $chamada->id);
    }

    public function painelChamada($chamada_id)
    {
        $chamada = Chamada::with('turma')->findOrFail($chamada_id);
        $link = route('chamada.verificar', $chamada->codigo);
        $presencas = Presenca::with('aluno')->where('chamada_id', $chamada_id)->get();

        return view('painel-chamada', compact('chamada', 'link', 'presencas'));
    }

    public function registrarPresenca($codigo)
    {
        if (!session()->has('aluno_id')) {
            return redirect('/login')->with('erro', 'Você precisa estar logado como aluno.');
        }

        $aluno_id = session('aluno_id');
        $chamada = Chamada::where('codigo', $codigo)->first();

        if (!$chamada) {
            return 'Código inválido.';
        }

        $jaMarcado = Presenca::where('aluno_id', $aluno_id)
            ->where('chamada_id', $chamada->id)
            ->exists();

        if ($jaMarcado) {
            return 'Presença já registrada!';
        }

        Presenca::create([
            'aluno_id' => $aluno_id,
            'chamada_id' => $chamada->id,
        ]);

        return view('confirmacao');
    }

    public function exibirTelaDeChamada()
{
    $turmas = TurmaCadastrada::all();
    return view('chamada', compact('turmas'));
}
}
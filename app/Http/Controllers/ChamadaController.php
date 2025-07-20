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
            'user_id' => auth()->id(),
            'data_aula' => now(),
        ]);

        return redirect()->route('chamada.painel', $chamada->id);
    }

    public function painelChamada($chamada_id)
    {
        $chamada = Chamada::with('turma')
            ->where('user_id', auth()->id())
            ->findOrFail($chamada_id);

        $link = route('chamada.verificar', $chamada->codigo);

        $presencas = Presenca::with('aluno')
            ->where('chamada_id', $chamada_id)
            ->get();

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
            'horario' => now(),
        ]);

        return view('confirmacao');
    }

    public function exibirTelaDeChamada()
    {
        // Somente turmas do professor logado
        $turmas = TurmaCadastrada::where('user_id', auth()->id())->get();
        return view('chamada', compact('turmas'));
    }

    public function presencasJson($id)
    {
        $presencas = Presenca::where('chamada_id', $id)
            ->with('aluno')
            ->get();

        $dados = $presencas->map(function ($p) {
            return [
                'nome' => $p->aluno->nome_aluno,
                'horario' => $p->horario->format('H:i'),
            ];
        });

        return response()->json($dados);
    }

    public function filtroPorDataETurma()
    {
        $turmas = TurmaCadastrada::where('user_id', auth()->id())->get();
        return view('filtroChamadaDataTurma', compact('turmas'));
    }

    public function resultadoFiltro(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'turma_id' => 'required|exists:turma_cadastrada,id',
        ]);

        $dataSelecionada = $request->input('data');
        $turmaId = $request->input('turma_id');

        $chamadas = Chamada::with('turma')
            ->whereDate('data_aula', $dataSelecionada)
            ->where('turma_id', $turmaId)
            ->where('user_id', auth()->id())
            ->orderBy('data_aula', 'asc')
            ->get();

        return view('resultadoChamadaDataTurma', compact('chamadas', 'dataSelecionada'));
    }
}
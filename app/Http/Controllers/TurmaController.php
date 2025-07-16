<?php

namespace App\Http\Controllers;

// --- IMPORTAÇÕES NECESSÁRIAS ---
use App\Models\Alunos; // Modelo para interagir com a tabela de alunos.
use App\Models\Turma; // Modelo para interagir com a tabela de turmas.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Para registrar informações em logs.
use Illuminate\View\View; // Para o type-hinting de retorno nos métodos que retornam uma view.
use Illuminate\Http\RedirectResponse; // Para o type-hinting de retorno nos métodos que redirecionam.
use App\Models\TurmaCadastrada;

class TurmaController extends Controller
{
    /**
     * Salva uma NOVA TURMA no banco de dados.
     * Rota: POST /turmas
     */
    public function store(Request $request): RedirectResponse
    {
        // Validação dos dados do formulário de turma
        $request->validate([
            'curso' => 'required|string|max:255',
            'turma' => 'required|string|max:255',
        ]);

        // Criação da turma
        Turma::create([
            'curso' => $request->curso,
            'turma' => $request->turma,
        ]);

        // Redirecionar com mensagem de sucesso
        return redirect()->back()->with('success', 'Turma cadastrada com sucesso!');
    }

    /**
     * Exibe o histórico/lista de turmas cadastradas.
     * Rota: GET /historico
     */
    public function index(): View
    {
        $turmas = Turma::orderBy('curso')->get(); // Pega todas as turmas, ordenadas por curso.
        $alunos = Alunos::all();
        // O Log deve vir antes do 'return' para ser executado.
        Log::info('Listagem de turmas carregada.', ['turmas_count' => $turmas->count()]);

        return view('historico')->with('turmas', $turmas)->with('alunos', $alunos);
    }

/**
     * Mostra o formulário para cadastrar um novo aluno.
     * Esta função busca as turmas no banco para preencher o <select> no formulário.
     * Rota: GET /cadastrar-aluno
     */
    public function create(): View
    {
        // Buscar todas as turmas para que o usuário possa escolher uma.
        $turmas = Turma::orderBy('curso')->get();

        // Retornar a view do formulário, passando a lista de turmas para ela.
        return view('cadastrarAluno', compact('turmas'));
    }

    /**
     * Salva um NOVO ALUNO no banco de dados, associando-o a uma turma.
     * Rota: POST /cadastrar-aluno
     */
    public function storeAluno(Request $request): RedirectResponse
    {
        // Validação dos dados do formulário de aluno.
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:aluno_cadastrado,email', // 'alunos' é o nome da sua tabela de alunos
            'turma_id' => 'required|exists:turma_cadastrada,id' // Confirma que a turma selecionada existe
        ]);

        // Criação do aluno no banco de dados.
        Alunos::create([
            'nome_aluno' => $request->nome,
            'email' => $request->email,
            'turma_id' => $request->turma_id, // Salva o ID da turma para criar o relacionamento
        ]);

        Alunos::create([
            'nome_aluno' => $request->nome,
            'email' => $request->email,
            'turma_id' => $request->turma_id, // Salva o ID da turma para criar o relacionamento
        ]);


        // Redireciona de volta para a página anterior com uma mensagem de sucesso.
        return redirect()->back()->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function historico(Request $request)
{
    $turmas = TurmaCadastrada::all();
    $alunos = [];

    if ($request->filled('turma_id')) {
        $turma = TurmaCadastrada::find($request->turma_id);
        $alunos = $turma ? $turma->alunos : [];
    }

    return view('historico', compact('turmas', 'alunos'));
}


public function gerenciarTurma()
{
    $turmas = TurmaCadastrada::all(); // pega todas as turmas do banco
    return view('gerenciarTurma', compact('turmas'));
}

}//

 
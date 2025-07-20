<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\Cad_AlunoController;
use App\Http\Controllers\ChamadaController;
use App\Http\Controllers\LinkPlataformaController; // <-- IMPORTADO

/*
|--------------------------------------------------------------------------
| Rotas públicas (acesso geral)
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('welcome'));

Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.process');

Route::get('/register', fn() => view('register'))->name('register');
Route::post('/store', [UserController::class, 'register'])->name('store');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/recuperar-senha', fn() => view('recuperarsenha'))->name('recuperarsenha');
Route::get('/recuperar-senha2', fn() => view('recuperarsenha2'))->name('recuperarsenha2');

/*
|--------------------------------------------------------------------------
| Painel do Aluno e Logout (sem middleware)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard-aluno', function () {
    if (!session()->has('aluno_id')) {
        return redirect('/login')->with('erro', 'Você precisa estar logado como aluno.');
    }
    return view('aluno');
})->name('aluno');

Route::post('/logout-aluno', function () {
    session()->forget('aluno_id');
    return redirect('/login')->with('mensagem', 'Logout realizado com sucesso!');
})->name('aluno.logout');

/*
|--------------------------------------------------------------------------
| Página de escaneamento (QR Code do aluno)
|--------------------------------------------------------------------------
*/

Route::get('/scan-aluno', fn() => view('scanaluno'))->name('scan.aluno');
Route::get('/confirmacao', fn() => view('confirmacao'))->name('confirmacao'); // opcional

/*
|--------------------------------------------------------------------------
| Link da Plataforma do Professor (Aluno acessa publicamente)
|--------------------------------------------------------------------------
*/

// Aluno acessa o link mais recente salvo pelo professor
Route::get('/aluno/link', function () {
    $link = \App\Models\LinkPlataforma::latest()->first();
    if ($link) {
        return redirect($link->link);
    } else {
        return "Nenhum link disponível no momento.";
    }
})->name('aluno.link');

/*
|--------------------------------------------------------------------------
| Rotas protegidas por autenticação (professor logado)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Dashboard do professor
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // 👨‍🏫 Turmas
    Route::get('/gerenciar-turma', [TurmaController::class, 'gerenciarTurma'])->name('gerenciar.turma');
    Route::get('/cadastrar-turma', fn() => view('cadastrarTurma'))->name('cadastrar.turma');
    Route::post('/registro-turma', [TurmaController::class, 'store'])->name('turma.store');

    // 📚 Histórico
    Route::get('/historico', [TurmaController::class, 'historico'])->name('historico.index');

    // 📎 Links do professor (salvo no banco de dados)
    Route::get('/adicionar-link', [LinkPlataformaController::class, 'showForm'])->name('link.form');
    Route::post('/adicionar-link', [LinkPlataformaController::class, 'salvar'])->name('link.salvar');

    // 👨‍🎓 Alunos
    Route::get('/cadastrar-aluno', function () {
        $turmas = \App\Models\TurmaCadastrada::where('user_id', auth()->id())->get();
        return view('cadastrarAluno', compact('turmas'));
    })->name('aluno.create');

    Route::post('/cadastrar-aluno', [Cad_AlunoController::class, 'store'])->name('aluno.store');
    Route::get('/listar-alunos', [Cad_AlunoController::class, 'index'])->name('aluno.index');
});

/*
|--------------------------------------------------------------------------
| Chamadas (presença com QR Code)
|--------------------------------------------------------------------------
*/

// Página com botões de gerar QR por turma
Route::get('/Gerar-chamada', [ChamadaController::class, 'exibirTelaDeChamada'])->name('chamada');

// Gerar QR Code para uma turma específica
Route::get('/chamada/gerar/{turma_id}', [ChamadaController::class, 'gerar'])->name('chamada.gerar');

// Painel da chamada gerada com QR e lista de presença
Route::get('/painel-chamada/{chamada_id}', [ChamadaController::class, 'painelChamada'])->name('chamada.painel');

// Registro da presença via leitura do QR Code
Route::get('/presenca/{codigo}', [ChamadaController::class, 'registrarPresenca'])->name('chamada.verificar');

// Redirecionamento interno via formulário
Route::get('/chamada/gerar-redirect', function (Illuminate\Http\Request $request) {
    return redirect()->route('chamada.gerar', $request->turma_id);
})->name('chamada.gerar.redirect');

// Dados da chamada em JSON
Route::get('/chamada/{id}/presencas-json', [ChamadaController::class, 'presencasJson'])->name('chamada.presencasJson');

// Filtro por data e turma
Route::get('/filtro-chamadas', [ChamadaController::class, 'filtroPorDataETurma'])->name('chamada.filtro');
Route::post('/filtro-chamadas', [ChamadaController::class, 'resultadoFiltro'])->name('chamada.resultado');

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="{{ asset('css/cadastraraluno.css') }}">
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <h1>Cadastro de Aluno</h1>
        </div>

        {{-- Mensagem de sucesso com senha gerada --}}
        @if (session('success'))
            <div class="alert success" style="color: #f72585; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('aluno.store') }}" method="POST" class="formCadastro">
            @csrf

            <label for="nome">Nome completo</label>
            <input type="text" id="nome" name="nome" required>

            <label for="turma">Turma</label>
            <select id="turma" name="turma_id" required>
                <option value="">Selecione uma turma</option>
              @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">{{ $turma->curso }} - {{ $turma->turma }}</option>
                @endforeach
            </select>


            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <button type="submit" class="btn">Cadastrar</button>

            <a href="{{ url('gerenciar-turma') }}">
                <img src="{{ asset('img/seta.png') }}" alt="Voltar">
            </a>
        </form>
    </div>
</body>
</html>

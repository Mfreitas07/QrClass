<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/escolherturma.css') }}">
    <title>Professor</title>
</head>
<body>
    <div class="top-bar"> 
        <img src="{{ asset('img/professor.png') }}" alt="professor img">
        <h1>Professor / Gerenciar Turma</h1>
    </div>  

    <div class="access">
        <a class="btn Turma" href="{{ route('cadastrar.turma') }}">Cadastrar Turma</a>
        <a class="btn Aluno" href="{{ route('aluno.create') }}">Cadastrar Aluno</a>
        <a class="btn Históricos" href="{{ route('historico.index') }}">Histórico</a>
        <a class="btn Chamada" href="{{ route('chamada') }}">Chamada</a>
    </div>

    <a href="{{ route('dashboard') }}" class="voltar-btn">
        <img src="{{ asset('img/seta.png') }}" alt="Voltar">
    </a>
</body>
</html>

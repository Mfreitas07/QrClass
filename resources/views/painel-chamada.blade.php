<!DOCTYPE html>
<html>
<head>
    <title>Painel de Chamada</title>
</head>
<body>
    <h1>QR Code - Chamada {{ $chamada->turma->curso }} {{ $chamada->turma->turma }}</h1>
    <p>{{ $chamada->data_aula->format('d/m/Y H:i') }}</p>

    <div>
        {!! QrCode::size(250)->generate($link) !!}
    </div>

    <p>Ou acesse: <a href="{{ $link }}">{{ $link }}</a></p>

    <h2>Alunos Presentes</h2>
    <ul>
        @forelse ($presencas as $presenca)
            <li>{{ $presenca->aluno->nome_aluno }} ({{ $presenca->horario->format('H:i') }})</li>
        @empty
            <li>Nenhum aluno ainda</li>
        @endforelse
    </ul>
</body>
</html>

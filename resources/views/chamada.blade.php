<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor - Chamada</title>
    <link rel="stylesheet" href="{{ asset('css/chamada.css') }}">
</head>
<body>
    <!-- Barra superior -->
    <div class="top-bar"> 
        <img src="{{ asset('img/professor.png') }}" alt="professor img">
        <h1>Professor / Chamada</h1>
    </div>  

    <!-- Conteúdo principal -->
    <h2>Gerar QR Code de Presença</h2>

    @if(isset($turmas) && count($turmas) > 0)
        <form method="GET" action="{{ route('chamada.gerar.redirect') }}" class="form-turma">
            <select name="turma_id" required>
                <option value="">Selecione uma turma</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">{{ $turma->curso }} - {{ $turma->turma }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn">Gerar QR Code</button>
           <a class="btn chamada-link" href="{{ route('chamada.filtro') }}">chamadas anteriores</a>
        </form>
    @else
        <p>Nenhuma turma cadastrada ainda.</p>
    @endif

    <!-- Botão de voltar -->
    <a href="{{ route('gerenciar.turma') }}" class="voltar-btn">
        <img src="{{ asset('img/seta.png') }}" alt="Voltar">
    </a>
</body>
</html>

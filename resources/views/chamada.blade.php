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
        <h1>Professor / Chamada</h1>
    </div>  
    <div>
         <h2>Gerar QR Code de Presença</h2>
        @if(isset($turmas) && count($turmas) > 0)
            @foreach ($turmas as $turma)
                <a class="btn gerar-chamada" href="{{ route('chamada.gerar', $turma->id) }}">
                    {{ $turma->curso }} - {{ $turma->turma }}
                </a>
            @endforeach
        @else
            <p>Nenhuma turma cadastrada ainda.</p>
        @endif
    
    </div>
    <a href="{{ route('dashboard') }}" class="voltar-btn">
        <img src="{{ asset('img/seta.png') }}" alt="Voltar">
    </a>
</body>
</html>

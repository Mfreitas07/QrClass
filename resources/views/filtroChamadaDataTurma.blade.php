<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Filtrar Chamadas</title>
    <link rel="stylesheet" href="{{ asset('css/filtrar-chamadas.css') }}" />
</head>
<body>
    <div class="top-bar">
        <img src="{{ asset('img/professor.png') }}" alt="professor img" />
        <h1>Filtrar Chamadas</h1>
    </div>

    <div class="access">
        <form method="POST" action="{{ route('chamada.resultado') }}" class="filtro-chamadas-form">
            @csrf
            
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" required />

            <label for="turma_id">Turma:</label>
            <select name="turma_id" id="turma_id" required>
                <option value="">-- Selecione uma turma --</option>
                @foreach ($turmas as $turma)
                    <option value="{{ $turma->id }}">
                        {{ $turma->curso }} - {{ $turma->turma }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Buscar</button>
        </form>
    </div>

    <a href="{{ route('chamada') }}" class="voltar-btn">
        <img src="{{ asset('img/seta.png') }}" alt="Voltar" />
    </a>
</body>
</html>

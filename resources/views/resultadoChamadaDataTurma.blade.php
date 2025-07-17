<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Chamadas Encontradas</title>
    <link rel="stylesheet" href="{{ asset('css/chamadas-encontradas.css') }}" />
</head>
<body>
    <div class="top-bar">
        <img src="{{ asset('img/professor.png') }}" alt="professor img" />
        <h1>Chamadas em {{ \Carbon\Carbon::parse($dataSelecionada)->format('d/m/Y') }}</h1>
    </div>

    <div class="access">
        @if ($chamadas->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Turma</th>
                        <th>Horário</th>
                        <th>Presenças</th>
                        <th>Abrir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chamadas as $chamada)
                        <tr>
                            <td>{{ $chamada->turma->curso }}</td>
                            <td>{{ $chamada->turma->turma }}</td>
                            <td>{{ $chamada->created_at->format('H:i') }}</td>
                            <td>{{ $chamada->presencas()->count() }}</td>
                            <td><a href="{{ route('chamada.painel', $chamada->id) }}" class="link-abrir">Ver Chamada</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Nenhuma chamada encontrada para essa data e turma.</p>
        @endif
    </div>

    <a href="{{ route('chamada.filtro') }}" class="voltar-btn">
        <img src="{{ asset('img/seta.png') }}" alt="Voltar" />
    </a>
</body>
</html>

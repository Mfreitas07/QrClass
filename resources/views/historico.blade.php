<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Professor</title>
    <link rel="stylesheet" href="{{ asset('css/historico.css') }}" />
</head>
<body>
    <div class="top-bar">
        <img src="{{ asset('img/professor.png') }}" alt="professor img" />
        <h1>Histórico</h1>
    </div>

    <div class="access">
        <div class="container">

            <div class="turma">
                <h1>Turmas</h1>
                <form method="GET" action="{{ route('historico.index') }}">
                    <select name="turma_id" onchange="this.form.submit()">
                        <option value="">-- Selecione uma turma --</option>
                        @foreach ($turmas as $turma)
                            <option value="{{ $turma->id }}" {{ request('turma_id') == $turma->id ? 'selected' : '' }}>
                                {{ $turma->curso }} - {{ $turma->turma }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Turma</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($turmas as $turma)
                            <tr>
                                <td>{{ $turma->curso }}</td>
                                <td>{{ $turma->turma }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="aluno">
                <h1>Alunos</h1>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($alunos) && $alunos->count() > 0)
                            @foreach ($alunos as $aluno)
                                <tr>
                                    <td>{{ $aluno->nome_aluno }}</td>
                                    <td>{{ $aluno->email }}</td>
                                    <td>{{ $aluno->password }}</td>
                                </tr>
                            @endforeach
                        @elseif(request('turma_id'))
                            <tr>
                                <td colspan="3">Nenhum aluno encontrado para essa turma.</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="3">Selecione uma turma para ver os alunos.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="{{ route('gerenciar.turma') }}" class="voltar-btn">
    <img src="{{ asset('img/seta.png') }}" alt="Voltar">
</body>
</html>

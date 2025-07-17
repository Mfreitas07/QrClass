<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Painel de Chamada</title>
    <link rel="stylesheet" href="{{ asset('css/painelchamada.css') }}">
</head>
<body>
    <!-- Topo com título e imagem -->
    <div class="top-bar"> 
        <img src="{{ asset('img/professor.png') }}" alt="Imagem do professor">
        <h1>Chamada: {{ $chamada->turma->curso }} {{ $chamada->turma->turma }}</h1>
    </div>

    <!-- Data e hora atual -->
    <div class="data-hora">
        Data/Hora: {{ now()->format('d/m/Y H:i') }}
    </div>

    <!-- Conteúdo central com QR Code e lista -->
    <div class="painel-container">
        <!-- QR Code -->
        <div class="qr-section">
            <h2>QR Code</h2>
            {!! QrCode::size(250)->generate($link) !!}
            <p>Ou acesse: <a href="{{ $link }}">{{ $link }}</a></p>
        </div>

        <!-- Lista de alunos presentes -->
        <div class="lista-section">
            <h2>Alunos Presentes</h2>
            <ul id="lista-presencas">
                @forelse ($presencas as $presenca)
                    <li>{{ $presenca->aluno->nome_aluno }} ({{ $presenca->horario->format('H:i') }})</li>
                @empty
                    <li>Nenhum aluno ainda</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Botão voltar -->
    <a href="{{ route('chamada') }}" class="voltar-btn">
        <img src="{{ asset('img/seta.png') }}" alt="Voltar">
    </a>

    <script>
        const chamadaId = {{ $chamada->id }};
        const listaPresencas = document.getElementById('lista-presencas');

        function atualizarLista() {
            fetch(`/chamada/${chamadaId}/presencas-json`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        listaPresencas.innerHTML = '<li>Nenhum aluno ainda</li>';
                    } else {
                        listaPresencas.innerHTML = data.map(presenca => 
                            `<li>${presenca.nome} (${presenca.horario})</li>`
                        ).join('');
                    }
                })
                .catch(err => {
                    console.error('Erro ao carregar presenças:', err);
                });
        }

        // Atualiza a lista a cada 10 segundos
        setInterval(atualizarLista, 5000);
    </script>
</body>
</html>

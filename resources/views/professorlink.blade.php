<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Professor - Link</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/professorlink.css') }}">
</head>
<body>
    <div class="top-bar"> 
        <img src="../img/professor.png" alt="professor img">
        <h1>Professor</h1>
    </div>  

    <div class="access">
        <form method="POST" action="{{ route('link.salvar') }}">
            @csrf
            <label>Insira o link da plataforma:</label>
            <input type="url" name="link" placeholder="https://exemplo.com" value="{{ $link->link ?? '' }}" required>
            <button type="submit" class="btn">Salvar Link</button>
        </form>

        @if(session('success'))
            <p style="color: green; margin-top: 10px;">{{ session('success') }}</p>
        @endif
    </div>

    <a href="{{ route('dashboard') }}" class="voltar-btn">
        <img src="{{ asset('img/seta.png') }}" alt="Voltar">
    </a>
</body>
</html>

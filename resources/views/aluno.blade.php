<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Aluno</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/aluno.css') }}">
</head>
<body>
    <div class="top-bar"> 
        <img src="{{ asset('img/aluno.png') }}" alt="aluno img">
        <h1>Aluno</h1>
    </div>  

    <div class="access">
        <a class="btn Chamada" href="{{ route('scan.aluno') }}">Chamada</a>
        <a class="btn Plataforma" href="{{ route('aluno.link') }}" target="_blank">Plataforma</a>

        <form action="{{ route('aluno.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm">Logout</button>
        </form>
    </div>
</body>
</html>
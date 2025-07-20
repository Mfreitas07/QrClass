<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Professor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/professor.css') }}">
</head>
<body>
    <div class="top-bar"> 
        <img src="../img/professor.png" alt="professor img">
        <h1>Professor</h1>
    </div>  

    <div class="access">
        <a class="btn Escolherturma" href="{{ route('gerenciar.turma') }}">Gerenciar Turma</a>
        <a class="btn Plataforma" href="{{ route('link.form') }}">Adicionar Link Plataforma</a>

        <form action="{{ route('logout') }}" method="post">
         @csrf
        <button type="submit" class="btn btn-sm">Logout</button>
        </form>
    </div>
</body>
</html>

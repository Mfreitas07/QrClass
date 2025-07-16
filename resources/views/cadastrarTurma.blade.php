<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="{{ asset('css/cadastrarturma.css') }}">
</head>
<body>
    <div class="container">
    <div class="top-bar"><h1>Cadastro de turma</h1></div>
        <form action="{{ route('turma.store') }}" method="POST" class="formCadastro">
             @csrf
            <label for="nome">Curso</label>
            <input type="text" id="curso" name="curso" required>

            <label for="turma">Turma</label>
            <input type="text" id="turma" name="turma" required>

            <button type="submit" class="btn">Cadastrar</button>
              <a href='gerenciar-turma'>
            <img src="../img/seta.png" alt="Voltar"></a>
        </form>
    </div>
</body>
</html>

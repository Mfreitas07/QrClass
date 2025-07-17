<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="{{ asset('css/cadastrar.css') }}">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <div class="top-bar"><h1>Cadastro</h1></div>

        <form action="{{ route('store') }}" method="POST" class="formCadastro" >

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        @csrf
            <label for="name">Nome:</label>
            <input type="text" placeholder="Digite seu nome" name="name" id="name" value="{{ old('name') }}">
            <label for="email">E-mail:</label>
            <input type="email" placeholder="Digite seu e-mail" name="email" id="email" value="{{ old('email') }}" />
            <label for="password">Senha:</label>
            <input type="password" placeholder="Digite sua senha" name= "password" id="password"/>
            <label for="password">Digite sua senha novamente:</label>
            <input type="password" placeholder="Digite sua senha" name= "password_confirmation" id="password_confirmation"/>
            <button class="btn" type="submit">Cadastrar</button>
              <a href='/login'>
            <img src="../img/seta.png" alt="Voltar"></a>
        </form>    
    </div>

</body>
</html>

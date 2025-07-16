<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <h1>LOGIN</h1>
        </div>

        {{-- Exibir mensagens de erro --}}
        @if (session('erro'))
            <div style="color: #f72585; margin-bottom: 10px;">
                {{ session('erro') }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="formLogin">
            @csrf

            <label for="email">E-mail</label>
            <input type="email" placeholder="Digite seu e-mail" name="email" id="email" required />

            <label for="password">Senha</label>
            <input type="password" placeholder="Digite sua senha" name="password" id="password" required />

                <a href="{{ route('recuperarsenha') }}">Esqueci minha senha</a>
                <a href="{{ route('register') }}">Cadastrar</a>

            <button class="btn" type="submit">Entrar</button>
        </form>    
    </div>
</body>
</html>

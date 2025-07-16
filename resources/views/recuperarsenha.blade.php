<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/recuperarsenha.css') }}">
    <title>Recuperar Senha</title>
</head>
<body>
    <div class="container">
        <div class="top-bar"><h1>Redefinição de senha</h1></div>
        <form method="GET" class="formLogin" action={{ route('recuperarsenha2') }}>
        <p>Para redefinir sua senha, informe o e-mail cadastrado na sua conta e te enviaremos um link com as instruções.</p>
            <label for="email">E-mail</label>
            <input type="email" placeholder="Digite seu e-mail" autofocus="true" />
            <button class="btn" type="submit">Enviar</button>
            <a href="login">Cancelar</a>
        </form>
    </div>

</body>
</html>
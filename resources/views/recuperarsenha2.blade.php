<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/recuperarsenha.css') }}">
    <title>Inserir Código de Recuperação</title>
</head>
<body>
<div class="container">
    <div class="top-bar"><h1>Inserir Código</h1> </div>
        <form method="POST" class="formLogin" action="/html/verificar_codigo.php" autocomplete="off" novalidate>
            <p>Um código de recuperação foi enviado para seu e-mail. Digite-o abaixo para continuar e redefinir sua senha.</p>
            <label for="codigo">Código de Recuperação</label>
            <input 
                type="text" 
                id="codigo" 
                name="codigo" 
                placeholder="Digite o código" 
                required 
                maxlength="6" 
                pattern="[0-9]{6}" 
                autofocus 
            />
            <button class="btn" type="submit">Verificar Código</button>
            <a href="Recuperar-senha">Cancelar e Voltar</a>
        </form>
    </div>
</body>
</html>

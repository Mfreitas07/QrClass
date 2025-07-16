<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primeiro Acesso</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../IMG/fundo.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .top-bar {
            background-color: #1ba4c1;
            height: 70px;
            width: 100%;
            border-radius: 10px 10px 0 0;
        }

        .container {
            text-align: center;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
            width: 300px;
            overflow: hidden;
        }

        .logo img {
            width: 160px;
            margin: 20px 0;
            max-width: 80%;
        }

        .title h1,
        .access h2 {
            font-size: 25px;
            color: #004aad;
            margin: 0.67em 0 0 0;
            font-weight: bold;
        }

        .title p {
            color: #004aad;
            margin: 0 0 50px 0;
        }

        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto 80px auto;
            width: 130px;
            padding: 10px;
            color: white;
            background-color: #fc65fa;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            text-align: center;
            text-decoration: none;
        }

        .button:hover {
            background-color: #df13ce;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar"></div>
        <div class="logo">
            <img src="../img/logoescola.png" alt="QrClass Logo">
        </div>
        <div class="title">
            <h1>QrClass</h1>
            <p>Chamada inteligente</p>
        </div>
        <div class="access">
            <h2>Seja Bem Vindo!</h2>
            <a class="button Acessar" href='{{ route('login') }}'>Entrar</a>
        </div>
    </div>
</body>
</html>

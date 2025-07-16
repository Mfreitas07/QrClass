<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Leitor QR Code - Aluno (Instascan)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/scanaluno.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- Scripts necessários para Instascan -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
</head>
<body>

    <div class="top-bar">
        <img src="../img/aluno.png" alt="aluno img">
        <h1>Aluno</h1>
    </div>

    <div class="access">
        <div class="qr-reader">
            <video id="preview" autoplay muted></video>
        </div>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        scanner.addListener('scan', function (content) {
            window.location.href = content; // Redireciona automaticamente após escanear
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                let backCam = cameras.find(cam => cam.name.toLowerCase().includes('back'));
                scanner.start(backCam || cameras[0]);
            } else {
                alert('Nenhuma câmera foi encontrada.');
            }
        }).catch(function (e) {
            console.error(e);
            alert('Erro ao acessar câmera: ' + e);
        });
    </script>
    <a href="{{ route('aluno') }}">Cancelar</a>
    </div>
</body>
</html>

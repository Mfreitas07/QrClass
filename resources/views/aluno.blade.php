<!DOCTYPE html>
<html>
	<head>
		<title>Aluno
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/aluno.css') }}">
	</head>
	<body>
        <div class="top-bar"> 
            <img src="../img/aluno.png" alt="aluno img">
            <h1>Aluno</h1>
        </div>  
        <div class="access">
        <a class="btn Chamada" href="{{ route('scan.aluno') }}">Chamada</a>
        <a class="btn Plataforma" id="btnAccess" disabled>Plataforma</a>
        <form action="{{ route('aluno.logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-sm">Logout</button>
</form>
            <script>
    const btnAccess = document.getElementById('btnAccess');
    function updateButton() {
      const link = localStorage.getItem('linkProfessor');
      if (link) {
        btnAccess.disabled = false;
      } else {
        btnAccess.disabled = true;
      }
    }
    btnAccess.addEventListener('click', () => {
      const link = localStorage.getItem('linkProfessor');
      if (link) {
        window.open(link, '_blank');
      } else {
        alert('Nenhum link disponível. Por favor, aguarde até que o professor disponibilize um.');
      }
    });
    window.onload = updateButton;
  </script>
        </div>
   </body>
</html>

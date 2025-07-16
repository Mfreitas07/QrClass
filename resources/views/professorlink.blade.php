<!DOCTYPE html>
<html>
	<head>
		<title>Professor
        </title>
        <link rel="stylesheet" href="{{ asset('css/professorlink.css') }}">
	</head>
	<body>
        <form method="GET" action="dashboard">
        <div class="top-bar"> 
            <img src="../img/professor.png" alt="professor img">
            <h1>Professor</h1>
        </div>  
        <div class="access">
  <label for="linkInput">Insira o link para os alunos acessarem:</label>
  <input type="url" id="linkInput" placeholder="https://exemplo.com/link-da-aula" />
  <button  class="btn" id="btnSave">Salvar Link</button>
  <div id="msg"></div>
  <script>
    const linkInput = document.getElementById('linkInput');
    const btnSave = document.getElementById('btnSave');
    const msg = document.getElementById('msg');
    // Ao carregar a página, mostrar o link salvo, se tiver
    window.onload = function() {
      const savedLink = localStorage.getItem('linkProfessor');
      if (savedLink) {
        linkInput.value = savedLink;
      }
    };
    btnSave.addEventListener('click', () => {
      const url = linkInput.value.trim();
      if (!url) {
        msg.style.color = 'red';
        msg.textContent = 'Por favor, insira um link válido.';
        return;
      }
      try {
        new URL(url); // valida a url
      } catch {
        msg.style.color = 'red';
        msg.textContent = 'Link inválido. Insira uma URL válida.';
        return;
      }
      // Salvar no localStorage
      localStorage.setItem('linkProfessor', url);
      msg.style.color = 'green';
      msg.textContent = 'Link salvo com sucesso.';
    });
  </script>
  </form>
  <a href="{{ route('dashboard') }}" class="voltar-btn">
    <img src="{{ asset('img/seta.png') }}" alt="Voltar">
</body>
</html>
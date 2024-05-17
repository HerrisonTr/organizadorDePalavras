<?php session_start(); ?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Frutas </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      background-color: #DADBDA;
      width: 100vw;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    h1 {
      font-size: 1.5rem;
    }
  </style>
</head>

<body>

  <main class="col-sm-8 col-sm-6 col-lg-4">

    <?php
    if (isset($_SESSION['erro'])) {
      echo "<div class='alert alert-danger' role='alert'>
              {$_SESSION['erro']}
            </div>";
      session_destroy();
    }
    ?>

    <div class="card">
      <div class="card-header text-center">
        <h1> Organizar lista de frutas </h1>
      </div>

      <div class="card-body">
        <form action="organizador.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="arquivo" class="form-label"> Escolha um arquivo que deseja organizar </label> <small class="text-danger"> * </small>
            <input class="form-control" type="file" id="arquivo" name="arquivo" required>
            <small class="text-danger mt-2"> * Só são aceitos arquivos com extensões .txt </small>
          </div>

          <div class="mb-3">
            <label for="separador" class="form-label"> Selecione o separador que está usando no arquivo </label> <small class="text-danger"> * </small>
            <select class="form-select" name="separador" id="separador" required>
              <option value=","> , (Vírgula) </option>
              <option value="0"> Espaço </option>
              <option value="."> . (Ponto) </option>
              <option value=";"> ; (Ponto e vírgula) </option>
              <option value="/"> / (Barra) </option>
            </select>
          </div>

          <button class="btn btn-success float-end"> Continuar </button>
        </form>

        <a href="./arquivos/exemplo.txt" download=""> Baixar exemplo </a>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>
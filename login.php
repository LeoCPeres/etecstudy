<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" href="./css/styles.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

  <link rel="shortcut icon" href="./images/blob.png" type="image/x-icon" />

  <title>Etec Study - Home</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark navedit fixed-top" style="background-color: #0103ab !important; color: red !important">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php"><img src="./images/logo.png" alt="" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Área do calouro</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Cursos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Disciplinas
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item" href="#">Something else here</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Professores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Vestibulares</a>
          </li>
        </ul>
        <div class="d-flex">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="./login.php" class="nav-link" style="color: white">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="col-md-12">&nbsp;</div>
  <div class="col-md-12">&nbsp;</div>
  <div class="col-md-12">&nbsp;</div>
  <div class="col-md-12">&nbsp;</div>
  <div class="col-md-12">&nbsp;</div>


  <div class="container-fluid ">


    <div class="d-flex justify-content-center align-items-center">
      <div class="col-md-4 col-12">
        <div class="container">
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">&nbsp;</div>
          <div class="col-md-12">&nbsp;</div>

          <div class="col-md-12 col-12 p-3 rounded-3 bg-light  shadow">


            <h3 class="text-primary fw-bold">Entrar</h3>

            <form action="login.php" method="POST">
              <div class="mb-3">
                <div class="d-flex justify-content-start">
                  <label for="email-login" class="form-label">Endereço de email</label>
                </div>
                <input type="email" class="form-control" placeholder="Email" id="email-login" aria-describedby="emailHelp" name="usuario" required="" autocomplete="off">

              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-start">
                  <label for="senha-login" class="form-label">Senha</label>
                </div>
                <input type="password" class="form-control" placeholder="Senha" id="senha-login" name="senha" required="" autocomplete="off">
                <div class="d-flex justify-content-end">
                  <div id="emailHelp" class="form-text">Não possui conta? <a href="./cadastro.php">Cadastre-se agora!</a></div>
                </div>
              </div>

              <div class="d-flex justify-content-center">
                <span class="divisor"></span> OU <span class="divisor"></span>
              </div>

              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Entrar</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="../css/styles.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <link rel="shortcut icon" href="../images/blob.png" type="image/x-icon" />

    <title>Etec Study - Login</title>
</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7 login-left">
                <img src="../images/logo.svg" alt="" class="img-fluid">
            </div>
            <div class="col-md-5 login-right">
                <div class="topo-login">
                    <div class="top-left"><a href="../"><i class="bi bi-arrow-left"></i></a></div>
                    <div class="top-right"><a href="../registrar/">Registrar-se</a></div>
                </div>
                <form method="POST" class="form-login">
                    <div class="top-login" style="align-self: flex-start">
                        <h3>Bem vindo de volta!</h3>

                    </div>
                    <div class="body-login">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control email-login" name="txtemail" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Senha</label>
                            <input type="password" class="form-control email-login" name="txtsenha" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Mantenha-me conectado</label>
                        </div>
                        <input type="submit" class="btn btn-primary" name="btn-login" value="Entrar"></input>
                    </div>

                    <div class="footer-login">
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <button class="btn-oauth w-100">
                                    <img src="../images/google-logo.svg" alt="">
                                    <span>Login com o Google</span>
                                </button>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="button" class="btn-oauth w-100">
                                    <img src="../images/facebook.png" alt="">
                                    <span>Login com o Facebook</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>

<?php

if (filter_input(INPUT_POST, 'btn-login')) {
    $usuario = filter_input(INPUT_POST, 'txtemail', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'txtsenha', FILTER_SANITIZE_STRING);

    include_once '../class/usuario.php';
    $user = new Usuario();

    $user->setEmail($usuario);
    $user->setSenha($senha);

    if ($user->consultar() > 0) {
        session_start();
        $_SESSION['usuario'] = $usuario;

        header("Location: ../index.php");
    } else {
        $_SESSION['nao-autenticado'] = true;
        echo  '<div class="container">'
            . '<div class="alert alert-warning" role="alert">'
            . '<h3>Nome de usuário e/ou senha incorreto(s)</h3>'
            . '<p>Verifique seu nome de usuário e senha!</p>'
            . '</div>'
            . '</div>';
    }
}

<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="../css/styles.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <link rel="shortcut icon" href="../images/blob.png" type="image/x-icon" />

    <title>Etec Study - Login</title>

    <script type="text/javascript">
    window.onload = campos;


    function campos() {
        var txtemail = document.getElementById('txtemail');
        var txtsenha = document.getElementById('txtsenha');
        var btnsubmit = document.getElementById('btnsubmit');

        if (txtemail.value == "" || txtsenha.value == "") {
            btnsubmit.disabled = true;
        } else {
            btnsubmit.disabled = false;
        }
    }
    </script>
</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7 login-left">
                <img src="../images/logo.svg" alt="" class="img-fluid">
            </div>
            <div class="col-sm-5 login-right">
                <div class="topo-login">
                    <div class="top-left"><a href="../"><i class="bi bi-arrow-left"></i></a></div>
                    <div class="top-right"><a href="../registrar/">Registrar-se</a></div>
                </div>
                <form method="POST" class="form-login">
                    <div class="top-login" style="align-self: flex-start">
                        <h3>Bem vindo de volta!</h3>

                    </div>
                    <div class="body-login">
                        <div class="alert alert-danger" role="alert" id="alert" style="display: none;">
                            Email ou senha incorretos!
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input oninput="campos()" placeholder="Ex: joaopedrosilva@gmail.com" type="email"
                                class="form-control email-login" id="txtemail" name="txtemail"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Senha</label>
                            <input oninput="campos()" id="txtsenha" placeholder="Senha de pelo menos 8 caracteres"
                                type="password" class="form-control email-login" name="txtsenha"
                                aria-describedby="emailHelp" required>
                        </div>
                        <input type="submit" id="btnsubmit" class="btn btn-primary" name="btn-login"
                            value="Entrar"></input>
                    </div>

                    <div class="footer-login">
                        <div class="row mt-4">
                            <div class="col-sm-6 mb-3">
                                <button class="btn-oauth w-100">
                                    <img src="../images/google-logo.svg" alt="">
                                    <span>Login com o Google</span>
                                </button>
                            </div>
                            <div class="col-sm-6 mb-3">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
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

        $_SESSION['usuario'] = $usuario;

?>
<meta http-equiv="refresh" CONTENT="1;URL=../">
<?php
    } else {
        $_SESSION['nao-autenticado'] = true;
        echo  '<script>
        (function (){
            var alerta = document.getElementById("alert");

            alerta.style.display = "";
        })();
        
    
        </script>';
    }
}
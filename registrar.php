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

    <title>Etec Study - Login</title>
</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 login-right">
                <div class="topo">
                    <div class="top-left"><a href="./login.php"><i class="bi bi-arrow-left"></i></a></div>
                    <div class="top-right"><a href="./registrar.php">Ajuda</a></div>
                </div>
                <form action="" class="form-login">
                    <div class="top-login" style="align-self: flex-start">
                        <h3>Bem vindo de volta!</h3>

                    </div>
                    <div class="body-login">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control email-login" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Senha</label>
                            <input type="password" class="form-control email-login" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Mantenha-me conectado</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>

                    <div class="footer-login mt-4">
                        <div class="col-md-6 btn-oauth">
                            <img src="./images/google-logo.svg" alt="">
                            <span>Login com Google</span>
                        </div>
                        <div class="col-md-6 btn-oauth">
                            <img src="./images/facebook.png" alt="">
                            <span>Login com Facebook</span>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-md-7 login-left">
                <img src="./images/logo.svg" alt="" class="img-fluid">
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>
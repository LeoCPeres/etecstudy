<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="../css/styles.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>



    <link rel="shortcut icon" href="../images/blob.png" type="image/x-icon" />

    <title>Etec Study - Registrar-se</title>

    <script type="text/javascript">
        window.onload = campos;


        function campos() {
            var txtnome = document.getElementById('txtnome');
            var txtsobrenome = document.getElementById('txtsobrenome');
            var datepicker = document.getElementById('datepicker');
            var escolaridade = document.getElementById('escolaridade');
            var txttelefone = document.getElementById('txttelefone');
            var txtemail = document.getElementById('txtemail');
            var txtsenha = document.getElementById('txtsenha');
            var btnsubmit = document.getElementById('btnsubmit');

            if (txtnome.value == "" || txtsobrenome.value == "" || datepicker.value == "" || escolaridade.value == null ||
                txttelefone.value == "" || txtemail.value == "" || txtsenha.value == "") {
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
            <div class="col-sm-5 login-right">
                <div class="topo-register">
                    <div class="top-left"><a href="../login/"><i class="bi bi-arrow-left"></i></a></div>
                    <div class="top-right"><a href="../help/">Ajuda</a></div>
                </div>
                <form method="POST" class="form-login">
                    <div class="top-login" style="align-self: flex-start">
                        <h3>Informe seus dados</h3>

                    </div>
                    <div class="body-login">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nome</label>
                                <input oninput="campos()" type="name" class="form-control" id="txtnome" name="txtnome" aria-describedby="emailHelp" placeholder="Ex: João Pedro" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Sobrenome</label>
                                <input oninput="campos()" type="name" class="form-control" id="txtsobrenome" name="txtsobrenome" aria-describedby="emailHelp" placeholder="Silva" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Data de nascimento</label>
                                <input oninput="campos()" type="date" id="datepicker" class="form-control" name="txtdatanasc" required>
                            </div>
                            <div class="col-sm-6 col-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">Escolaridade</label>
                                <select onselect="campos()" class="form-select" name="txtescolaridade" required id="escolaridade">
                                    <option>Selecione</option>
                                    <option value="1">Ensino médio completo</option>
                                    <option value="2">Ensino incompleto</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Telefone</label>
                            <input oninput="campos()" type="tel" class="form-control" id="txttelefone" name="txttelefone" aria-describedby="emailHelp" placeholder="DDD + Número" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input oninput="campos()" type="email" class="form-control" id="txtemail" name="txtemail" aria-describedby="emailHelp" placeholder="Ex: joaopedrosilva@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Senha</label>
                            <input oninput="campos()" type="password" class="form-control" id="txtsenha" placeholder="Senha de pelo menos 8 caracteres" minlength="8" name="txtsenha" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Mantenha-me conectado</label>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Cadastrar" id="btnsubmit" name="btn-cadastro"></input>
                    </div>


                    <div class="footer-login">
                        <div class="row mt-4">
                            <div class="col-sm-6 mb-3">
                                <button class="btn-oauth w-100">
                                    <img src="../images/google-logo.svg" alt="">
                                    <span>Registro com Google</span>
                                </button>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <button class="btn-oauth w-100">
                                    <img src="../images/facebook.png" alt="">
                                    <span>Registro com Facebook</span>
                                </button>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="col-sm-7 login-left">
                <img src="../images/logo.svg" alt="" class="img-fluid">
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <script>
        bootstrapValidate('#nome-cadastro', 'min:5:Insira ao menos 5 caracteres.');
        bootstrapValidate('#telefone-cadastro', 'min:14:Insira ao menos 10 caracteres.');
        bootstrapValidate('#CPF', 'min:14:Insira ao menos 11 caracteres.');
        bootstrapValidate('#nascimento-cadastro', 'min:10:Insira a data completa.');
    </script>
</body>

</html>

<?php

if (filter_input(INPUT_POST, 'btn-cadastro')) {
    $nome = filter_input(INPUT_POST, 'txtnome', FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, 'txtsobrenome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'txtemail', FILTER_SANITIZE_STRING);
    $datanasc = filter_input(INPUT_POST, 'txtdatanasc', FILTER_SANITIZE_STRING);
    $telefone = filter_input(INPUT_POST, 'txttelefone', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'txtsenha', FILTER_SANITIZE_STRING);
    $escolaridade = filter_input(INPUT_POST, 'txtescolaridade', FILTER_SANITIZE_STRING);

    include_once '../class/usuario.php';
    $user = new Usuario();

    $user->setEmail($email);
    $user->setSenha($senha);
    $user->setNome($nome);
    $user->setSobrenome($sobrenome);
    $user->setTelefone($telefone);
    $user->setEscolaridade($escolaridade);
    $user->setNascimento($datanasc);

    if ($user->salvar()) {
?>
        <meta http-equiv="refresh" CONTENT="1;URL=../login">
<?php
    }
}

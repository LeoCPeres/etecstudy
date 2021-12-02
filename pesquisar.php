<?php
session_start();

include_once './class/Materia.php';
include_once './class/disciplina.php';
$materia = new Materia();
$disc = new Disciplina();

$disciplinas = $disc->ConsultarTodasDisciplinas();
foreach ($disciplinas as $mostrarDisc) {
    $id_disc = $mostrarDisc['id_disc'];
    $disciplinaText = $mostrarDisc['disciplina'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="./css/styles.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />

    <link rel="shortcut icon" href="./images/blob.png" type="image/x-icon" />

    <title>Etec Study - Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark navedit fixed-top"
        style="background-color: #0103ab !important; color: red !important">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="./images/logo.png" alt="" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="calouro">Área do calouro</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Disciplinas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php

                            foreach ($disciplinas as $mostrarDisc) {

                            ?>
                            <li><a class="dropdown-item"
                                    href="?p=pesquisar&id_disc=<?= $mostrarDisc['id_disc'] ?> "><?= $mostrarDisc['disciplina'] ?></a>
                            </li>


                            <?php } ?>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Vestibulares</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav">
                        <?php
                        if (!isset($_SESSION['usuario']) && !isset($_SESSION['admin']) && !isset($_SESSION['professor'])) :
                        ?>
                        <li class="nav-item">
                            <a href="./login/" class="nav-link" style="color: white">Login</a>
                        </li>
                        <?php
                        endif;
                        ?>

                        <?php
                        if (isset($_SESSION['usuario']) || isset($_SESSION['admin']) || isset($_SESSION['professor'])) :

                        ?>
                        <li class="nav-item dropdown" style="width: 170px; display: flex; justify-content: flex-end;">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="https://avatars.githubusercontent.com/u/69376610?v=4" alt=""
                                    class="user-letter">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a href="#" class="dropdown-item">Perfil</a></li>
                                <li><a href="./login/logout.php" class="dropdown-item">Sair</a></li>

                            </ul>
                        </li>
                        <?php
                        endif;
                        ?>
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

    <div class="container">



        <div class="row" style="margin-top: 10px;">
            <div class="col-md-2">&nbsp;</div>
            <div class="col-md-12">
                <?php
                $pesquisa = "%" . trim(filter_input(INPUT_GET, 'pesquisa')) . "%";
                $id_disc = filter_input(INPUT_GET, 'id_disc');

                include_once('./class/materia.php');
                include_once('./class/disciplina.php');
                include_once('./class/usuario.php');
                $materia = new Materia();
                $disc = new Disciplina();
                $user = new Usuario();

                if (isset($_SESSION['usuario'])) {
                    $dadosUsuario = $user->pegarDadosUsuario($_SESSION['usuario']);
                    foreach ($dadosUsuario as $mostrar) {
                        $nome = $mostrar['nome'];
                        $last_view = $mostrar['last_view'];
                        $id_professor = $mostrar['id_professor'];
                    }
                }

                if (isset($pesquisa)) {
                    $dados = $materia->ConsultarPorTitulo($pesquisa);
                    foreach ($dados as $mostrar) {
                        $titulo = $mostrar['titulo'];
                        $descricao = $mostrar['descricao'];
                        $disciplina = $mostrar['disciplina'];
                        $id_materia = $mostrar['id_materia'];
                        $url = $mostrar['url'];
                        $id_usuario_inclusao = $mostrar['id_usuario_inclusao'];
                    }
                } else if (isset($id_disc)) {
                    $dados = $materia->ConsultarPorDisc($id_disc);
                    foreach ($dados as $mostrar) {
                        $titulo = $mostrar['titulo'];
                        $descricao = $mostrar['descricao'];
                        $disciplina = $mostrar['disciplina'];
                        $id_materia = $mostrar['id_materia'];
                        $url = $mostrar['url'];
                        $id_usuario_inclusao = $mostrar['id_usuario_inclusao'];
                    }
                } else {
                    $dados = $materia->ConsultarTodos();
                    foreach ($dados as $mostrar) {
                        $titulo = $mostrar['titulo'];
                        $descricao = $mostrar['descricao'];
                        $disciplina = $mostrar['disciplina'];
                        $id_materia = $mostrar['id_materia'];
                        $url = $mostrar['url'];
                        $id_usuario_inclusao = $mostrar['id_usuario_inclusao'];
                    }
                }
                ?>

                <div class="col-md-12 col-12">
                    <div class="container">
                        <center>
                            <div class="col-md-8 col-12">
                                <form class="input-group mb-3" method="GET" action="pesquisar.php">
                                    <input type="text" class="form-control" placeholder="Pesquise um assunto"
                                        name="pesquisa" aria-label="Recipient's username"
                                        aria-describedby="button-addon2" />
                                    <button class="btn btn-primary" id="button-addon2" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </center>

                        <div class="col-md-12">&nbsp;</div>

                        <?php

                        if (isset($id_disc)) {
                            echo '<h1 class="title">Resultados para disciplina "' . $disciplina . '"</h1>';
                        } else if (isset($pesquisa)) {
                            $pesquisa = trim($pesquisa, '%');
                            echo '<h1 class="title">Resultados para "' . str_replace('+', '', $pesquisa) . '"</h1>';
                        } else {
                            echo '<h1 class="title">Todas as matérias</h1>';
                        }


                        ?>
                        <div class="col-md-12">&nbsp;</div>
                        <div class="col-md-12">&nbsp;</div>


                        <?php
                        foreach ($dados as $mostrar) {



                        ?>


                        <div class="col-md-12 col-12">
                            <div class="row search-card">
                                <div class="col-md-1 col-1 subject-div">
                                    <span class="subject">
                                        <?php $firstLetter = substr($mostrar['disciplina'], 0, 1);
                                            echo $firstLetter; ?>

                                    </span>

                                </div>



                                <div class="col-md-10 col-10 search-body">
                                    <a href="./?p=materias&url=<?= $mostrar['url'] ?>" class="link">
                                        <h4><?= $mostrar['titulo'] ?></h4>
                                        <p>
                                            <?= $mostrar['descricao'] ?>
                                        </p>

                                    </a>
                                </div>
                                <?php

                                    if (isset($_SESSION['usuario'])) {
                                        $id_usuario_inclusao == $id_professor ? '<div class="col-md-1 col-1">
                    <a href="./admin/?p=materia/nova&id_materia=' . $mostrar['id_materia'] . '" class="btn-search"><img
                            src="./images/write.png" class="img-fluid p-3"></a>
                </div>' : '';
                                    }



                                    ?>
                            </div>
                            <div class="col-md-12">&nbsp;</div>
                        </div>

                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
                crossorigin="anonymous">
            </script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>
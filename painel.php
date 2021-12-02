<?php

if (!$_SESSION['usuario']) {
    echo '<meta http-equiv="refresh" content="0;URL=./">';
    return;
}



include_once('./class/usuario.php');
include_once('./class/materia.php');
$materia = new Materia();
$user = new Usuario();
date_default_timezone_set('America/Sao_Paulo');

$dadosUsuario = $user->pegarDadosUsuario($_SESSION['usuario']);
foreach ($dadosUsuario as $mostrar) {
    $nome = $mostrar['nome'];
    $last_view = $mostrar['last_view'];
    $id_professor = $mostrar['id_professor'];
    $id_usuario = $mostrar['id_usuario'];
}

$top4materias = $materia->ConsultarTop4();
foreach ($top4materias as $mostrarTop4Materias) {
    $titulo = $mostrarTop4Materias['titulo'];
    $id_materia = $mostrarTop4Materias['id_materia'];
    $descricao = $mostrarTop4Materias['descricao'];
    $url = $mostrarTop4Materias['url'];
    $disciplina = $mostrarTop4Materias['disciplina'];
    $imagem = $mostrarTop4Materias['imagem'];
}

?>

<center>
    <div class="col-md-8 col-12">
        <form class="input-group mb-3" method="GET" action="pesquisar.php">
            <input type="text" class="form-control" placeholder="Pesquise um assunto" name="pesquisa"
                aria-label="Recipient's username" aria-describedby="button-addon2" />
            <button class="btn btn-primary" id="button-addon2" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</center>
<div class="col-sm-12 col-12">&nbsp;</div>

<?php
if ($id_professor == null) {

    $horaAtual = date('H') - 1;
    $recepcao;

    if ($horaAtual >= 6 && $horaAtual < 12) {
        $recepcao = "<h1>Bom dia, ";
    } else if ($horaAtual >= 12 && $horaAtual < 18) {
        $recepcao = "<h1>Boa tarde, ";
    } else {
        $recepcao = "<h1>Boa noite, ";
    }

    echo $recepcao . $nome . '!</h1>';
} else {
    $horaAtual = date('H') - 1;
    $recepcao;
    if ($horaAtual >= 6 && $horaAtual < 12) {
        $recepcao = "<h1>Bom dia, ";
    } else if ($horaAtual >= 12 && $horaAtual < 18) {
        $recepcao = "<h1>Boa tarde, ";
    } else {
        $recepcao = "<h1>Boa noite, ";
    }
    echo $recepcao . 'professor ' . $nome . '!</h1>';
}

?>

<div class="col-sm-12 col-12">&nbsp;</div>

<?php

if ($id_professor != null) {
    echo '<h3>Ações do professor</h3><div class="col-sm-12 col-12">&nbsp;</div><div class="row">
    <div class="col-md-3 col-12">
        <a href="./admin/?p=materia/nova" class="personalized-card">
            <div class="card shadow" style="border: none !important;">
                <img src="./images/pencil.svg" class="img-fluid p-3" alt="..." style="width: 115px; height: 115px; align-self: center; opacity: 0.7">
                <div class="card-body">
                    <center>
                        <h5 class="card-title" style="opacity: 0.7">Escrever matéria</h5>
                    </center>

                </div>
            </div>
        </a>
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="col-md-3 col-12">
        <a href="?p=minhasMaterias" class="personalized-card" disabled>
            <div class="card shadow" style="border: none !important;">
                <img src="./images/eye.png" class="img-fluid p-3" alt="..." style="width: 115px; height: 115px; align-self: center; opacity: 0.7">
                <div class="card-body">
                    <center>
                        <h5 class="card-title" style="opacity: 0.7">Minhas matérias</h5>
                    </center>

                </div>
            </div>
        </a>
        <div class="col-md-12">&nbsp;</div>
    </div>
    <div class="col-md-3 col-12" >
        <a href="./admin/?p=disciplina/consultar" class="personalized-card">
            <div class="card shadow" style="border: none !important;">
                <img src="./images/card-checklist.svg" class="img-fluid p-3" alt="..." style="width: 115px; height: 115px; align-self: center; opacity: 0.7">
                <div class="card-body">
                    <center>
                        <h5 class="card-title" style="opacity: 0.7">Adicionar disciplina</h5>
                    </center>

                </div>
            </div>
        </a>
        <div class="col-md-12">&nbsp;</div>
    </div>
</div>';
}

?>

<h3>Matérias recomendadas</h3>



<div class="col-sm-12 col-12">&nbsp;</div>

<div class="col-sm-12">
    <div class="row">
        <?php foreach ($top4materias as $mostrarTop4Materias) { ?>
        <div class="col-sm-3">
            <div class="card shadow" style="border: none !important;">
                <?= $mostrarTop4Materias['imagem'] != null ? '<img class="card-img-top img-fluid"
            src="./img/capas/' . $mostrarTop4Materias['imagem'] . '"
            alt="Card image cap" style="height: 200px; object-fit: cover;">' : '<div class="d-flex align-items-center justify-content-center">Image not found</div>' ?>
                <div class="card-body">
                    <h5 class="card-title etc"><?php $tituloCortado = substr($mostrarTop4Materias['titulo'], 0, 18);
                                                    echo ($tituloCortado . '...')  ?></h5>
                    <p class="card-text etc" style="height: 110px;"><?php $descricaoCortada = substr($mostrarTop4Materias['descricao'], 0, 85);
                                                                        echo ($descricaoCortada . '...') ?></p>
                    <form method="POST" class="row">

                        <?php

                            if ($mostrarTop4Materias['id_usuario_inclusao'] == $id_professor) {
                                echo '<div class="col-sm-9">
                                <a type="submit" href="?p=materias&url=' . $mostrarTop4Materias['url'] . '"
                                    class="btn btn-primary w-100">Acessar</a>
                                <div class="col-sm-12">&nbsp;</div>
                            </div>
                            <div class="col-sm-3">
                                <a type="submit"
                                    href="./admin/?p=materia/nova&id_materia=' . $mostrarTop4Materias['id_materia'] . '"
                            class="btn btn-warning" style="margin-left: -10px;"><img src="./images/write.png" alt=""
                                style="max-width: 24px"></a>
                        </div>';
                            } else {
                                echo '<div class="col-sm-12">
                                    <a type="submit" href="?p=materias&url=' . $mostrarTop4Materias['url'] . '"
                                        class="btn btn-primary w-100">Acessar</a>
                                    <div class="col-sm-12">&nbsp;</div>
                                </div>';
                            }

                            ?>

                    </form>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
        </div> <?php } ?>
    </div>
</div>
<div class="col-sm-12 col-12">&nbsp;</div>

<div class="d-flex justify-content-between align-items-center">

    <h3>Últimos salvos </h3>
    <a href="?p=salvosCompleto" class="float-right">Todos os salvos</a>
</div>

<div class="col-sm-12 col-12">&nbsp;</div>

<div class="col-sm-12">
    <div class="row">

        <?php

        include_once './class/salvos.php';

        $salvos = new Salvos();
        $salvos->setIdUsuario($id_usuario);
        $top4Salvos = $salvos->consultarSalvosTop4();
        if ($top4Salvos != null) {
            foreach ($top4Salvos as $consultarSalvosTop4) { ?>
        <div class="col-sm-3">
            <div class="card shadow" style="border: none !important;">
                <?= $consultarSalvosTop4['imagem'] != null ? '<img class="card-img-top img-fluid"
        src="./img/capas/' . $consultarSalvosTop4['imagem'] . '"
        alt="Card image cap" style="height: 200px; object-fit: cover;">' : '<div class="d-flex align-items-center justify-content-center">Image not found</div>' ?>
                <div class="card-body">
                    <h5 class="card-title etc"><?php $tituloCortado = substr($consultarSalvosTop4['titulo'], 0, 18);
                                                        echo ($tituloCortado . '...')  ?></h5>
                    <p class="card-text etc" style="height: 110px"><?php $descricaoCortada = substr($consultarSalvosTop4['descricao'], 0, 85);
                                                                            echo ($descricaoCortada . '...') ?></p>
                    <form method="POST">
                        <div class="row">
                            <?php

                                    if ($consultarSalvosTop4['id_usuario_inclusao'] == $id_professor) {
                                        echo '<div class="col-sm-9">
                                <a type="submit" href="?p=materias&url=' . $mostrarTop4Materias['url'] . '"
                                    class="btn btn-primary w-100">Acessar</a>
                                <div class="col-sm-12">&nbsp;</div>
                            </div>
                            <div class="col-sm-3">
                                <a type="submit"
                                    href="./admin/?p=materia/nova&id_materia=' . $mostrarTop4Materias['id_materia'] . '"
                            class="btn btn-warning" style="margin-left: -10px;"><img src="./images/write.png" alt=""
                                style="max-width: 24px"></a>
                        </div>';
                                    } else {
                                        echo '<div class="col-sm-12">
                                    <a type="submit" href="?p=materias&url=' . $mostrarTop4Materias['url'] . '"
                                        class="btn btn-primary w-100">Acessar</a>
                                    <div class="col-sm-12">&nbsp;</div>
                                </div>';
                                    }

                                    ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
        </div>
        <?php }
        } else { ?>

        <center>
            <div class="col-sm-12 col-12 mt-3 mb-3">
                <img src="./images/triste.png" alt="" class="img-fluid" width="10%" style="opacity: 0.6"
                    loading="lazy" />
                <h2>Oops!</h2>
                <h5 style="max-width: 400px">Parece que você ainda não salvou nenhuma matéria!</h5>
            </div>
        </center>

        <?php } ?>
    </div>
    <div class="col-sm-12 col-12">&nbsp;</div>
    <div class="col-sm-12 col-12">&nbsp;</div>
    <div class="d-flex justify-content-between align-items-center">

        <h3>Histórico </h3>
        <a href="?p=historicoCompleto" class="float-right">Histórico completo</a>
    </div>

    <div class="col-sm-12 col-12">&nbsp;</div>

    <div class="col-sm-12">
        <div class="row">
            <?php

            include_once './class/historico.php';

            $hist = new Historico();
            $hist->setIdUsuario($id_usuario);
            $top4Historico = $hist->consultarHistoricoTop4();
            if ($top4Historico != null) {
                foreach ($top4Historico as $mostrarTop4Historico) { ?>
            <div class="col-sm-3">
                <div class="card shadow" style="border: none !important;">
                    <?= $mostrarTop4Historico['imagem'] != null ? '<img class="card-img-top img-fluid"
                src="./img/capas/' . $mostrarTop4Historico['imagem'] . '"
                alt="Card image cap" style="height: 200px; object-fit: cover;">' : '<div class="d-flex align-items-center justify-content-center">Image not found</div>' ?>
                    <div class="card-body">
                        <h5 class="card-title etc"><?php $tituloCortado = substr($mostrarTop4Historico['titulo'], 0, 18);
                                                            echo ($tituloCortado . '...')  ?></h5>
                        <p class="card-text etc" style="height: 110px"><?php $descricaoCortada = substr($mostrarTop4Historico['descricao'], 0, 85);
                                                                                echo ($descricaoCortada . '...') ?></p>
                        <form method="POST">
                            <div class="row">
                                <?php

                                        if ($mostrarTop4Historico['id_usuario_inclusao'] == $id_professor) {
                                            echo '<div class="col-sm-9">
                                <a type="submit" href="?p=materias&url=' . $mostrarTop4Materias['url'] . '"
                                    class="btn btn-primary w-100">Acessar</a>
                                <div class="col-sm-12">&nbsp;</div>
                            </div>
                            <div class="col-sm-3">
                                <a type="submit"
                                    href="./admin/?p=materia/nova&id_materia=' . $mostrarTop4Materias['id_materia'] . '"
                            class="btn btn-warning" style="margin-left: -10px;"><img src="./images/write.png" alt=""
                                style="max-width: 24px"></a>
                        </div>';
                                        } else {
                                            echo '<div class="col-sm-12">
                                    <a type="submit" href="?p=materias&url=' . $mostrarTop4Materias['url'] . '"
                                        class="btn btn-primary w-100">Acessar</a>
                                    <div class="col-sm-12">&nbsp;</div>
                                </div>';
                                        }

                                        ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">&nbsp;</div>
            </div>
            <?php }
            } else { ?>

            <center>
                <div class="col-sm-12 col-12 mt-3 mb-3">
                    <img src="./images/triste.png" alt="" class="img-fluid" width="10%" style="opacity: 0.6"
                        loading="lazy" />
                    <h2>Oops!</h2>
                    <h5 style="max-width: 400px">Parece que você ainda não visualizou nenhuma matéria!</h5>
                </div>
            </center>

            <?php } ?>




            <!-- <?php foreach ($top4materias as $mostrarTop4Materias) { ?>
            <div class="col-sm-3">
                <div class="card shadow" style="border: none !important;">
                    <?= $mostrarTop4Materias['imagem'] != null ? '<img class="card-img-top img-fluid"
            src="./img/capas/' . $mostrarTop4Materias['imagem'] . '"
            alt="Card image cap" style="height: 200px; object-fit: cover;">' : '<div class="d-flex align-items-center justify-content-center">Image not found</div>' ?>
                    <div class="card-body">
                        <h5 class="card-title etc"><?php $tituloCortado = substr($mostrarTop4Materias['titulo'], 0, 21);
                                                    echo ($tituloCortado . '...')  ?></h5>
                        <p class="card-text etc"><?php $descricaoCortada = substr($mostrarTop4Materias['descricao'], 0, 85);
                                                    echo ($descricaoCortada . '...') ?></p>
                        <form method="POST">
                            <div class="row">
                                <div class="col-sm-9">
                                    <a type="submit" href="?p=materias&url=<?= $mostrarTop4Materias['url'] ?>"
                                        class="btn btn-primary w-100">Acessar</a>
                                    <div class="col-sm-12">&nbsp;</div>
                                </div>
                                <div class="col-sm-3">
                                    <a type="submit"
                                        href="./admin/?p=materia/nova&id_materia=<?= $mostrarTop4Materias['id_materia'] ?>?>"
                                        class="btn btn-warning w-100"><img src="./images/write.png" alt=""
                                            style="max-width: 24px"></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12">&nbsp;</div>
            </div> <?php } ?> -->
        </div>
    </div>
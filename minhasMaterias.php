<?php

if (!$_SESSION['usuario']) {
    echo '<meta http-equiv="refresh" content="0;URL=./">';
    return;
}

include_once('./class/usuario.php');
include_once('./class/materia.php');
$user = new Usuario();
$materia = new Materia();

$dadosUsuario = $user->pegarDadosUsuario($_SESSION['usuario']);
foreach ($dadosUsuario as $mostrar) {
    $nome = $mostrar['nome'];
    $last_view = $mostrar['last_view'];
    $id_professor = $mostrar['id_professor'];
    $id_usuario = $mostrar['id_usuario'];
}

$top4materias = $materia->ConsultarTodos();
foreach ($top4materias as $mostrarTop4Materias) {
    $titulo = $mostrarTop4Materias['titulo'];
    $id_materia = $mostrarTop4Materias['id_materia'];
    $descricao = $mostrarTop4Materias['descricao'];
    $url = $mostrarTop4Materias['url'];
    $disciplina = $mostrarTop4Materias['disciplina'];
    $imagem = $mostrarTop4Materias['imagem'];
}

?>


<h1>Minhas matérias</h1>
<h5 style="opacity: 0.6">As matérias estão ordenadas por data de cadastro*</h5>

<div class="col-sm-12">&nbsp;</div>

<div class="row">
    <?php

    include_once './class/materia.php';

    $materia = new Materia();
    $materia->setIdUsuario($id_usuario);
    $todasMaterias = $materia->ConsultarPorProfessor($id_professor);
    if ($todasMaterias != null) {
        foreach ($todasMaterias as $consultarMaterias) { ?>
    <div class="col-sm-3">
        <div class="card shadow" style="border: none !important;">
            <?= $consultarMaterias['imagem'] != null ? '<img class="card-img-top img-fluid"
src="./img/capas/' . $consultarMaterias['imagem'] . '"
alt="Card image cap" style="height: 200px; object-fit: cover;">' : '<div class="d-flex align-items-center justify-content-center">Image not found</div>' ?>
            <div class="card-body">
                <h5 class="card-title etc"><?php $tituloCortado = substr($consultarMaterias['titulo'], 0, 18);
                                                    echo ($tituloCortado . '...')  ?></h5>
                <p class="card-text etc" style="height: 110px"><?php $descricaoCortada = substr($consultarMaterias['descricao'], 0, 85);
                                                                        echo ($descricaoCortada . '...') ?></p>
                <form method="POST">
                    <div class="row">
                        <?php

                                if ($materia->ConsultarPorProfessor($id_professor) != false) {
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
            <img src="./images/triste.png" alt="" class="img-fluid" width="10%" style="opacity: 0.6" loading="lazy" />
            <h2>Oops!</h2>
            <h5 style="max-width: 400px">Parece que você ainda não salvou nenhuma matéria!</h5>
        </div>
    </center>

    <?php } ?>
</div>
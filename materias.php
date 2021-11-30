<?php

$titulo_materia_url = filter_input(INPUT_GET, 'url');

include_once './class/materia.php';
$materia = new Materia();


if ($titulo_materia_url != '') {
    $dados = $materia->ConsultarPorUrl($titulo_materia_url);
    foreach ($dados as $mostrar) {
        $id_materia = $mostrar['id_materia'];
        $materiaHtml = $mostrar['materia'];
        $titulo = $mostrar['titulo'];
        $descricao = $mostrar['descricao'];
        $data = $mostrar['data'];
        $nome = $mostrar['nome'] . ' ' . $mostrar['sobrenome'];
        $pdf = $mostrar['pdf'];
    }
} else {
    return;
}

?>
<center>
    <div class="col-md-8 col-12">
        <form class="input-group mb-3" method="POST">
            <input type="text" class="form-control" placeholder="Pesquise um assunto" aria-label="Recipient's username"
                aria-describedby="button-addon2" />
            <a href="?p=pesquisar" class="btn btn-primary" type="submit" id="button-addon2" name="btn-pesquisar">
                <i class="bi bi-search"></i>
            </a>
        </form>
    </div>
</center>
<div class="col-sm-12 col-12">&nbsp;</div>
<div class="col-sm-12 col-12">&nbsp;</div>


<div class="row">
    <div class="col-sm-9">


        <h2><?= $titulo ?></h2>
        <p><?= $descricao ?></p>


        <div class="row">
            <div class="col-sm-3">
                <p><strong>Publicada em: </strong>
                    <?=

                    $data

                    ?></p>
            </div>
            <div class="col-sm-5">
                <p><strong>Escrito por: </strong>
                    <?=
                    $nome
                    ?></p>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <br>

        <?= $materiaHtml ?>
    </div>
    <?php

    if ($pdf == null) {
        echo '<div class="col-sm-3">
        <button class="btn btn-primary w-100">Salvar</button>
        <div class="col-sm-12 col-12">&nbsp;</div>';
    } else {
        echo '<div class="col-sm-1">
        <button class="btn btn-primary w-100">Salvar</button>
        <div class="col-sm-12 col-12">&nbsp;</div>
    </div>

    <div class="col-sm-2">
        <a href="./img/pdf/' . $pdf . '" download="' . $titulo_materia_url . '" class="btn btn-danger w-100">Mapa mental</a>
    </div>';
    }


    ?>
</div>
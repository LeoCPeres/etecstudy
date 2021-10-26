<?php
$pesquisa = filter_input(INPUT_GET, 'pesquisa');

include_once('./class/materia.php');
$materia = new Materia();

if (isset($pesquisa)) {
    $dados = $materia->ConsultarPorTitulo($pesquisa);
    foreach ($dados as $mostrar) {
        $titulo = $mostrar['titulo'];
        $descricao = $mostrar['descricao'];
        $disciplina = $mostrar['disciplina'];
        $id_materia = $mostrar['id_materia'];
    }
}
?>

<div class="col-md-12 col-12">
    <div class="container">
        <center>
            <div class="col-md-8 col-12">
                <form class="input-group mb-3" method="POST">
                    <input type="text" class="form-control" placeholder="Pesquise um assunto" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?= isset($titulo) ? $titulo : "" ?>" />
                    <a class="btn btn-primary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </a>
                </form>
            </div>
        </center>

        <div class="col-md-12">&nbsp;</div>

        <h1 class="title"> <?= isset($titulo) ? "Resultados para '" . $titulo . "'" : "Últimas matérias" ?></h1>
        <div class="col-md-12">&nbsp;</div>
        <div class="col-md-12">&nbsp;</div>


        <?php
        foreach ($dados as $mostrar) {



        ?>

            <a href="?p=<?= $mostrar['titulo'] ?>" class="link">
                <div class="col-md-12 col-12">
                    <div class="row search-card">
                        <div class="col-md-1 col-1 subject-div">
                            <span class="subject"><?= $mostrar['disciplina'] ?></span>
                        </div>

                        <div class="col-md-11 col-11 search-body">
                            <h4><?= $mostrar['titulo'] ?></h4>
                            <p>
                                <?= $mostrar['descricao'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-12">&nbsp;</div>
                </div>
            </a>
        <?php } ?>
    </div>
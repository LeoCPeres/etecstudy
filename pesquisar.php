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
        $url = $mostrar['url'];
    }
} else {
    $dados = $materia->ConsultarTodos();
    foreach ($dados as $mostrar) {
        $titulo = $mostrar['titulo'];
        $descricao = $mostrar['descricao'];
        $disciplina = $mostrar['disciplina'];
        $id_materia = $mostrar['id_materia'];
        $url = $mostrar['url'];
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


            <div class="col-md-12 col-12">
                <div class="row search-card">
                    <div class="col-md-1 col-1 subject-div">
                        <span class="subject">
                            <?= $mostrar['disciplina'] == 1 ? "A" : "" ?>
                            <?= $mostrar['disciplina'] == 2 ? "B" : "" ?>
                            <?= $mostrar['disciplina'] == 3 ? "F" : "" ?>
                            <?= $mostrar['disciplina'] == 4 ? "G" : "" ?>
                            <?= $mostrar['disciplina'] == 5 ? "H" : "" ?>
                            <?= $mostrar['disciplina'] == 6 ? "I" : "" ?>
                            <?= $mostrar['disciplina'] == 7 ? "L" : "" ?>
                            <?= $mostrar['disciplina'] == 8 ? "M" : "" ?>
                            <?= $mostrar['disciplina'] == 9 ? "P" : "" ?>
                            <?= $mostrar['disciplina'] == 10 ? "Q" : "" ?>
                            <?= $mostrar['disciplina'] == 11 ? "R" : "" ?>


                        </span>
                    </div>

                    <div class="col-md-10 col-10 search-body">
                        <a href="?p=<?= $mostrar['url'] ?>" class="link">
                            <h4><?= $mostrar['titulo'] ?></h4>
                            <p>
                                <?= $mostrar['descricao'] ?>
                            </p>

                        </a>
                    </div>
                    <div class="col-md-1 col-1">
                        <a href="./admin/?p=materia&id_materia=<?= $mostrar['id_materia'] ?>" class="btn-search"><img src="./images/write.png" class="img-fluid p-3"></a>
                    </div>
                </div>
                <div class="col-md-12">&nbsp;</div>
            </div>

        <?php } ?>
    </div>
<?php
$pesquisa = filter_input(INPUT_GET, 'pesquisa');

include_once('./class/materia.php');
include_once('./class/disciplina.php');
include_once('./class/usuario.php');
$materia = new Materia();
$disc = new Disciplina();
$user = new Usuario();

$dadosUsuario = $user->pegarDadosUsuario($_SESSION['usuario']);
foreach ($dadosUsuario as $mostrar) {
    $nome = $mostrar['nome'];
    $last_view = $mostrar['last_view'];
    $id_professor = $mostrar['id_professor'];
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
                <form class="input-group mb-3" method="POST">
                    <input type="text" class="form-control" placeholder="Pesquise um assunto"
                        aria-label="Recipient's username" aria-describedby="button-addon2"
                        value="<?= isset($pesquisa) ? $titulo : "" ?>" />
                    <a class="btn btn-primary" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </a>
                </form>
            </div>
        </center>

        <div class="col-md-12">&nbsp;</div>

        <h1 class="title"> <?= isset($pesquisa) ? "Resultados para '" . $titulo . "'" : "Todas as matérias" ?></h1>
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
                    <a href="?p=materias&url=<?= $mostrar['url'] ?>" class="link">
                        <h4><?= $mostrar['titulo'] ?></h4>
                        <p>
                            <?= $mostrar['descricao'] ?>
                        </p>

                    </a>
                </div>
                <?= $id_usuario_inclusao == $id_professor ? '<div class="col-md-1 col-1">
                    <a href="./admin/?p=materia/nova&id_materia=' . $mostrar['id_materia'] . '" class="btn-search"><img
                            src="./images/write.png" class="img-fluid p-3"></a>
                </div>' : '' ?>
            </div>
            <div class="col-md-12">&nbsp;</div>
        </div>

        <?php } ?>
    </div>
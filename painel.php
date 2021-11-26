<?php

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

<?php
if ($id_professor == null) {

    $horaAtual = date('H');
    $recepcao;

    if ($horaAtual >= 6) {
        $recepcao = "<h1>Bom dia, ";
    } else if ($horaAtual >= 12) {
        $recepcao = "<h1>Boa tarde, ";
    } else {
        $recepcao = "<h1>Boa noite, ";
    }


    echo $recepcao . $nome . '!</h1>';
} else {
    echo $recepcao . 'professor ' . $nome . '!</h1>';
}

?>

<div class="col-sm-12 col-12">&nbsp;</div>


<?php

if ($last_view == null) {
    echo '<h3>Recomendações</h3>

    <div class="col-sm-12 col-12">&nbsp;</div>
    
    <div class="col-sm-12">
        <div class="row">'; ?>
<?php foreach ($top4materias as $mostrarTop4Materias) {



    ?>
<div class="col-sm-3">
    <div class="card shadow" style="border: none !important;">
        <?= $mostrarTop4Materias['imagem'] != null ? '<img class="card-img-top img-fluid"
            src="./img/capas/' . $mostrarTop4Materias['imagem'] . '"
            alt="Card image cap" style="height: 200px; object-fit: cover;">' : '<div class="d-flex align-items-center justify-content-center">Image not found</div>' ?>
        <div class="card-body">
            <h5 class="card-title etc"><?php $tituloCortado = substr($mostrarTop4Materias['titulo'], 0, 21);
                                                echo ($tituloCortado . '...')  ?></h5>
            <p class="card-text etc"><?php $descricaoCortada = substr($mostrarTop4Materias['descricao'], 0, 96);
                                                echo ($descricaoCortada . '...') ?></p>
            <a href="./materia/<?= $mostrarTop4Materias['url'] ?>" class="btn btn-primary w-100">Acessar</a>
        </div>
    </div>
    <div class="col-md-12">&nbsp;</div>
</div> <?php } ?> <?php echo '
        </div>
    </div>
    <div class="col-sm-12 col-12">&nbsp;</div>
    <div class="col-sm-12 col-12">&nbsp;</div>';
                        }



                            ?>
<h3>Meus salvos</h3>

<div class="col-sm-12 col-12">&nbsp;</div>

<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-3">
            <!-- <div class="card">
                <img class="card-img-top img-fluid" src="https://t5z6q4c2.rocketcdn.me/wp-content/uploads/2019/10/segunda-guerra-mundial-causas-paises-envolvidos-e-consequencias-1024x614.jpg" alt="Card image cap" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title etc">Segunda Guerra Mundial asdadasd</h5>
                    <p class="card-text etc">A Segunda Guerra Mundial foi um conflito militar global que durou de 1939 a 1945, envolvendo a maioria das naÃ§Ãµes do mundo incluindo todas as grandes potÃªncias â€” organ alianÃ§as militares opostas: os Aliados e o Eixo...</p>
                    <a href="#" class="btn btn-primary w-100">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="https://t5z6q4c2.rocketcdn.me/wp-content/uploads/2019/10/segunda-guerra-mundial-causas-paises-envolvidos-e-consequencias-1024x614.jpg" alt="Card image cap" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title etc">Segunda Guerra Mundial asdadasd</h5>
                    <p class="card-text etc">A Segunda Guerra Mundial foi um conflito militar global que durou de 1939 a 1945, envolvendo a maioria das naÃ§Ãµes do mundo incluindo todas as grandes potÃªncias â€” organ alianÃ§as militares opostas: os Aliados e o Eixo...</p>
                    <a href="#" class="btn btn-primary w-100">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="https://t5z6q4c2.rocketcdn.me/wp-content/uploads/2019/10/segunda-guerra-mundial-causas-paises-envolvidos-e-consequencias-1024x614.jpg" alt="Card image cap" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title etc">Segunda Guerra Mundial asdadasd</h5>
                    <p class="card-text etc">A Segunda Guerra Mundial foi um conflito militar global que durou de 1939 a 1945, envolvendo a maioria das naÃ§Ãµes do mundo incluindo todas as grandes potÃªncias â€” organ alianÃ§as militares opostas: os Aliados e o Eixo...</p>
                    <a href="#" class="btn btn-primary w-100">Acessar</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <img class="card-img-top img-fluid" src="https://t5z6q4c2.rocketcdn.me/wp-content/uploads/2019/10/segunda-guerra-mundial-causas-paises-envolvidos-e-consequencias-1024x614.jpg" alt="Card image cap" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title etc">Segunda Guerra Mundial asdadasd</h5>
                    <p class="card-text etc">A Segunda Guerra Mundial foi um conflito militar global que durou de 1939 a 1945, envolvendo a maioria das naÃ§Ãµes do mundo incluindo todas as grandes potÃªncias â€” organ alianÃ§as militares opostas: os Aliados e o Eixo...</p>
                    <a href="#" class="btn btn-primary w-100">Acessar</a>
                </div>
            </div>
        </div> -->


        </div>
        <center>
            <div class="col-sm-12 col-12 mt-3 mb-3">
                <img src="./images/triste.png" alt="" class="img-fluid" width="10%" style="opacity: 0.6"
                    loading="lazy" />
                <h2>Oops!</h2>
                <h5 style="max-width: 400px">Parece que você ainda não visualizou nenhuma matéria!</h5>
            </div>
        </center>
    </div>
    <div class="col-sm-12 col-12">&nbsp;</div>
    <div class="col-sm-12 col-12">&nbsp;</div>
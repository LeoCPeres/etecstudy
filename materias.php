<?php
date_default_timezone_set('America/Sao_Paulo');
$titulo_materia_url = filter_input(INPUT_GET, 'url');

include_once './class/materia.php';
include_once './class/usuario.php';
$materia = new Materia();
$user = new Usuario();

if ($materia->ConsultarPorUrl($titulo_materia_url) == null) {
    echo '<meta http-equiv="refresh" content="0;URL=./">';
}

if (isset($_SESSION['usuario'])) {
    $dadosUsuario = $user->pegarDadosUsuario($_SESSION['usuario']);
    foreach ($dadosUsuario as $mostrar) {
        $nome = $mostrar['nome'];
        $last_view = $mostrar['last_view'];
        $id_professor = $mostrar['id_professor'];
        $id_usuario = $mostrar['id_usuario'];
    }
    $historico;

    if ($last_view == null) {
        $historico = $titulo_materia_url . ';';
    } else {
        $historico = $last_view . $titulo_materia_url . ';';
    }

    $user->setLastView($historico);
    $user->setId($id_usuario);
    $user->salvarHistorico();

    if ($titulo_materia_url != '' || $teste != null) {
        $dados = $materia->ConsultarPorUrl($titulo_materia_url);
        foreach ($dados as $mostrar) {
            $id_materia = $mostrar['id_materia'];
            $materiaHtml = $mostrar['materia'];
            $titulo = $mostrar['titulo'];
            $descricao = $mostrar['descricao'];
            $data = $mostrar['data'];
            $nome = $mostrar['nome'] . ' ' . $mostrar['sobrenome'];
            $pdf = $mostrar['pdf'];
            $visitas = $mostrar['visitas'];



            if ($visitas == null) {
                $visitas = 1;
            } else {
                $visitas = $visitas + 1;
            }

            $materia->setVisitas($visitas);
            $materia->setId_Materia($id_materia);
            $materia->atualizaVisitas();

            include_once './class/historico.php';
            $hist = new Historico();

            $acesso = date('d/m/Y') . ' ' . date('H:i');

            $hist->setUrl($titulo_materia_url);
            $hist->setIdUsuario($id_usuario);
            $hist->setAcesso($acesso);
            $hist->salvarHistorico();

            include_once './class/salvos.php';
            $saved = new Salvos();
            $saved->setUrl($titulo_materia_url);
            $saved->setIdUsuario($id_usuario);
            $dadosSaved = $saved->consultarPaginaSalva();
        }
    } else {
        return;
    }
} else {
    if ($titulo_materia_url != '' || $teste != null) {
        $dados = $materia->ConsultarPorUrl($titulo_materia_url);
        foreach ($dados as $mostrar) {
            $id_materia = $mostrar['id_materia'];
            $materiaHtml = $mostrar['materia'];
            $titulo = $mostrar['titulo'];
            $descricao = $mostrar['descricao'];
            $data = $mostrar['data'];
            $nome = $mostrar['nome'] . ' ' . $mostrar['sobrenome'];
            $pdf = $mostrar['pdf'];
            $visitas = $mostrar['visitas'];



            if ($visitas == null) {
                $visitas = 1;
            } else {
                $visitas = $visitas + 1;
            }

            $materia->setVisitas($visitas);
            $materia->setId_Materia($id_materia);
            $materia->atualizaVisitas();
        }
    } else {
        echo '<meta http-equiv="refresh" content="0;URL=./">';
    }
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
            <div class="col-sm-4">
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

        </div>
        <br>

        <?= $materiaHtml ?>
    </div>
    <?php

    if (isset($_SESSION['usuario'])) {
        if ($pdf == null) {
            if ($dadosSaved < 1) {
                echo '<div class="col-sm-3">
            <input type="submit" class="btn btn-primary w-100" name="btn-remover" value="Salvar"></input>
            <div class="col-sm-12 col-12">&nbsp;</div>';
            } else {
                echo '<div class="col-sm-3">
            <input type="submit" class="btn btn-danger w-100" name="btn-remover" value="Remover"></input>
            <div class="col-sm-12 col-12">&nbsp;</div>';
            }
        } else {

            if (count($dadosSaved) < 1) {
                echo '<form method="POST" class="col-sm-1">
            <input type="submit" class="btn btn-primary w-100" value="Salvar" name="btn-salvar"></input>
            <div class="col-sm-12 col-12">&nbsp;</div>
        </form>
    
        <div class="col-sm-2">
            <a href="./img/pdf/' . $pdf . '" download="' . $titulo_materia_url . '" class="btn btn-danger w-100">Mapa mental</a>
        </div>';
            } else {
                echo '<form method="POST" class="col-sm-1">
            <input type="submit" class="btn btn-primary w-100" value="Salvo" name="btn-remover"></input>
            <div class="col-sm-12 col-12">&nbsp;</div>
        </form>
    
        <div class="col-sm-2">
            <a href="./img/pdf/' . $pdf . '" download="' . $titulo_materia_url . '" class="btn btn-danger w-100">Mapa mental</a>
        </div>';
            }
        }
    } else {
        echo '<div class="col-sm-3">
        <a href="./img/pdf/' . $pdf . '" download="' . $titulo_materia_url . '" class="btn btn-danger w-100">Mapa mental</a>
    </div>';
    }
    ?>
</div>

<?php

if (filter_input(INPUT_POST, 'btn-salvar')) {

    if ($saved->salvarSalvos()) { ?>
<meta http-equiv="refresh" content="0.1;URL=?p=materias&url=<?= $titulo_materia_url ?>">
<?php } else {
        echo 'erro';
    }
}

?>

<?php

if (filter_input(INPUT_POST, 'btn-remover')) {

    if ($saved->deletarSalvo()) { ?>
<meta http-equiv="refresh" content="0.1;URL=?p=materias&url=<?= $titulo_materia_url ?>">
<?php } else {
        echo 'erro';
    }
}

?>
</div>
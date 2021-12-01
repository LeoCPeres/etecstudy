<?php

include_once('./class/usuario.php');
include_once('./class/materia.php');
$user = new Usuario();

$dadosUsuario = $user->pegarDadosUsuario($_SESSION['usuario']);
foreach ($dadosUsuario as $mostrar) {
    $nome = $mostrar['nome'];
    $last_view = $mostrar['last_view'];
    $id_professor = $mostrar['id_professor'];
    $id_usuario = $mostrar['id_usuario'];
}

?>



<h1>Histórico completo</h1>

<div class="col-md-12">&nbsp;</div>

<div class="card shadow" style="border: none;">
    <table class="table table-striped text-center p-0 m-0">
        <thead>
            <tr>

                <th>Título</th>
                <th>Acessado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php

            include_once './class/historico.php';
            $hist = new Historico();

            $hist->setIdUsuario($id_usuario);
            $dados1 = $hist->consultarHistorico();
            foreach ($dados1 as $mostrar) {

            ?>
            <tr class="">
                <td><?= $mostrar['titulo'] ?></td>
                <td>
                    <?= $mostrar['acesso'] ?>
                </td>
                <td>

                    <a href="?p=materias&url=<?= $mostrar['url'] ?>" class="btn btn-primary ml-2">
                        Acessar
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
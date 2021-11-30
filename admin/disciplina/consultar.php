<?php
$id_disc = filter_input(INPUT_GET, 'id_disc');
?>

<body>
    <div class="col-md-12">
        <h1>Disciplinas cadastradas
            <button class="btn btn-primary" style="float: right; cursor: pointer; text-decoration: none"
                name="btn-new-disc-modal" data-bs-toggle="modal" data-bs-target="#modal-save-disciplina">+ Nova</button>
        </h1>
        <div class="col-md-12">&nbsp;</div>

        <div class="card shadow">
            <table class="table table-striped text-center p-0 m-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Disciplina</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    include_once '../class/disciplina.php';
                    $disc = new Disciplina();

                    $dados = $disc->ConsultarTodasDisciplinas();
                    foreach ($dados as $mostrar) {

                    ?>
                    <tr class="">
                        <td><?= $mostrar['id_disc'] ?></td>
                        <td>
                            <?= $mostrar['disciplina'] ?>
                        </td>
                        <td>

                            <a href="?p=cliente/cadastrar&id_cliente=" class="btn btn-primary ml-2">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


    <form method="POST">
        <div class="modal fade" id="modal-save-disciplina" tabindex="-1" aria-labelledby="modal-save-disciplina"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar nova disciplina</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleFormControlInput1" class="form-label">Nome da disciplina</label>
                        <input type="" class="form-control" name="txt-disciplina-new" placeholder="Ex: matemática"
                            minlength="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" name="btn-nova-disciplina" class="btn btn-primary"
                            value="Cadastrar"></input>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-edit-disciplina" tabindex="-1" aria-labelledby="modal-edit-disciplina"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar disciplina</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleFormControlInput1" class="form-label">Nome da disciplina</label>
                        <input type="" class="form-control" name="txt-disciplina-edit" placeholder="Ex: matemática"
                            minlength="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" name="btn-nova-disciplina" class="btn btn-primary"
                            value="Cadastrar"></input>
                    </div>
                </div>
            </div>
        </div>




    </form>
</body>
<?php

if (filter_input(INPUT_POST, 'btn-nova-disciplina')) {
    $formNovaDisciplina = filter_input(INPUT_POST, 'txt-disciplina-new', FILTER_SANITIZE_STRING);

    $ucwords = ucwords($formNovaDisciplina);

    include_once '../class/disciplina.php';
    $disc = new Disciplina();

    $disc->setDisciplina($ucwords);

    if ($disc->cadastrarNovaDisciplina()) {


?>

<meta http-equiv="refresh" content="0.5;URL=?p=disciplina/consultar" <div
    class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive"
    aria-atomic="true">



<?php

    } else {
    ?>
<div class="alert alert-danger mt-3" role="alert">
    <div class="toast" role="alert" autohide="false" aria-live="assertive" aria-atomic="true">
        <div class="toast-body">
            Falha no cadastro da matéria.
            <div class="mt-2 pt-2 border-top">
                <button type="button" class="btn btn-primary btn-sm">Tentar novamente</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php }
}


?>
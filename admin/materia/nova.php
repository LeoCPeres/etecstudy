<?php
//capturar id da url
$id_materia = filter_input(INPUT_GET, 'id_materia');
date_default_timezone_set('America/Sao_Paulo');

include_once '../class/Materia.php';
include_once '../class/disciplina.php';
$materia = new Materia();
$disc = new Disciplina();

$disciplinas = $disc->ConsultarTodasDisciplinas();
foreach ($disciplinas as $mostrarDisc) {
    $id_disc = $mostrarDisc['id_disc'];
    $disciplinaText = $mostrarDisc['disciplina'];
}

if (isset($id_materia)) {
    $dados = $materia->ConsultarPorId($id_materia);
    foreach ($dados as $mostrar) {
        $titulo = $mostrar['titulo'];
        $descricao = $mostrar['descricao'];
        $materia = $mostrar['materia'];
        $disciplina = $mostrar['disciplina'];
        $verificado = $mostrar['verificado'];
        $idVerificado = $mostrar['idVerificado'];
    }
}

?>

<head>
    <script type="text/javascript">
        window.onload = selecionaProfessor;

        function selecionaProfessor() {
            var isSelected = document.getElementById('selectVerificado');
            var professor = document.getElementById("selectProfessor");
            var lblProfessor = document.getElementById("lblProfessor");
            var options = isSelected.options[isSelected.selectedIndex];

            if (options.value != 1) {
                professor.style.display = "none";
                lblProfessor.style.display = "none";
                professor.value = 0;
                console.log(professor.value);
            } else {
                lblProfessor.style.display = "";
                professor.style.display = "";
            }
        }
    </script>
</head>

<div class="col-md-12">
    <h1><?= isset($id_materia) ? "Editar" : "Escrever nova" ?> matéria</h1>

    <div class="col-md-12">&nbsp;</div>

    <form method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Título</label>
            <input type="text" required class="form-control" id="exampleFormControlInput1" name="txt-titulo" placeholder="Título da matéria" value="<?= isset($id_materia) ? $titulo : "" ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="txt-desc" placeholder="Descrição da matéria" value="<?= isset($id_materia) ? $descricao : "" ?>">
        </div>
        <div class="row">

            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label" style="width: 100%;">
                    Disciplina
                    <a href="?p=disciplina/consultar" class="color-primary" style="float: right; cursor: pointer; text-decoration: none">+ Nova</a>

                </label>
                <select class="form-select" aria-label="Default select example" name="option-disciplina" value="<?= isset($id_materia) ? $disciplina : "" ?>">>

                    <option>Selecione uma disciplina</option>
                    <?php

                    foreach ($disciplinas as $mostrarDisc) {



                    ?>

                        <option value=<?= $mostrarDisc['id_disc'] ?> <?= isset($id_materia) ? (($disciplina == $mostrarDisc['id_disc']) ? 'selected' : '') : ''; ?>> <?= $mostrarDisc['disciplina'] ?>
                        </option>

                    <?php } ?>


                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Verificado</label>
                <select onChange="selecionaProfessor()" class="form-select" name="option-verificado" aria-label="Default select example" id="selectVerificado" name="option-disciplina" value="<?= isset($id_materia) ? $disciplina : "" ?>"> >

                    <option>Selecione opção</option>
                    <option value="1" <?= isset($id_materia) ? (($verificado == 1) ? 'selected' : '') : ""; ?>>Sim
                    </option>
                    <option value="0" <?= isset($id_materia) ? (($verificado == 0) ? 'selected' : '') : ""; ?>>Não
                    </option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label" id="lblProfessor">Professor</label>
                <select class="form-select" name="option-professor" aria-label="Default select example" id="selectProfessor" name="option-disciplina" value="<?= isset($id_materia) ? $disciplina : "" ?>">>

                    <option>Selecione um professor</option>
                    <option value="1" <?= isset($id_materia) ? (($idVerificado == 1) ? 'selected' : '') : ''; ?>>Gerson
                        - Sociologia</option>
                    <option value="2" <?= isset($id_materia) ? (($idVerificado == 2) ? 'selected' : '') : ''; ?>>Rita -
                        Matemática</option>
                    <option value="2" <?= isset($id_materia) ? (($idVerificado == 3) ? 'selected' : '') : ''; ?>>
                        Patrícia - Física</option>
                    <option value="2" <?= isset($id_materia) ? (($idVerificado == 4) ? 'selected' : '') : ''; ?>>Kátia -
                        Geografia</option>


                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Matéria</label>
            <textarea class="form-control" id="editor" name="txt-materia" spellcheck="true"><?= isset($id_materia) ? $materia : "" ?></textarea>

        </div>
        <?= isset($id_materia) ? '<input type="button" class="btn btn-primary" style="float: right" name="btn-editar-modal" data-bs-toggle="modal"
    data-bs-target="#modal-save-changes" value="Salvar alterações"></input>' : '<input type="submit" class="btn btn-primary" style="float: right" name="btn-salvar"
    value="Cadastrar matéria"></input>' ?>
        <?= isset($id_materia) ? '<input type="button" class="btn btn-danger" style="float: right; margin-right: 10px;" name="btn-editar-modal" data-bs-toggle="modal"
    data-bs-target="#modal-save-changes" value="Deletar matéria"></input>' : '' ?>




        <div class="modal fade" id="modal-save-changes" tabindex="-1" aria-labelledby="modal-save-changes" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atenção!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Você realmente deseja salvar estas alterações?</p>
                        <span>Esta ação não tem volta.</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" name="btn-editar" class="btn btn-primary" value="Sim, salvar."></input>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-save-disciplina" tabindex="-1" aria-labelledby="modal-save-disciplina" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar nova disciplina</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleFormControlInput1" class="form-label">Nome da disciplina</label>
                        <input type="" class="form-control" name="txt-disciplina-new" placeholder="Ex: matemática">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <input type="submit" name="btn-nova-disciplina" class="btn btn-primary" value="Cadastrar"></input>
                    </div>
                </div>
            </div>
        </div>

    </form>




</div>

<?php
if (filter_input(INPUT_POST, 'btn-salvar')) {
    //pegar dados do form
    $formTitulo = filter_input(INPUT_POST, 'txt-titulo', FILTER_SANITIZE_STRING);
    $formDesc = filter_input(INPUT_POST, 'txt-desc', FILTER_SANITIZE_STRING);
    $formDisc = filter_input(INPUT_POST, 'option-disciplina');
    $formMateria = filter_input(INPUT_POST, 'txt-materia');
    $formVerificado = filter_input(INPUT_POST, 'option-verificado');
    $formProfessor = filter_input(INPUT_POST, 'option-professor');
    $data = date('Y/m/d');

    //estabelecer conversa com class categoria
    include_once '../class/materia.php';
    $materia = new Materia();

    $decodedWithoutUTF8 = urldecode($formMateria);
    $decodedWithUTF8 = utf8_encode($decodedWithoutUTF8);

    //enviar dados para atributos
    $materia->setTitulo($formTitulo);
    $materia->setDescricao($formDesc);
    $materia->setDisciplina($formDisc);
    $materia->setMateria($decodedWithUTF8);
    $materia->setIdVerificado($formProfessor);
    $materia->setVerificado($formVerificado);
    $materia->setData($data);

    //efetuar cadastro com msg
    if ($materia->salvar()) {


?>

        <div class="alert alert-primary 
        mt-3" role="alert">
            Cadastrado com sucesso
        </div>


    <?php

    } else {
    ?>
        <div class="alert alert-danger mt-3" role="alert">
            Falha no cadastro!
        </div>

    <?php }
}

if (filter_input(INPUT_POST, 'btn-editar')) {
    //pegar dados do form
    $formTitulo = filter_input(INPUT_POST, 'txt-titulo', FILTER_SANITIZE_STRING);
    $formDesc = filter_input(INPUT_POST, 'txt-desc', FILTER_SANITIZE_STRING);
    $formDisc = filter_input(INPUT_POST, 'option-disciplina');
    $formMateria = filter_input(INPUT_POST, 'txt-materia');
    $formVerificado = filter_input(INPUT_POST, 'option-verificado');
    $formProfessor = filter_input(INPUT_POST, 'option-professor');
    $id_materia = filter_input(INPUT_GET, 'id_materia');
    $data = date('Y/m/d');

    $decodedWithoutUTF8 = urldecode($formMateria);
    $decodedWithUTF8 = utf8_encode($decodedWithoutUTF8);

    //estabelecer conversa com class categoria
    include_once '../class/materia.php';
    $materia = new Materia();

    //enviar dados para atributos
    $materia->setTitulo($formTitulo);
    $materia->setDescricao($formDesc);
    $materia->setDisciplina($formDisc);
    $materia->setMateria($decodedWithUTF8);
    $materia->setIdVerificado($formProfessor);
    $materia->setVerificado($formVerificado);
    $materia->setData($data);
    $materia->setId_Materia($id_materia);


    //efetuar cadastro com msg
    if ($materia->editar()) {


    ?>

        <div class="alert alert-success mt-3" role="alert">
            Editado com sucesso! Estamos te redirecionando para a página da matéria.
            <meta http-equiv="refresh" content="3;URL=./?p=materia&id_materia=<?= $id_materia ?>">
        </div>


    <?php

    } else {
    ?>
        <div class="alert alert-danger mt-3" role="alert">
            Falha na edição!
        </div>

<?php }
}





?>
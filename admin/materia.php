<?php
//capturar id da url
$id_materia = filter_input(INPUT_GET, 'id_materia');
date_default_timezone_set('America/Sao_Paulo');

include_once '../class/Materia.php';
$materia = new Materia();

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
                <label for="exampleFormControlInput1" class="form-label">Disciplina</label>
                <select class="form-select" aria-label="Default select example" name="option-disciplina" value="<?= isset($id_materia) ? $disciplina : "" ?>">>

                    <option>Selecione uma disciplina</option>
                    <option value="1" <?= isset($id_materia) ? (($disciplina == 1) ? 'selected' : '') : ''; ?>>Artes</option>       
                    <option value="2" <?= isset($id_materia) ? (($disciplina == 2) ? 'selected' : '') : ''; ?>>Biologia</option>
                    <option value="3" <?= isset($id_materia) ? (($disciplina == 3) ? 'selected' : '') : ''; ?>>Física</option>
                    <option value="4" <?= isset($id_materia) ? (($disciplina == 4) ? 'selected' : '') : ''; ?>>Geografia</option>
                    <option value="5" <?= isset($id_materia) ? (($disciplina == 5) ? 'selected' : '') : ''; ?>>História</option>
                    <option value="6" <?= isset($id_materia) ? (($disciplina == 6) ? 'selected' : '') : ''; ?>>Inglês</option>
                    <option value="7" <?= isset($id_materia) ? (($disciplina == 7) ? 'selected' : '') : ''; ?>>Literatura</option>
                    <option value="8" <?= isset($id_materia) ? (($disciplina == 8) ? 'selected' : '') : ''; ?>>Matemática</option>
                    <option value="9" <?= isset($id_materia) ? (($disciplina == 9) ? 'selected' : '') : ''; ?>>Português</option>
                    <option value="10" <?= isset($id_materia) ? (($disciplina == 10) ? 'selected' : '') : ''; ?>>Química</option>
                    <option value="11" <?= isset($id_materia) ? (($disciplina == 11) ? 'selected' : '') : ''; ?>>Redação</option>

                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Verificado</label>
                <select onChange="selecionaProfessor()" class="form-select" name="option-verificado" aria-label="Default select example" id="selectVerificado" name="option-disciplina" value="<?= isset($id_materia) ? $disciplina : "" ?>"> >

                    <option>Selecione opção</option>
                    <option value="1" <?= isset($id_materia) ? (($verificado == 1) ? 'selected' : '') : ""; ?>>Sim</option>        
                    <option value="0" <?= isset($id_materia) ? (($verificado == 0) ? 'selected' : '') : "";?>>Não</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label" id="lblProfessor">Professor</label>
                <select class="form-select" name="option-professor" aria-label="Default select example" id="selectProfessor" name="option-disciplina" value="<?= isset($id_materia) ? $disciplina : "" ?>">>

                    <option>Selecione um professor</option>
                    <option value="1" <?= isset($id_materia) ? (($idVerificado == 1) ? 'selected' : '') : ''; ?>>Gerson - Sociologia</option>  
                    <option value="2" <?= isset($id_materia) ? (($idVerificado == 2) ? 'selected' : '') : ''; ?>>Rita - Matemática</option>
                    <option value="2" <?= isset($id_materia) ? (($idVerificado == 3) ? 'selected' : '') : ''; ?>>Patrícia - Física</option>
                    <option value="2" <?= isset($id_materia) ? (($idVerificado == 4) ? 'selected' : '') : ''; ?>>Kátia - Geografia</option>


                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Matéria</label>
            <textarea class="form-control" id="editor" name="txt-materia" spellcheck="true"><?= isset($id_materia) ? $materia : "" ?></textarea>

        </div>
        <input type="submit" class="btn btn-primary" style="float: right" name="btn-salvar" value="<?= isset($id_materia) ? "Salvar alterações" : "Cadastrar matéria" ?>"></input>

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

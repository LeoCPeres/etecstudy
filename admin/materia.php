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
    }
}

?>

<div class="col-md-12">
    <h1><?= isset($id_materia) ? "Editar" : "Escrever nova" ?> matéria</h1>

    <div class="col-md-12">&nbsp;</div>

    <form method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Título</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="txt-titulo" placeholder="Título da matéria" value="<?= isset($id_materia) ? $titulo : "" ?>">
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
                    <option value="1">Artes</option>
                    <option value="2">Biologia</option>
                    <option value="3">Física</option>
                    <option value="4">Geografia</option>
                    <option value="5">História</option>
                    <option value="6">Inglês</option>
                    <option value="7">Literatura</option>
                    <option value="8">Matemática</option>
                    <option value="9">Português</option>
                    <option value="10">Química</option>
                    <option value="11">Redação</option>

                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Verificado</label>
                <select class="form-select" aria-label="Default select example" name="option-disciplina" value="<?= isset($id_materia) ? $disciplina : "" ?>">>

                    <option>Selecione opção</option>
                    <option value="1">Sim</option>
                    <option value="2">Não</option>


                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Professor</label>
                <select class="form-select" aria-label="Default select example" name="option-disciplina" value="<?= isset($id_materia) ? $disciplina : "" ?>">>

                    <option>Selecione um professor</option>
                    <option value="1">Gerson - Sociologia</option>
                    <option value="2">Rita - Matemática</option>
                    <option value="2">Patrícia - Física</option>
                    <option value="2">Kátia - Geografia</option>


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

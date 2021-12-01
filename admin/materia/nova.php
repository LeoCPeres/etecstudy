<?php

//capturar id da url
$id_materia = filter_input(INPUT_GET, 'id_materia');
date_default_timezone_set('America/Sao_Paulo');

include_once '../class/materia.php';
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
        $id_imagem = $mostrar['imagem'];
        $id_disc = $mostrar['id_disc'];
        $imagem1 = $mostrar['imagem'];
        $temp_imagem1 = $mostrar['temp_imagem'];
        $urlAnterior = $mostrar['url'];
    }
}

?>

<div class="col-md-12">
    <h1><?= isset($id_materia) ? "Editar" : "Escrever nova" ?> matéria</h1>

    <div class="col-md-12">&nbsp;</div>

    <form method="POST" enctype="multipart/form-data" name="formsalvar" id="formSalvar">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Título</label>
            <input type="text" required class="form-control" id="exampleFormControlInput1" name="txt-titulo"
                minlength="10" placeholder="Título da matéria" value="<?= isset($id_materia) ? $titulo : "" ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="txt-desc" minlength="88"
                placeholder="Descrição da matéria" value="<?= isset($id_materia) ? $descricao : "" ?>">
        </div>
        <div class="row">

            <div class="col-md-4 mb-3">
                <label for="exampleFormControlInput1" class="form-label" style="width: 100%;">
                    Disciplina
                    <a href="?p=disciplina/consultar" class="color-primary"
                        style="float: right; cursor: pointer; text-decoration: none">+ Nova</a>

                </label>
                <select class="form-select" aria-label="Default select example" name="option-disciplina"
                    value="<?= isset($id_materia) ? $id_disc : "" ?>">>

                    <option>Selecione uma disciplina</option>
                    <?php

                    foreach ($disciplinas as $mostrarDisc) {



                    ?>

                    <option value=<?= $mostrarDisc['id_disc'] ?>
                        <?= isset($id_disc) ? (($id_disc == $mostrarDisc['id_disc']) ? 'selected' : '') : ''; ?>>
                        <?= $mostrarDisc['disciplina'] ?>
                    </option>

                    <?php } ?>


                </select>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Mapa mental - (opcional)</label>
                    <input class="form-control input-file" id="pdf" name="pdf" type="file">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Imagem de capa</label>
                    <input class="form-control input-file" id="imagem" name="imagem" type="file" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Matéria</label>
            <textarea class="form-control" id="editor" name="txt-materia" minlength="50" rows="12"
                spellcheck="true"><?= isset($id_materia) ? $materia : "" ?></textarea>

        </div>
        <?= isset($id_materia) ? '<input type="button" class="btn btn-primary" style="float: right" name="btn-editar-modal" data-bs-toggle="modal"
    data-bs-target="#modal-save-changes" value="Salvar alterações"></input>' : '<input type="submit" class="btn btn-primary" style="float: right" name="btn-salvar"
    value="Cadastrar matéria"></input>' ?>
        <?= isset($id_materia) ? '<input type="button" class="btn btn-danger" style="float: right; margin-right: 10px;" name="btn-editar-modal" data-bs-toggle="modal"
    data-bs-target="#modal-save-changes" value="Deletar matéria"></input>' : '' ?>




        <div class="modal fade" id="modal-save-changes" tabindex="-1" aria-labelledby="modal-save-changes"
            aria-hidden="true">
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
                        <input type="" class="form-control" name="txt-disciplina-new" placeholder="Ex: matemática">
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




</div>

<?php
if (filter_input(INPUT_POST, 'btn-salvar')) {
    //pegar dados do form
    $formTitulo = filter_input(INPUT_POST, 'txt-titulo', FILTER_SANITIZE_STRING);
    $formDesc = filter_input(INPUT_POST, 'txt-desc', FILTER_SANITIZE_STRING);
    $formDisc = filter_input(INPUT_POST, 'option-disciplina');
    $formMateria = filter_input(INPUT_POST, 'txt-materia');
    $data = date('d/m/Y');

    $imagem = $_FILES['imagem']['name'];
    $temp_imagem = $_FILES['imagem']['tmp_name'];
    $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
    $imagem = uniqid(time()) . "." . $extensao;

    $pdf = $_FILES['pdf']['name'];
    $temp_pdf = $_FILES['pdf']['tmp_name'];
    $extensaoPDF = strtolower(pathinfo($pdf, PATHINFO_EXTENSION));
    $pdf = uniqid(time()) . "." . $extensaoPDF;

    //estabelecer conversa com class categoria
    include_once '../class/materia.php';
    include_once '../class/usuario.php';
    $materia = new Materia();
    $usuario = new Usuario();

    $decodedWithoutUTF8 = urldecode($formMateria);
    $decodedWithUTF8 = utf8_encode($decodedWithoutUTF8);

    $dadosUsuario = $usuario->pegarDadosUsuario($_SESSION['usuario']);

    foreach ($dadosUsuario as $mostrar) {
        $nome = $mostrar['nome'];
        $last_view = $mostrar['last_view'];
        $id_professor = $mostrar['id_professor'];
        $id_usuario = $mostrar['id_usuario'];
    }

    //enviar dados para atributos
    $materia->setTitulo($formTitulo);
    $materia->setDescricao($formDesc);
    $materia->setDisciplina($formDisc);
    $materia->setMateria($decodedWithUTF8);
    $materia->setData($data);
    $materia->setImagem($imagem);
    $materia->setTempImagem($temp_imagem);
    $materia->setIdUsuario($id_usuario);
    if ($pdf != null) {
        $materia->setPDF($pdf);
        $materia->setTempPDF($temp_pdf);
    }


    if (strstr('.jpg;.jpeg;.png;.pdf', $extensao) || strstr('.jpg;.jpeg;.png;.pdf', $extensaoPDF)) {
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
    $data = date('d/m/Y');

    $imagem = $_FILES['imagem']['name'];
    $temp_imagem = $_FILES['imagem']['tmp_name'];
    $extensao = strtolower(pathinfo($imagem, PATHINFO_EXTENSION));
    $extensaoJaExistente = explode(".", $imagem1);
    $extensaoComPonto = '.' . $extensaoJaExistente[1];
    $imagem == null ? null : $imagem = uniqid(time()) . "." . $extensao;

    $decodedWithoutUTF8 = urldecode($formMateria);
    $decodedWithUTF8 = utf8_encode($decodedWithoutUTF8);

    //estabelecer conversa com class categoria
    include_once '../class/materia.php';
    $materia = new Materia();
    include_once '../class/usuario.php';
    $usuario = new Usuario();
    include_once '../class/historico.php';
    $hist = new Historico();
    $dadosUsuario = $usuario->pegarDadosUsuario($_SESSION['usuario']);

    foreach ($dadosUsuario as $mostrar) {
        $nome = $mostrar['nome'];
        $last_view = $mostrar['last_view'];
        $id_professor = $mostrar['id_professor'];
        $id_usuario = $mostrar['id_usuario'];
    }

    //enviar dados para atributos
    $materia->setTitulo($formTitulo);
    $materia->setDescricao($formDesc);
    $materia->setDisciplina($formDisc);
    $materia->setMateria($decodedWithUTF8);
    $materia->setData($data);
    $materia->setId_Materia($id_materia);
    $materia->setImagem($imagem == null ? $imagem1 : $imagem);
    $materia->setTempImagem($temp_imagem == null ? $temp_imagem1 : $temp_imagem);
    $materia->setIdUsuario($id_materia);
    $hist->setUrlAnterior($urlAnterior);
    $hist->setUrl($formTitulo);
    $hist->editarHistorico();



    if (strstr('.jpg;.jpeg;.png', ($extensao === '' ? $extensaoComPonto : $extensao))) {
        //efetuar cadastro com msg
        if ($materia->editar()) {


        ?>

<div class="alert alert-success mt-3" role="alert">
    Editado com sucesso! Estamos te redirecionando para o painel do professor.
    <meta http-equiv="refresh" content="3;URL=../">
</div>


<?php

        } else {
        ?>
<div class="alert alert-danger mt-3" role="alert">
    Falha na edição!
</div>

<?php }
    }
}


?>
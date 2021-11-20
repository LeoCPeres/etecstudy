<?php

$id_disc = filter_input(INPUT_GET, 'id_disc');

include_once '../class/materia.php';
$materia = new Materia();

$materia->setId_Disc($id_disc);

if ($materia->excluirDisc()) {

?>

    <div class="alert alert-success mt-3" role="alert">
        Excluído com sucesso!
    </div>

<?php

} else {
?>
    <div class="alert alert-danger mt-3" role="alert">
        Erro ao excluir!
    </div>
<?php } ?>

<meta http-equiv="refresh" content="2;URL=?p=disciplina/consultar"
<?php

if (!$_SESSION['usuario']) {
    echo '<meta http-equiv="refresh" content="0;URL=./">';
    return;
}



?>


<h1>Minhas matérias</h1>
<h5 style="opacity: 0.6">As matérias estão ordenadas por data de cadastro*</h5>
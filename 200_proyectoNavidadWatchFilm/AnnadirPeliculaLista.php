<?php

require_once "_com/DAO.php";

if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");
$listas = DAO::listasObtener($_SESSION["id"]);


$peliculaId = $_REQUEST["id"];

$tema = comprobarTema();



?>

<html lang=''>
<head>
    <meta charset='UTF-8'>
    <title></title>
    <?php if ($tema) { ?>
        <link rel="stylesheet" href="_styles/styleBlack.css">
    <?php } else { ?>
        <link rel="stylesheet" href="_styles/style.css">
    <?php } ?>
</head>


<header><a href="PaginaPrincipal.php"><img src="_img/logo.png" width="150" height="120"/> </a> </header>

<body class='<?= $tema ?>'>

<h2>Selecciona la lista a la que quieres añadir la película</h2>


<?php

if ($listas == null) {//creamos una lista predeterminada al crear un usuario, si no, se muestran las existentes
    DAO::crearLista("Favoritos", $_SESSION["id"]);
    redireccionar("AnnadirPeliculaLista.php?id=$peliculaId");
}

for ($i = 0; $i < count($listas); $i++) { ?>
    <li>
        <a href='ListaFicha.php?id=<?= $listas[$i]->getId() ?>&&nombre=<?= $listas[$i]->getNombre() ?>&&peliculaId=<?= $peliculaId ?>&&anadido'> <?= $listas[$i]->getNombre() ?> </a>
    </li>
    <?php
}
?>

<br><br>
<div class="crearLista">
    <form method='post' action='CrearLista.php?peliculaId=<?=$peliculaId?>'>
        <label for="nombreListaAnnadir"><strong>Nueva Lista</strong></label>
            <input type='text' name='nombreListaAnnadir' placeholder="Nombre de Lista"/>

        <button type='submit' name='crearLista' value='crearLista'>Crear Nueva Lista</button>
    </form>
</div>


</body>
</html>

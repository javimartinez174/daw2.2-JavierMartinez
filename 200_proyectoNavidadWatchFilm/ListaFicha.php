<?php
//Permite modificar nombre de lista, borrar lista, agregar peliculas a la lista y eliminar peliculas de la lista.

require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

$listaId = (int)$_REQUEST["id"];
$nombreLista = $_REQUEST["nombre"];

if (isset($_REQUEST["peliculaId"])) {
    $peliculaId = $_REQUEST["peliculaId"];
    DAO::aniadirPeliculaLista($_REQUEST["peliculaId"], $_REQUEST["id"]);
}

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

<body class='<?= $tema ?>'>

<header><a href="PaginaPrincipal.php"><img src="_img/logo.png" width="150" height="120"/> </a> </header>

<div class="mostrarPeliculasLista">
    <h2>Películas de la lista <?= $nombreLista ?></h2>


    <?php if (isset($_REQUEST["borrado"])) {
        echo '<div class="borrado">
                   <p style="color: limegreen;"><img src="_img/exito.png" height="30" width="30" alt=""> &nbsp; Borrado con éxito</p>
              </div>';
    } ?>

    <?php if (isset($_REQUEST["anadido"])) {
        echo '<div class="anadido">
                   <p style="color: limegreen"><img src="_img/exito.png" width="30" height="30" alt=""> &nbsp; Añadido con éxito</p>
              </div>';
    } ?>


    <?php
    $peliculasLista = DAO::peliculasObtenerDesdeLista($listaId);

    if ($peliculasLista == null) {
        echo "No hay películas en esta lista";
    } else {
        for ($i = 0; $i < count($peliculasLista); $i++) { ?>

        <div class="listaPelicula">
            <b><?= $peliculasLista[$i]->getNombre() ?></b><br><img src="_img/<?= $peliculasLista[$i]->getId() ?>.jpg"  height="150" width="120"/>  <a
                        href='BorrarPeliculaLista.php?id=<?= $peliculasLista[$i]->getId() ?>&&listaId=<?= $listaId ?>&&nombreLista=<?= $nombreLista ?>'><img
                            src="_img/borrar.png" height="30" width="30" alt=""></a><br><br>
        </div>

            <?php
        }
    }
    ?>

</div>

<br><br>

<div class="modificarLista">
    <form method='post' action='ModificarLista.php?listaId=<?= $listaId ?>'>
        <label for='nuevoNombre'></label><input type='text' name='nuevoNombre' id='nuevoNombre'
                                                placeholder="Nuevo Nombre Lista"
        />
        <button type='submit' name='modificar' value='modificar'>Modificar</button>
    </form>
</div>

</body>

</html>
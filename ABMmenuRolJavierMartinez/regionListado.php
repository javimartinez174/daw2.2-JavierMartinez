<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

//variables de control de guardado
if(isset($_REQUEST["correcto"])) {
    $correcto = $_REQUEST["correcto"];
    $datosNoModificados = $_REQUEST["datosNoModificados"];
    $nuevaEntrada = $_REQUEST["nuevaEntrada"];
}
else {
    $correcto = false;
    $datosNoModificados = false;
    $nuevaEntrada = false;
}

//variables de control de eliminado
if(isset($_REQUEST["correctoNormal"])) {
    $correctoNormal = $_REQUEST["correctoNormal"];
    $noExistia = $_REQUEST["noExistia"];
}
else {
    $correctoNormal = false;
    $noExistia = false;
}


// Los campos que incluyo en el SELECT son los que luego podré leer
// con $fila["campo"].
$sql = "SELECT id, nombre FROM region ORDER BY nombre";

$select = $conexionBD->prepare($sql);
$select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
$rs = $select->fetchAll();

// INTERFAZ:
// $rs
?>



<html>

<head>
    <meta charset='UTF-8'>

    <style>

        a:link{
            text-decoration: none;
            color: red;
        }
        a:visited{
            color:darkred;
        }
        a:hover{
            text-decoration: underline;
        }
        table{
            border: 5px double grey;
            background-color: palegoldenrod;
        }
        th{
            background-color: lightcoral;
        }
        td{
            border: 2px solid black;
        }


    </style>

</head>



<body>

<h1>Listado de Regiones</h1>

<table border='5'>

    <tr>
        <th>Nombre</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href=   'regionFicha.php?id=<?=$fila["id"]?>'> <?=$fila["nombre"] ?> </a></td>
            <td><a href='regionEliminar.php?id=<?=$fila["id"]?>'> (X)                   </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='regionFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='personajeListado.php'>Gestionar listado de Personajes</a>


<?php
//datos de guardado
if(isset($_REQUEST["correcto"])){
    // Todos bien tanto si se han guardado los datos nuevos como si no se habían modificado.
    if ($correcto || $datosNoModificados) { ?>
        <?php if ($nuevaEntrada) { ?>
            <h1>Inserción completada</h1>
            <p>Se ha insertado correctamente la nueva entrada.</p>
        <?php } else { ?>
            <h1>Guardado completado</h1>
            <p>Se han guardado correctamente los datos.</p>

            <?php if ($datosNoModificados) { ?>
                <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
            <?php } ?>
        <?php }
        ?>

        <?php
    } else {
        ?>

        <?php if ($nuevaEntrada) { ?>
            <h1>Error en la creación.</h1>
            <p>No se ha podido crear la nueva región.</p>
        <?php } else { ?>
            <h1>Error en la modificación.</h1>
            <p>No se han podido guardar los datos de la region.</p>
        <?php } ?>

        <?php
    }
}
?>


<?php
//datos de eliminado
if(isset($_REQUEST["correctoNormal"])){
    if ($correctoNormal) { ?>

        <h1>Eliminación completada</h1>
        <p>Se ha eliminado correctamente la región.</p>

    <?php } else if ($noExistia) { ?>

        <h1>Eliminación no realizada</h1>
        <p>No existe la región que se pretende eliminar (quizá la eliminaron en paraleo o, ¿ha manipulado Vd. el parámetro id?).</p>

    <?php } else { ?>

        <h1>Error en la eliminación</h1>
        <p>No se ha podido eliminar la región.</p>

    <?php }
}
?>



</body>
</html>

<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

if (!isset($_SESSION["tema"]) & !isset($_REQUEST["tema"]))
    $_SESSION["tema"] = "";
else if (isset($_REQUEST["tema"]))
    $_SESSION["tema"] = $_REQUEST["tema"];

// Los campos que incluyo en el SELECT son los que luego podré leer
// con $fila["campo"].
$sql = "SELECT id, nombre FROM categoria ORDER BY nombre";

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

    body{
        background-color: <?= $_SESSION["tema"]; ?>;
    }

    </style>

</head>



<body>

<h1>Listado de Categorías</h1>

<div>
    <p>Temas: </p>
    <a href='categoriaListado.php?tema=white'>Claro</a>
    <a href='categoriaListado.php?tema=grey'>Oscuro</a>
    <a href='categoriaListado.php?tema=lightcyan'>Pastel</a>
    <a href='categoriaListado.php?tema=red'>Sangre</a>
</div>
<br>
<br>

<table border='1'>

    <tr>
        <th>Nombre</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href=   'categoriaFicha.php?id=<?=$fila["id"]?>'> <?=$fila["nombre"] ?> </a></td>
            <td><a href='categoriaEliminar.php?id=<?=$fila["id"]?>'> (X)                   </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='categoriaFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='personaListado.php'>Gestionar listado de Personas</a>

</body>
</html>

<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

//seleccionamos todas las personas que estén dentro de la categoría con ese id
$sql = "SELECT nombre, apellidos, telefono FROM persona WHERE categoriaId=?";

$select = $conexion->prepare($sql);
$select->execute([$id]); // Se añade el parámetro a la consulta preparada.
$rsp = $select->fetchAll();


// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una categoría existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $categoriaNombre = "<introduzca nombre>";
} else { // Quieren VER la ficha de una categoría existente, cuyos datos se cargan.
    $sql = "SELECT nombre FROM categoria WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $categoriaNombre = $rs[0]["nombre"];
}



// INTERFAZ:
// $nuevaEntrada
// $categoriaNombre
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de categoría</h1>
<?php } else { ?>
    <h1>Ficha de categoría</h1>
<?php } ?>

<form method='post' action='categoriaGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type='text' name='nombre' value='<?=$categoriaNombre?>' />
        </li>
    </ul>




    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear categoría' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
        <br />
        <br />
        <a href='categoriaEliminar.php?id=<?=$id?>'>Eliminar categoría</a>
        <br />
        <br />

        <table border='1'>
        <caption>Personas de la categoría: <?=$categoriaNombre?></caption>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
            </tr>

            <?php foreach ($rsp as $fila) { ?>
                <tr>
                    <td>    <?=$fila["nombre"]?>    </td>
                    <td>    <?=$fila["apellidos"]?> </td>
                    <td>    <?=$fila["telefono"]?> </td>
                </tr>
            <?php } ?>

        </table>

    <?php } ?>

</form>

<br />

<a href='categoriaListado.php'>Volver al listado de categorías.</a>

</body>
</html>

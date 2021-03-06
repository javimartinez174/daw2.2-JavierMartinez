<?php

require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];
$c_id = (int)$_REQUEST["c_id"];
$c_nombre = $_REQUEST["c_nombre"];

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una persona existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);





if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $personaNombre = "<introduzca nombre>";
    $personaApellido = "<introduzca apellido>";
    $personaTelefono = "<introduzca telefono>";

    //cogemos todos los nombres de categoría para hacer un select html
    $sql = "SELECT nombre FROM categoria ORDER BY nombre";
    $select = $conexion->prepare($sql);
    $select->execute([]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

} else { // Quieren VER la ficha de una persona existente, cuyos datos se cargan.
    $sql = "SELECT nombre, apellidos, telefono FROM persona WHERE id=?";


    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $personaNombre = $rs[0]["nombre"];
    $personaApellido = $rs[0]["apellidos"];
    $personaTelefono = $rs[0]["telefono"];
}



// INTERFAZ:
// $nuevaEntrada
// $personaNombre
// $personaApellido
// $personaTelefono

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de persona</h1>
<?php } else { ?>
    <h1>Ficha de persona</h1>
<?php } ?>

<form method='post' action='personaGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />
    <input type='hidden' name='c_id' value='<?=$c_id?>' />

    <ul>
        <li>
            <strong>Nombre:   </strong>
            <input style='margin:10px' type='text' name='nombre'   value='<?=$personaNombre?>' />
        </li>
        <li>
            <strong>Apellido:   </strong>
            <input style='margin:10px' type='text' name='apellido'   value='<?=$personaApellido?>' />
        </li>
        <li>
            <strong>Teléfono: </strong>
            <input style='margin:10px' type='text' name='telefono' value='<?=$personaTelefono?>' />
        </li>
        <li>
            <strong>Categoría: </strong>
            <?php if (!$nuevaEntrada) { ?>
                <input style='margin:10px; width:200px;' type='text' name='c_nombre' value='<?=$c_nombre?>' />
            <?php } else { ?>
                <select style='margin:10px; width:200px;' name="c_nombre">
                    <?php foreach ($rs as $fila) {
                        $nombre = $fila["nombre"];
                        echo "<option value=\"$nombre\">$nombre</option>";
                    } ?>
                </select>
            <?php } ?>
        </li>
    </ul>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear persona' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
        <br />
        <br />
        <a href='personaEliminar.php?id=<?=$id?>'>Eliminar persona</a>
    <?php } ?>

</form>

<br />

<a href='personaListado.php'>Volver al listado de personas.</a>

</body>

</html>

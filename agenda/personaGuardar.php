<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

// Se recogen los datos del formulario de la request.
$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$telefono = (int)$_REQUEST["telefono"];
//$id_categoria = (int)$_REQUEST["id_categoria"];
$c_nombre = $_REQUEST["c_nombre"];

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una categoría existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);


$sql = "SELECT id FROM categoria WHERE nombre=?";

$select = $conexionBD->prepare($sql);
$select->execute([$c_nombre]); // Se añade el parámetro a la consulta preparada.
$rs = $select->fetchAll();

$id_categoria = $rs[0]["id"];

if ($nuevaEntrada) {
    // Quieren CREAR una nueva entrada, así que es un INSERT.
    $sql = "INSERT INTO persona (nombre, telefono, categoria_id) VALUES (?,?,?)";
    $parametros = [$nombre, $telefono, $id_categoria];
} else {
    // Quieren MODIFICAR una categoría existente y es un UPDATE.
    $sql = "UPDATE persona SET nombre=?, telefono=?, categoria_id=? WHERE id=?";
    $parametros = [$nombre, $telefono, $id_categoria, $id];
}

$sentencia = $conexionBD->prepare($sql);
//Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
$sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.

// Está todos correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

// Si los datos no se habían modificado, también está correcto pero es "raro".
$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);



// INTERFAZ:
// $nuevaEntrada
// $correcto
// $datosNoModificados
?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<?php
// Todos bien tanto si se han guardado los datos nuevos como si no se habían modificado.
if ($correcto || $datosNoModificados) { ?>
    <?php if ($nuevaEntrada) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?=$nombre?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?=$nombre?>.</p>

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
        <p>No se ha podido crear la nueva persona.</p>
    <?php } else { ?>
        <h1>Error en la modificación.</h1>
        <p>No se han podido guardar los datos de la persona.</p>
    <?php } ?>

    <?php
}
?>

<a href='personaListado.php'>Volver al listado de personas.</a>

</body>
</html>

<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

// Se recogen los datos del formulario de la request.
$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$apodo = $_REQUEST["apodo"];
$raza = $_REQUEST["raza"];
$clase = $_REQUEST["clase"];
//$c_id = (int)$_REQUEST["c_id"];
$rNombre = $_REQUEST["rNombre"];
$estrella = isset($_REQUEST["estrella"]);

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una categoría existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);

//obtenemos el id de la region con el nombre guardado en el formulario al crear el personaje
$sql = "SELECT id FROM region WHERE nombre=?";

$select = $conexionBD->prepare($sql);
$select->execute([$rNombre]); // Se añade el parámetro a la consulta preparada.
$rs = $select->fetchAll();

$rId = $rs[0]["id"];

if ($nuevaEntrada) {
    // Quieren CREAR una nueva entrada, así que es un INSERT.
    $sql = "INSERT INTO personaje (nombre, apodo, raza, clase, estrella, regionId) VALUES (?,?,?,?,?,?)";
    $parametros = [$nombre, $apodo, $raza, $clase, $estrella?1:0, $rId];
} else {
    // Quieren MODIFICAR una categoría existente y es un UPDATE.
    $sql = "UPDATE personaje SET nombre=?, apodo=?, raza=?, clase=?, estrella=?, regionId=? WHERE id=?";
    $parametros = [$nombre, $apodo, $raza, $clase, $estrella?1:0,  $rId, $id];
}

$sentencia = $conexionBD->prepare($sql);
//Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
$sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.

// Está todos correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

// Si los datos no se habían modificado, también está correcto pero es "raro".
$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);

header("Location: personajeListado.php?correcto=$correcto&datosNoModificados=$datosNoModificados&nuevaEntrada=$nuevaEntrada");

// INTERFAZ:
// $nuevaEntrada
// $correcto
// $datosNoModificados
?>

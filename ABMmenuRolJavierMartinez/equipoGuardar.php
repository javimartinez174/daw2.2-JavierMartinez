<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

// Se recogen los datos del formulario de la request.
$id = (int)$_REQUEST["id"];
$arma = $_REQUEST["arma"];
$magia = $_REQUEST["magia"];
$armadura = $_REQUEST["armadura"];
$pNombre = $_REQUEST["pNombre"];
$estrella = isset($_REQUEST["estrella"]);

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una categoría existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);

$sql = "SELECT id FROM personaje WHERE nombre=?";

$select = $conexionBD->prepare($sql);
$select->execute([$pNombre]); // Se añade el parámetro a la consulta preparada.
$rs = $select->fetchAll();

$pId = $rs[0]["id"];

if ($nuevaEntrada) {
    // Quieren CREAR una nueva entrada, así que es un INSERT.
    $sql = "INSERT INTO equipo (arma, magia, armadura, estrella, personajeId) VALUES (?,?,?,?,?)";
    $parametros = [$arma, $magia, $armadura, $estrella?1:0, $pId];
} else {
    // Quieren MODIFICAR una categoría existente y es un UPDATE.
    $sql = "UPDATE equipo SET arma=?, magia=?, armadura=?, estrella=?, personajeId=? WHERE id=?";
    $parametros = [$arma, $magia, $armadura, $estrella?1:0, $pId, $id];
}

$sentencia = $conexionBD->prepare($sql);
//Esta llamada devuelve true o false según si la ejecución de la sentencia ha ido bien o mal.
$sqlConExito = $sentencia->execute($parametros); // Se añaden los parámetros a la consulta preparada.

// Está todos correcto de forma normal si NO ha habido errores y se ha visto afectada UNA fila.
$correcto = ($sqlConExito && $sentencia->rowCount() == 1);

// Si los datos no se habían modificado, también está correcto pero es "raro".
$datosNoModificados = ($sqlConExito && $sentencia->rowCount() == 0);


header("Location: equipoListado.php?correcto=$correcto&datosNoModificados=$datosNoModificados&nuevaEntrada=$nuevaEntrada");
// INTERFAZ:
// $nuevaEntrada
// $correcto
// $datosNoModificados
?>

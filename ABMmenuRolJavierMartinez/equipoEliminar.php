<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM equipo WHERE id=?";
$sentencia = $conexionBD->prepare($sql);
$sqlConExito = $sentencia->execute([$id]);

$correctoNormal = ($sqlConExito && $sentencia->rowCount() == 1);

$noExistia = ($sqlConExito && $sentencia->rowCount() == 0);

header("Location: equipoListado.php?correctoNormal=$correctoNormal&noExistia=$noExistia");

// INTERFAZ:
// $correctoNormal
// $noExistia
?>

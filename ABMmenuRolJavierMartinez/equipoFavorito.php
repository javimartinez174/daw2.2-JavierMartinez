<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "UPDATE equipo SET estrella = (NOT (SELECT estrella FROM equipo WHERE id=?)) WHERE id=?";

$select = $conexionBD->prepare($sql);
$exito = $select->execute([$id,$id]);

header("Location: equipoListado.php");
?>
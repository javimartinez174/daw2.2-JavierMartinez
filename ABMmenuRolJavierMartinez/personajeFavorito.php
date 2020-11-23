<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "UPDATE personaje SET estrella = (NOT (SELECT estrella FROM personaje WHERE id=?)) WHERE id=?";

$select = $conexionBD->prepare($sql);
$exito = $select->execute([$id,$id]);

header("Location: personajeListado.php");
?>
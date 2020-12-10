<?php
require_once "_Varios.php";

$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$identificador = $_REQUEST["identificador"];
$contrasenna = $_REQUEST["contrasenna"];

$arrayNuevoUsuario = [$identificador,$contrasenna,$nombre,$apellidos];

crearUsuario($arrayNuevoUsuario);

redireccionar("SesionInicioMostrarFormulario.php");
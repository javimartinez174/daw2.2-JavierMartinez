<?php
require_once "_Varios.php";

$identificador = $_REQUEST["identificador"];
$contrasenna   = $_REQUEST["contrasenna"];
$rs = obtenerUsuario($identificador,$contrasenna);
$nombre = $rs[0]["nombre"];
$id = (int)$rs[0]["id"];

if($nombre!=null) {
    marcarSesionComoIniciada($id);
    redireccionar("ContenidoPrivado1.php?nombre=$nombre&id=$id");
} else
    redireccionar("SesionInicioMostrarFormulario.php");

// TODO ...$_REQUEST["..."]...

// TODO Verificar (usar funciones de _Varios.php) identificador y contrasenna recibidos y redirigir a ContenidoPrivado1 (si OK) o a iniciar sesión (si NO ok).

$arrayUsuario = obtenerUsuario($identificador, $contrasenna);

if ($arrayUsuario) { // HAN venido datos: identificador existía y contraseña era correcta.
    // TODO Llamar a marcarSesionComoIniciada($arrayUsuario) ...

    // TODO Redirigir.
} else {
    // TODO Redirigir.
}

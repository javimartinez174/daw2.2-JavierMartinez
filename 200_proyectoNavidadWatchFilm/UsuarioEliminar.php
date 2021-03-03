<?php


require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

$identificador = $_SESSION["identificador"];
DAO::usuarioEliminar($identificador);
redireccionar("SesionInicioFormulario.php");
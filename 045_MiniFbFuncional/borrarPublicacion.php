<?php
require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

DAO::borrarPublicacion($_REQUEST["id"]);
redireccionar("PaginaPrincipal.php");
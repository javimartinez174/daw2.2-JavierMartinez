<?php

require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

DAO::borrarLista($_REQUEST["listaId"], $_SESSION["id"]);

redireccionar("PaginaPrincipal.php?borrado");


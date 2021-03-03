<?php

require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

if ($_REQUEST["nombreLista"]) {
    DAO::crearLista($_REQUEST["nombreLista"], $_SESSION["id"]);
    redireccionar("PaginaPrincipal.php");
}

if ($_REQUEST["nombreListaAnnadir"]) {
    $peliculaId= $_REQUEST["peliculaId"];
    DAO::crearLista($_REQUEST["nombreListaAnnadir"], $_SESSION["id"]);
    redireccionar("AnnadirPeliculaLista.php?id=$peliculaId");
}



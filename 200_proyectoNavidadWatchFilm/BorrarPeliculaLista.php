<?php
require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

$peliculaId = $_REQUEST["id"];
$listaId = $_REQUEST["listaId"];
$nombreLista = $_REQUEST["nombreLista"];

DAO::borrarPeliculaLista($peliculaId, $listaId);

redireccionar("ListaFicha.php?id=$listaId&&nombre=$nombreLista&&borrado");


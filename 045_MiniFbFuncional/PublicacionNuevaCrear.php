<?php
require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

$asunto = $_REQUEST["asunto"];
$contenido = $_REQUEST["contenido"];
$fecha = "2018-03-29 15:20:40"; //pendiente de arreglo

if(isset($_REQUEST["id"])) {
    DAO::crearPublicacionDestinatario($fecha, $_SESSION["id"], $_REQUEST["id"], $asunto, $contenido);
    redireccionar('MuroVerDe.php?id='.$_REQUEST["id"].'&&identificador='.$_REQUEST["muro"]);
}
else{
    DAO::crearPublicacionGlobal($fecha, $_SESSION["id"],$asunto,$contenido);
    redireccionar("MuroVerGlobal.php");
}

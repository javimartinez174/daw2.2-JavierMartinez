<?php
require_once "_com/DAO.php";

// Se recogen los datos del formulario de la request.
$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$telefono = $_REQUEST["telefono"];
$categoriaId = (int)$_REQUEST["categoriaId"];
$estrella = isset($_REQUEST["estrella"]);

if ($id == -1)
{
    DAO::personaCrear($nombre,$apellidos,$telefono,$estrella,$categoriaId);

}else
    DAO::personaActualizar($id,$nombre,$apellidos,$telefono,$estrella,$categoriaId);

redireccionar("personaListado.php");
<?php
require_once "_com/DAO.php";

// Se recogen los datos del formulario de la request.
$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];

if ($id == -1)
{
    DAO::categoriaCrear($nombre);

}else
    DAO::categoriaActualizar($id, $nombre);

redireccionar("categoriaListado.php");


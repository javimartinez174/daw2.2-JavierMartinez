<?php
require_once "_com/DAO.php";

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

DAO::categoriaELiminar($id);
redireccionar("categoriaListado.php");



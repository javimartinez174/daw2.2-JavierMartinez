<?php
require_once "_com/DAO.php";
$categoriaId = $_REQUEST["id"];

DAO::categoriaActualizar($categoriaId, $_REQUEST["nombre"]);
DAO::categoriaObtenerPorId($categoriaId)->setNombre(DAO::categoriaObtenerPorId($categoriaId)->getNombre());

echo json_encode(DAO::categoriaObtenerPorId($categoriaId));
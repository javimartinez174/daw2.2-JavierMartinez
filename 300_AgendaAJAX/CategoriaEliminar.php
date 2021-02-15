<?php
require_once "_com/DAO.php";

DAO::categoriaEliminar($_REQUEST["id"]);

echo json_encode(DAO::categoriaObtenerTodas());
<?php
require_once "_com/DAO.php";

DAO::categoriaCrear($_REQUEST["nombre"]);

echo json_encode(DAO::categoriaObtenerTodas());
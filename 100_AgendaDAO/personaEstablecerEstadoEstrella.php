<?php

require_once "_com/DAO.php";

$id= (int)$_REQUEST["id"];
DAO::personaCambiarEstrella($id);

redireccionar("personaListado.php");

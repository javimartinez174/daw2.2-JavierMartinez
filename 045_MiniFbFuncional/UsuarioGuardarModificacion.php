<?php

require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");
$contrasennaNueva = $_REQUEST["contrasennaNueva"];

if (isset($_REQUEST["contrasennaNueva"])) {
    if ($contrasennaNueva==""){
        redireccionar("UsuarioFicha.php?contrasennaVacia");
    } else {
        DAO::usuarioModificarContrasenna($contrasennaNueva);
    }
} else {

    $nombre = $_REQUEST["nombre"];
    $apellidos = $_REQUEST["apellidos"];
    $email = $_REQUEST["email"];

    DAO::usuarioModificar();
}
redireccionar("PaginaPrincipal.php?cambioExito");


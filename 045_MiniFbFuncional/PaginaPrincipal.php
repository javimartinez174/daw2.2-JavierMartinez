<?php

require_once "_com/DAO.php";

$rs = DAO::obtenerusuario();

$identificador = $rs[0]->getIdentificador();
$contrasenna = $rs[0]->getContrasenna();

$usuario = DAO::usuarioObtener($identificador, $contrasenna);

if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

if (!DAO::haySesionRamIniciada() && DAO::intentarCanjearSesionCookie()) DAO::marcarSesionComoIniciada(DAO::obtenerUsuarioPorCookie($_COOKIE["codigoCookie"]));


$tema = comprobarTema();

?>


<html lang=''>

<head>
    <meta charset='UTF-8'>
    <title></title>
    <?php if ($tema) { ?>
        <link rel="stylesheet" href="_styles/styleBlack.css">
    <?php } else { ?>
        <link rel="stylesheet" href="_styles/style.css">
    <?php } ?>
</head>

<body>
<header><a href="PaginaPrincipal.php">MiniFaceBook</a></header>

<?php if (isset($_REQUEST["borrado"])) {
    echo '<div class="borrado">
                   <p style="color: limegreen"><img src="_img/exito.png" height="30" width="30" alt=""> &nbsp; Borrado con éxito</p>
              </div>';
} ?>

<?php if (isset($_REQUEST["cambioExito"])) {
    echo '<div class="cambioExito">
                   <p style="color: limegreen"><img src="_img/exito.png" height="30" width="30" alt="">Cambio realizado con éxito</p>
              </div>';
} ?>

<?php pintarInfoSesion(); ?>


<br><br>

<div>
    <p>¡Bienvenido al MiniFb!</p>
    <p>Esto es una red social en la que bla, bla, bla, bla.</p>
    <p>Crea tu cuenta y participa.</p>

    <a href='MuroVerGlobal.php'>Mira el muro global si ya tienes una cuenta.</a>
</div>

</body>

</html>
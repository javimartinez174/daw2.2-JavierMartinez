<?php

require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

$rs = DAO::VerFichaUsuario();

$identificador = $rs[0]["identificador"];
$contrasenna = $rs[0]["contrasenna"];
$contrasennaActual = $_REQUEST["contrasennaActual"];

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

<body class='<?= $tema ?>'>



<?php
if ($contrasenna == $contrasennaActual) { ?>
    <h2 style="color:limegreen">Contraseña actual correcta</h2>

    <form action="UsuarioGuardarModificacion.php" method="post">
        <label for="contrasennaNueva">Introduce tu nueva contraseña:</label>
        <input type="password" name="contrasennaNueva">
        <input type="submit" name="guardar" value="Guardar cambios"/><br><br>
    </form>
<?php } else { ?>
    <h1 style="color:red">Contraseña incorrecta,vuelve hacia atras y escribela de nuevo</h1>
    <a href="UsuarioFicha.php">Volver a intentar</a>
<?php } ?>
</body>
</html>

<?php

require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

$rs = DAO::VerFichaUsuario();

$identificador = $rs[0]["identificador"];
$nombre = $rs[0]["nombre"];
$apellidos = $rs[0]["apellidos"];
$email = $rs[0]["email"];
$contrasenna = $rs[0]["contrasenna"];

$contrasenna2 = null;

$tema = comprobarTema();

$usuario = DAO::usuarioObtener($_SESSION["identificador"], $contrasenna);

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

<header><a href="PaginaPrincipal.php"><img src="_img/logo.png" width="150" height="120"/> </a> </header>

<body class='<?= $tema ?>'>

<?php cambiarTemaLinks();

if (isset($_REQUEST["contrasennaVacia"])){
    echo "<h2 style='color:red'>La contraseña no puede estar vacía</h2>";
}

?>
<br><br>
<h1>Datos Personales</h1>
<img src="_fotoDePerfil/<?= $usuario->getFotoPerfil()?>" style="width: 100px; height: 100px; border:1px solid black; border-radius:25px " alt="">&nbsp;
<a href="CambiarFoto.php">Cambiar foto de perfil</a>

<form action="UsuarioGuardarModificacion.php" method="post">

    <ul>
        <li>
            <p>Nombre:</p>
            <label>
                <input type="text" name="nombre" value="<?= $nombre ?>">
            </label>
        </li>
        <li>
            <p>Apellidos:</p>
            <label>
                <input type="text" name="apellidos" value="<?= $apellidos ?>">
            </label>
        </li>
        <li>
            <p>Email:</p>
            <label>
                <input type="text" name="email" value="<?= $email ?>">
            </label>
        </li>
    </ul>

    <input type="submit" name="guardar" value="Guardar cambios"/><br><br>

    <a href="./UsuarioEliminar.php?identificador=<?= $identificador ?>">Borrar este usuario</a>

</form>

<form action="CambioContrasenna.php" method="post">
    <label for="contrasennaActual">¿Quieres cambiar tu contraseña?</label>
    <input type="password" name="contrasennaActual" placeholder="Contraseña actual">
    <input type="submit" name="guardar" value="Guardar cambios"/><br><br>
</form>

</body>
</html>
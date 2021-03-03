<?php

require_once "_com/DAO.php";

if (DAO::haySesionRamIniciada() || DAO::intentarCanjearSesionCookie()) redireccionar("PaginaPrincipal.php");

$datosErroneos = isset($_REQUEST["datosErroneos"]);
$nuevoUsuario = isset($_REQUEST["nuevo"]);
$sesionCerrada = isset($_REQUEST["cerrarSesion"]);

?>


<html lang=''>

<head>
    <meta charset='UTF-8'>
    <title></title>
    <link rel="stylesheet" href="_styles/formularioInicio.css">
</head>

<body>

<?php if ($sesionCerrada) { ?>
    <p class='error'>Has cerrado sesión</p>
<?php } ?>

<div class="titulo">
    <img src="_img/logo.png" width="150" height="120"/>
</div>

<?php if ($datosErroneos) { ?>
    <p class='error'>Los datos introducidos no son correctos.</p>
<?php } ?>

<?php if ($nuevoUsuario) { ?>
    <p>Te has registrado correctamente.<br>Por favor, inicia sesión.</p>
<?php } ?>

<div class="formulario">
    <form method='post' action='SesionInicioComprobar.php'>
        <h2>Iniciar Sesión</h2>
        <table>
            <tr>
                <td>
                    <input type='text' name='identificador' id='identificador' placeholder="Usuario"
                               required/>
                    <br><br>
                    <input type='password' name='contrasenna' id='identificador' placeholder="Contraseña"
                               required/>
                    <br><br>
                    <strong>Recuérdame: </strong>
                    <label>
                        <input style="width: 20px;" type='checkbox' name='recordar' id='recordar'>
                    </label>
                </td>
            </tr>
        </table>
        <br/>

        <button type='submit' name='iniciar' value='Iniciar Sesión'>Iniciar Sesion</button>
        <hr>
        <p>No tienes cuenta: <a href='UsuarioNuevoFormulario.php'>Regístrate.</a></p>
    </form>
</div>

</body>
</html>
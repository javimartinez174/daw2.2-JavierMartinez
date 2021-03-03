<?php

require_once "_com/DAO.php";

$contrasennaIncorrecta = isset($_REQUEST["contrasennaIncorrecta"]);
$usuarioNoValido = isset($_REQUEST["usuarioNoValido"]);
$fallo = isset($_REQUEST["fallo"]);


?>


<html lang=''>

<head>
    <meta charset='UTF-8'>
    <title></title>
    <link rel="stylesheet" href="_styles/formularioInicio.css">
</head>

<body>

<div class="titulo">
    <img src="_img/logo.png" width="150" height="120"/>
</div>

<?php if ($contrasennaIncorrecta) { ?>
    <p class='error'>La contraseña no coincide. <br>Intentelo de nuevo.</p>
<?php } ?>

<?php if ($usuarioNoValido) { ?>
    <p class='error'>Ese identificador no está disponible. <br>Intentelo de nuevo.</p>
<?php } ?>

<?php if ($usuarioNoValido) { ?>
    <p class='error'>Ha ocurrido un error.<br>Usuario no creado.</p>
<?php } ?>

<div class="formulario">
    <form method='post' action='UsuarioNuevoCrear.php'>
        <h2>Regístrate</h2>
        <table>
            <tr>
                <td>
                    <input type='text' name='nombre' id='nombre'
                               placeholder="Nombre completo"
                               required/>
                    <br><br>
                    <input type='text' name='apellidos' id='apellidos'
                               placeholder="Apellidos completos"
                               required/>
                    <br><br>
                    <input type='text' name='identificador' id='identificador'
                               placeholder="Nombre de usuario"
                               required/>
                    <br><br>
                    <input type='text' name='email' id='email'
                               placeholder="Email"
                               required/>
                    <br><br>
                    <input type='password' name='contrasenna' id='identificador'
                               placeholder="Contraseña"
                               required/>
                    <br><br>
                    <input type='password' name='contrasenna2' id='identificador'
                               placeholder="Introduce de nuevo contraseña"
                               required/>
                </td>
            </tr>
        </table>
        <br/>

        <button type='submit' name='registrarme' value='registrarme'>Registrarme</button>
        <hr>
        <p>Ya tengo cuenta: <a href='SesionInicioFormulario.php'>Iniciar Sesión.</a></p>
    </form>
</div>

</body>
</html>
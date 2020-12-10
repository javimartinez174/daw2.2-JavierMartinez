<?php

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>

<h1>Iniciar Sesión</h1>

<form action="SesionInicioComprobar.php" method="post">
    <label for="identificador">Nombre de Usuario: </label>
    <input type="text" id="identificador"  name="identificador"><br><br>

    <label for="contrasenna">Contraseña: </label>
    <input type="password" id="contrasenna" name= "contrasenna"><br><br>

    <input type="submit" value="Entrar" name="entrar">
</form>

<a href="CrearCuentaFormulario.php">Crear Cuenta</a>

</body>

</html>
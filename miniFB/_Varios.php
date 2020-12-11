<?php

declare(strict_types=1);


function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "MiniFb";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
        exit('Error al conectar'); //something a user can understand
    }

    return $conexion;
}

session_start();

function obtenerUsuario(string $identificador, string $contrasenna): ?array
{

    $sql = "SELECT * FROM Usuario WHERE identificador=? AND contrasenna=?";

    $select = obtenerPdoConexionBD()->prepare($sql);
    $select->execute([$identificador,$contrasenna]);
    $rs = $select->fetchAll();

    return $select->rowCount()==1 ? $rs[0] : null;
}

function crearUsuario(array $arrayNuevoUsuario)
{

    $sql = "INSERT INTO Usuario (identificador, contrasenna, tipoUsuario, nombre, apellidos) VALUES (?,?,?,?,?)";

    $select = obtenerPdoConexionBD()->prepare($sql);
    $select->execute([$arrayNuevoUsuario[0],$arrayNuevoUsuario[1],0,$arrayNuevoUsuario[2],$arrayNuevoUsuario[3]]);
}


function marcarSesionComoIniciada(array $arrayUsuario)
{

    //$_SESSION[$arrayUsuario["id"]]=true;
    $_SESSION["id"]=$arrayUsuario["id"];
    $_SESSION["identificador"]=$arrayUsuario["identificador"];
    $_SESSION["contrasenna"]=$arrayUsuario["contrasenna"];
    $_SESSION["codigoCookie"]=$arrayUsuario["codigoCookie"];
    $_SESSION["tipoUsuario"]=$arrayUsuario["tipoUsuario"];
    $_SESSION["nombre"]=$arrayUsuario["nombre"];
    $_SESSION["apellidos"]=$arrayUsuario["apellidos"];



    // TODO Anotar en el post-it todos estos datos:
    // $_SESSION["id"] = ...
    // $_SESSION["identificador"] = ...
    // ...
}

function haySesionIniciada(): bool
{
    /*isset($_SESSION["id"])){
        return true;
    }else
        return false;*/

    return isset($_SESSION["id"]);



    // TODO Pendiente hacer la comprobación.

    // Está iniciada si isset($_SESSION["id"])

    //return false;
}


function intentarCanjearSesionCookie(): bool
{
    /*$codigoCookie = $_COOKIE["identificador"];

    $sql = "SELECT * FROM Usuario WHERE identificador=? AND BINARY codigoCookie=?";

    $select = obtenerPdoConexionBD()->prepare($sql);
    $select->execute([$_COOKIE[],$_COOKIE[]]);
    $rs = $select->fetchAll();*/


    // TODO Comprobar si hay una "sesión-cookie" válida:
    //   - Ver que vengan DOS cookies "identificador" y "codigoCookie".
    //   - BD: SELECT ... WHERE identificador=? AND BINARY codigoCookie=?
    //   - ¿Ha venido un registro? (Igual que el inicio de sesión)
    //     · Entonces, se la canjeamos por una SESIÓN RAM INICIADA: marcarSesionComoIniciada($arrayUsuario)
    //     · Además, RENOVAMOS (re-creamos) la cookie.
    //   - IMPORTANTE: si las cookies NO eran válidas, tenemos que borrárselas.
    //   - En cualquier caso, devolver true/false.
}

/*function pintarInfoSesion() {
    if (haySesionRamIniciada()) {
        echo "<span>Sesión iniciada por <a href='UsuarioPerfilVer.php'>$_SESSION[identificador]</a> ($_SESSION[nombre] $_SESSION[apellidos]) <a href='SesionCerrar.php'>Cerrar sesión</a></span>";
    } else {
        echo "<a href='SesionInicioFormulario.php'>Iniciar sesión</a>";
    }
}*/

function generarCookieRecordar(array $arrayUsuario)
{
    // Creamos un código cookie muy complejo (no necesariamente único).
    $codigoCookie = generarCadenaAleatoria(32); // Random...

    $sql = "UPDATE Usuario SET codigoCookie=? WHERE identificador=? AND contrasenna=?";
    $select = obtenerPdoConexionBD()->prepare($sql);
    $select->execute([$codigoCookie,$arrayUsuario["identificador"],$arrayUsuario["contrasenna"]]);

    setcookie($arrayUsuario["identificador"],$codigoCookie);

    // TODO guardar código en BD

    // TODO Para una seguridad óptima convendría anotar en la BD la fecha de caducidad de la cookie y no aceptar ninguna cookie pasada dicha fecha.

    // TODO Enviamos al cliente, en forma de cookies, el identificador y el codigoCookie: setcookie(...) ...

}

function borrarCookieRecordar(array $arrayUsuario)
{

    setcookie($arrayUsuario["codigoCookie"],$arrayUsuario["identificador"],time()-10);

    // TODO Eliminar el código cookie de nuestra BD.

    // TODO Pedir borrar cookie (setcookie con tiempo time() - negativo...)
}

function generarCadenaAleatoria(int $longitud): string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
    return $s;
}


function cerrarSesion()
{
    session_destroy();
    unset($_SESSION);
}

// (Esta función no se utiliza en este proyecto pero se deja por si se optimizase el flujo de navegación.)
// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}

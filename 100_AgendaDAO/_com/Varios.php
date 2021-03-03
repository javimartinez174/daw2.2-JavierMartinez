<?php
declare(strict_types=1);


function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}


function recogerTema()
{
    session_start();
    if (isset($_REQUEST[$_SESSION["fondo"]])){
        $_SESSION["fondo"] = $_REQUEST["fondo"];
    }
}

function establecerTema()
{
    session_start();
    if (!isset($_SESSION["fondo"]) && !isset($_REQUEST["fondo"])) {
        $_SESSION["fondo"] = "";
    } else if (isset($_REQUEST["fondo"])) {
        $_SESSION["fondo"] = $_REQUEST["fondo"];
    }

}

// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar($url)
{
    header("Location: $url");
    exit();
}

function obtenerFecha(): string
{
    return date("Y-m-d H:i:s");
}

function generarCadenaAleatoria($longitud) : string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
    return $s;
}

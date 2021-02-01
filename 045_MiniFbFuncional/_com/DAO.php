<?php
require_once "Utilidades.php";
require_once "Clases.php";


class DAO
{
    private static ?PDO $pdo = null;

    public static function haySesionRamIniciada(): bool
    {
        return isset($_SESSION["id"]);
    }

    public static function intentarCanjearSesionCookie(): bool
    {
        if ((isset($_COOKIE["identificador"])) && (isset($_COOKIE["codigoCookie"]))) {

            $rs = self::ejecutarConsulta(
                "SELECT * FROM usuario WHERE identificador=? AND BINARY codigoCookie=?",
                [$_COOKIE["identificador"], $_COOKIE["codigoCookie"]]
            );

            $identificador = $rs[0]["identificador"];
            $codigoCookie = $rs[0]["codigoCookie"];

            if ($rs) {
                return true;
            } else {
                setcookie("identificador", $identificador, time() - 3600);
                setcookie("codigoCookie", $codigoCookie, time() - 3600);
                return false;
            }

        }
        return false;

    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        return $select->fetchAll();
    }

    /* SESION Y COOKIE */

    private static function obtenerPdoConexionBD(): PDO
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "minifb";
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }
        return $pdo;
    }



    public static function obtenerUsuarioPorCookie(string $codigoCookie): ?Usuario
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE codigoCookie=?",
            [$codigoCookie]
        );
        if ($rs) return self::usuarioCrearDesdeRS($rs[0]);
        else return null;
    }

    private static function usuarioCrearDesdeRS(array $usuario): Usuario
    {
        return new Usuario($usuario["id"], $usuario["identificador"], $usuario["nombre"], $usuario["apellidos"], $usuario["contrasenna"], $usuario["codigoCookie"]);
    }

    public static function marcarSesionComoIniciada($usuario)
    {
        $_SESSION["id"] = $usuario->getId();
        $_SESSION["identificador"] = $usuario->getIdentificador();
        $_SESSION["nombre"] = $usuario->getNombre();
        $_SESSION["apellidos"] = $usuario->getApellidos();
    }

    public static function generarCookieRecordar()
    {
        $arrayUsuario = DAO::usuarioObtener($_REQUEST["identificador"], $_REQUEST["contrasenna"]);
        $codigoCookie = generarCadenaAleatoria(32);

        self::ejecutarConsulta(
            "UPDATE usuario SET codigoCookie=? WHERE identificador=?",
            [$codigoCookie, $arrayUsuario->getIdentificador()]
        );


        $arrayCookies["identificador"] = setcookie("identificador", $arrayUsuario->getIdentificador(), time() + 60 * 60);
        $arrayCookies["codigoCookie"] = setcookie("codigoCookie", $codigoCookie, time() + 60 * 60);
    }

    public static function usuarioObtener(string $identificador, string $contrasenna): ?Usuario
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE identificador=? AND contrasenna =?",
            [$identificador, $contrasenna]
        );
        if ($rs) return self::usuarioCrearDesdeRS($rs[0]);
        else return null;
    }

    public static function borrarCookieRecordar()
    {
        $arrayUsuario = DAO::usuarioObtener($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

        self::ejecutarConsulta(
            "UPDATE usuario SET codigoCookie=NULL WHERE identificador=?",
            [$arrayUsuario->getIdentificador()]
        );
        $identificador = $arrayUsuario->getIdentificador();
        setcookie("identificador", $identificador, time() - 3600);

        unset($_COOKIE["codigoCookie"]);
        setcookie("codigoCookie", "", time() - 3600);
        unset($_COOKIE["identificador"]);

    }

    /* USUARIO */

    public static function comprobarIdentificadorDisponible(string $identificador): array
    {
        return self::ejecutarConsulta(
            "SELECT identificador FROM usuario WHERE identificador=?",
            [$identificador]
        );
    }

    public static function obtenerusuario(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario ",
            []
        );

        foreach ($rs as $fila) {
            $usuario = self::usuarioCrearDesdeRS($fila);
            array_push($datos, $usuario);
        }

        return $datos;
    }

    public static function obtenerUsuarioId(int $id): ? Usuario
    {
        $rs = self::ejecutarConsulta("SELECT * FROM usuario WHERE id=?", [$id]);

        if ($rs) return self::usuarioCrearDesdeRS($rs[0]);
        else return null;
    }


    public static function crearUsuario(array $arrayUsuarioNuevo): bool
    {
        return self::ejecutarActualizacion(
            "INSERT INTO usuario (identificador, nombre, apellidos, email, contrasenna, fotoPerfil, codigoCookie) VALUES (?, ?, ?, ?, ?, 'usuario.png', NULL)",
            [$arrayUsuarioNuevo["identificador"], $arrayUsuarioNuevo["nombre"], $arrayUsuarioNuevo["apellidos"], $arrayUsuarioNuevo["email"], $arrayUsuarioNuevo["contrasenna"]]
        );
    }

    private static function ejecutarActualizacion(string $sql, array $parametros): bool
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $actualizacion = self::$pdo->prepare($sql);
        return $actualizacion->execute($parametros);
    }

    public static function usuarioModificar()
    {
        $identificador = $_REQUEST["identificador"];
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];
        $email = $_REQUEST["email"];

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();
        self::ejecutarActualizacion("UPDATE usuario SET identificador=?,nombre=?,apellidos=?,email=? WHERE identificador=?", [$identificador, $nombre, $apellidos, $email, $identificador]);
    }

    public static function usuarioModificarContrasenna(string $contrasennaNueva)
    {
        $identificador = $_SESSION["identificador"];


        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();
        self::ejecutarActualizacion("UPDATE usuario SET contrasenna=? WHERE identificador=?", [$contrasennaNueva, $identificador]);
    }


    public static function VerFichaUsuario(): array
    {

        $identificador = $_SESSION["identificador"];

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        return self::ejecutarConsulta("SELECT * FROM usuario WHERE identificador=?", [$identificador]);
    }

    public static function usuarioEliminar(string $identificador)
    {

        if (!isset(Self::$pdo)) Self::$pdo = Self::obtenerPdoConexionBd();

        self::ejecutarActualizacion("DELETE FROM usuario WHERE identificador=?",
            [$identificador]);
    }

    /*PUBLICACION*/

    private static function publicacionCrearDesdeRS(array $publicacion): Publicacion
    {
        return new Publicacion($publicacion["id"], $publicacion["fecha"], $publicacion["emisorId"], $publicacion["asunto"], $publicacion["contenido"]);
    }

    public static function publicacionObtenerTodas(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM publicacion ORDER BY fecha",
            []
        );

        foreach ($rs as $fila) {
            $publicacion = self::publicacionCrearDesdeRs($fila);
            array_push($datos, $publicacion);
        }

        return $datos;
    }

    public static function obtenerPublicacionDestinatarioId(int $id): ? array
    {
        $datos = [];
        $rs = self::ejecutarConsulta("SELECT * FROM publicacion WHERE destinatarioId=? ORDER BY fecha", [$id]);

        foreach ($rs as $fila) {
            $publicacion = self::publicacionCrearDesdeRs($fila);
            array_push($datos, $publicacion);
        }

        return $datos;
    }

    public static function crearPublicacionGlobal(string $fecha, int $emisorId, string $asunto, string $contenido)
    {
        if ($asunto != "" && $contenido != "")
            self::ejecutarActualizacion("INSERT INTO publicacion (fecha, emisorId, asunto, contenido) VALUES (?, ?, ?, ?);",
                [$fecha, $emisorId, $asunto, $contenido]);
    }

    public static function crearPublicacionDestinatario(string $fecha, int $emisorId, int $destinatarioId, string $asunto, string $contenido)
    {
        if ($asunto != "" && $contenido != "")
            self::ejecutarActualizacion("INSERT INTO publicacion (fecha, emisorId, destinatarioId, asunto, contenido) VALUES (?, ?, ?, ?, ?);",
                [$fecha, $emisorId, $destinatarioId, $asunto, $contenido]);
    }


    public static function borrarPublicacion(int $id)
    {
        self::ejecutarActualizacion("DELETE FROM publicacion WHERE id=?;",
            [$id]);
    }

}
<?php

require_once "Clases.php";
require_once "Varios.php";

class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD()
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "agenda"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }

        return $pdo;
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        $rs = $select->fetchAll();

        return $rs;
    }

    private static function ejecutarActualizacion(string $sql, array $parametros): bool
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $actualizacion = self::$pdo->prepare($sql);
        $sqlConExito = $actualizacion->execute($parametros);

        return $sqlConExito;
    }



    /* CATEGORÍA */

    private static function categoriaCrearDesdeRs(array $fila): Categoria
    {
        return new Categoria($fila["id"], $fila["nombre"]);
    }

    public static function categoriaObtenerPorId(int $id): ?Categoria
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Categoria WHERE id=?",
            [$id]
        );
        if ($rs) return self::CategoriaCrearDesdeRs($rs[0]);
        else return null;
    }

    public static function categoriaActualizar($id, $nombre)
    {
        self::ejecutarActualizacion(
            "UPDATE Categoria SET nombre=? WHERE id=?",
            [$nombre, $id]
        );
    }

    public static function categoriaCrear(string $nombre)
    {
        self::ejecutarActualizacion(
            "INSERT INTO Categoria (nombre) VALUES (?)",
            [$nombre]
        );
    }

    public static function categoriaObtenerTodas(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Categoria ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $categoria = self::categoriaCrearDesdeRs($fila);
            array_push($datos, $categoria);
        }

        return $datos;
    }


    public static function categoriaELiminar($id)
    {
        self::ejecutarActualizacion(
            "DELETE FROM Categoria WHERE id=?",
            [$id]
        );
    }

    /* PERSONA */

    private static function personaCrearDesdeRs(array $fila): Persona
    {
        return new Persona($fila["id"], $fila["nombre"], $fila["apellidos"], $fila["telefono"], $fila["estrella"], $fila["categoriaId"]);
    }

    public static function personaObtenerPorId(int $id): ?Persona
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM Persona WHERE id=?",
            [$id]
        );

        if ($rs) return self::personaCrearDesdeRs($rs[0]);
        else return null;
    }

    public static function personaObtenerTodas(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM Persona ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $persona = self::personaCrearDesdeRs($fila);
            array_push($datos, $persona);
        }

        return $datos;
    }


    public static function personaCrear(string $nombre, string $apellidos, int $telefono, int $estrella, int $categoriaId)
    {
        self::ejecutarActualizacion(
            "INSERT INTO Persona (nombre,apellidos,telefono,estrella,categoriaId) VALUES (?,?,?,?,?)",
            [$nombre,$apellidos,$telefono,$estrella,$categoriaId]
        );
    }

    public static function personaActualizar(int $id, string $nombre, string $apellidos, int $telefono, int $estrella, int $categoriaId)
    {
        self::ejecutarActualizacion(
            "UPDATE Persona SET nombre=?, apellidos=?, telefono=?, estrella=?, categoriaId=? WHERE id=?",
            [$nombre,$apellidos,$telefono,$estrella,$categoriaId,$id]
        );
    }

    public static function personaEliminarPorId($id)
    {
        self::ejecutarActualizacion(
            "DELETE FROM Persona WHERE id=?",
            [$id]
        );
    }

    public static function personaEliminar(Persona $persona): bool
    {
        return self::personaEliminarPorId($persona->id);
    }

    public static function personaCambiarEstrella(int $id)
    {
        if(self::personaObtenerPorId($id)->getEstrella()==0) {
            self::ejecutarActualizacion(
                "UPDATE Persona SET estrella = 1 WHERE id=?",
                [$id]
            );
        }
        else{
            self::ejecutarActualizacion(
            "UPDATE Persona SET estrella = 0 WHERE id=?",
            [$id]
        );

        }
        /*self::ejecutarActualizacion(
            "UPDATE Persona SET estrella = (NOT (SELECT estrella FROM Persona WHERE id=?)) WHERE id=?",
            [$id]
        );*/


    }

}

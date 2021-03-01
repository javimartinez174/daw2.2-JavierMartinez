<?php

abstract class Dato
{
}

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

class Categoria extends Dato implements JsonSerializable
{
    use Identificable;

    private string $nombre;
    private array $personasPertenecientes;

    public function __construct(int $id, string $nombre)
    {
        $this->setId($id);
        $this->setNombre($nombre);
    }

    public function jsonSerialize()
    {
        return [
            "nombre" => $this->nombre,
            "id" => $this->id,
        ];

        // Esto sería lo mismo:
        //$array["nombre"] = $this->nombre;
        //$array["id"] = $this->id;
        //return $array;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function obtenerPersonasPertenecientes(): array
    {
        if ($this->personasPertenecientes == null) $personasPertenecientes = DAO::personaObtenerPorCategoria($this->id);

        return $personasPertenecientes;
    }
}

class Persona extends Dato implements JsonSerializable
{
    use Identificable;

    private string $nombre;
    private string $apellidos;
    private int $telefono;
    private int $estrella;
    private int $categoriaId;
    private ?Categoria $categoria;

    /*public function __construct(int $id, string $nombre)
    {
        $this->setId($id);
        $this->setNombre($nombre);
    }*/

    public function __construct(int $id, string $nombre, string $apellidos, int $telefono, int $categoriaId)
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setTelefono($telefono);
        $this->setEstrella(0);
        $this->setCategoriaId($categoriaId);
    }

    public function jsonSerialize()
    {
        return [
            "categoriaId" => $this->categoriaId,
            "estrella" => $this->estrella,
            "telefono" => $this->telefono,
            "apellidos" => $this->apellidos,
            "nombre" => $this->nombre,
            "id" => $this->id,
        ];

        // Esto sería lo mismo:
        //$array["nombre"] = $this->nombre;
        //$array["id"] = $this->id;
        //return $array;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getTelefono(): int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono)
    {
        $this->telefono = $telefono;
    }

    public function getEstrella(): int
    {
        return $this->estrella;
    }

    public function setEstrella(int $estrella)
    {
        $this->estrella = $estrella;
    }

    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId)
    {
        $this->categoriaId = $categoriaId;
    }

    public function obtenerCategoria(): Categoria
    {
        return DAO::categoriaObtenerPorId($this->categoriaId);

    }
}



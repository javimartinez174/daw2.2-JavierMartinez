<?php

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

abstract class Dato
{
}

/*--------------------------------USUARIO----------------------------------*/

class Usuario extends Dato
{
    use Identificable;

    private string $identificador;

    private string $nombre;

    private string $apellidos;

    private string $contrasenna;

    public function __construct(int $id, string $identificador, string $nombre, string $apellidos, string $contrasenna)
    {
        $this->setId($id);
        $this->setIdentificador($identificador);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setContrasenna($contrasenna);
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getIdentificador(): string
    {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador)
    {
        $this->identificador = $identificador;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getContrasenna(): string
    {
        return $this->contrasenna;
    }

    public function setContrasenna(string $contrasenna)
    {
        $this->contrasenna = $contrasenna;
    }
}
    /*--------------------------------PUBLICACION----------------------------------*/

class Publicacion extends Dato
{
    use Identificable;

    private string $fecha;

    private int $emisorId;

    private string $asunto;

    private string $contenido;

    public function __construct(int $id, string $fecha, int $emisorId, string $asunto, string $contenido)
    {
        $this->setId($id);
        $this->setFecha($fecha);
        $this->setEmisorId($emisorId);
        $this->setAsunto($asunto);
        $this->setContenido($contenido);
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha)
    {
        $this->fecha = $fecha;
    }

    public function getEmisorId(): string
    {
        return $this->emisorId;
    }

    public function setEmisorId(string $emisorId)
    {
        $this->emisorId = $emisorId;
    }

    public function getAsunto(): string
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto)
    {
        $this->asunto = $asunto;
    }

    public function getContenido(): string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido)
    {
        $this->contenido = $contenido;
    }

}
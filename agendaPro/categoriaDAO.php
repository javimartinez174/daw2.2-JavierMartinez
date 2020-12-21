<?php
require_once "_varios.php";

class Categoria{

    private $nombre;

    function __contruct($nombre)
    {
        $this->setNombre($nombre);
    }

    public function obtenerCategoria():array
    {
        $arrayCategorias = [];
        $conexionBD = obtenerPdoConexionBD();

        $sql = "SELECT * FROM categoria ORDER BY nombre";

        $select = $conexionBD->prepare($sql);
        $select->execute([]);
        $rs = $select->fetchAll();

        foreach ($rs as $fila) {
            $categoria = new Categoria($fila["nombre"]);
            array_push($arrayCategorias, $categoria);
        }
        return $arrayCategorias;
    }


    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre(int $nombre)
    {
        $this->nombre = $nombre;
    }

}
<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

if(isset($_REQUEST["fav"])) { //declaramos la variable fav para la lista de personas favoritas
    $fav = $_REQUEST["fav"];
    $fav = ($fav == 1) ? true : false;
}else
    $fav=false;

$where = ($fav)?"WHERE p.estrella":""; //WHERE para hacer SELECT con personas favoritas o no

        $sql = "
               SELECT
                    p.id        AS p_id,
                    p.nombre    AS p_nombre,
                    p.telefono  AS p_telefono,
                    p.apellidos AS p_apellido,
                    p.estrella  AS p_estrella,
                    c.id        AS c_id,
                    c.nombre    AS c_nombre                    
                FROM
                   persona AS p INNER JOIN categoria AS c
                   ON p.categoriaId = c.id
                ".$where."
                ORDER BY p.nombre
        ";

$select = $conexionBD->prepare($sql);
$select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
$rs = $select->fetchAll();


?>



<html>

<head>
    <meta charset='UTF-8'>
</head>

<body>

<h1>Listado de Personas</h1>


    <table border='1'>

        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Categoría</th>
        </tr>

        <?php foreach ($rs as $fila) { ?>
            <tr>
                <td>
                    <p> <?=$fila["p_nombre"] ?>
                        <?php
                            if ($fila["p_estrella"])
                                $urlImagen = "img/estrellaRellena.png";
                            else
                                $urlImagen = "img/estrellaVacia.png";
                        ?>
                    <img src=<?=$urlImagen?> width='16' height='16'>
                    </p>
                </td>
                <td><p> <?=$fila["p_apellido"]?>                                                                                                            </p></td>
                <td><p> <?=$fila["p_telefono"]?>                                                                                                            </p></td>
                <td><a  href=   'categoriaFicha.php?id=<?=$fila["c_id"]?>'> <?=$fila["c_nombre"] ?>                                                         </a></td>
                <td><a  href=   'personaEliminar.php?id=<?=$fila["p_id"]?>'> (X)                                                                            </a></td>
                <td><a  href=   'personaFicha.php?id=<?=$fila["p_id"]?>&c_id=<?=$fila["c_id"] ?>&c_nombre=<?=$fila["c_nombre"] ?>'> (Editar)                </a></td>
            </tr>
        <?php } ?>

    </table>

<br />
<?php if(!$fav){?>
    <a href='personaListado.php?fav=1'>Ver Favoritos</a>
<?php }elseif($fav){?>
    <a href='personaListado.php?fav=0'>Ver Todos</a>
<?php }?>

<br />
<br />

<a href='personaFicha.php?id=-1&c_id=-1&c_nombre=<Introduzca nombre categoría>'>Crear entrada</a>

<br />
<br />

<a href='categoriaListado.php'>Gestionar listado de Categorías</a>


</body>

</html>

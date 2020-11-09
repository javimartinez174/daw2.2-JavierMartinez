<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

$sql = "
               SELECT
                    p.id       AS p_id,
                    p.nombre   AS p_nombre,
                    p.telefono AS p_telefono,
                    c.id       AS c_id,
                    c.nombre   AS c_nombre                    
                FROM
                   persona AS p INNER JOIN categoria AS c
                   ON p.categoria_id = c.id
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
        <th>Teléfono</th>
        <th>Categoría</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
        <tr>
            <td><a href=   'personaFicha.php?id=<?=$fila["p_id"]?>&c_id=<?=$fila["c_id"] ?>&c_nombre=<?=$fila["c_nombre"] ?>'> <?=$fila["p_nombre"] ?> </a></td>
            <td><p> <?=$fila["p_telefono"]?>  </p></td>
            <td><p> <?=$fila["c_nombre"]?>  </p></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href='personaFicha.php?id=-1&c_id=-1&c_nombre=<Introduzca nombre categoría>'>Crear entrada</a>

<br />
<br />

<a href='categoriaListado.php'>Gestionar listado de Categorías</a>


</body>

</html>

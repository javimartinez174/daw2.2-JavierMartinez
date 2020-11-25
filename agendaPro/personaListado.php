<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

session_start();

if (isset($_REQUEST[$_SESSION["tema"]]))
    $_SESSION["tema"] = $_REQUEST["tema"];


if(isset($_REQUEST["colorChange"])) { //variable para cambiar el color de la tabla
    $colorChange = $_REQUEST["colorChange"];
    $colorChange = ($colorChange == 1) ? true : false;
}else
    $colorChange=false;


if (isset($_REQUEST["favoritos"])) {
    $_SESSION["favoritos"] = true;
}
if (isset($_REQUEST["todos"])) {
    unset($_SESSION["favoritos"]);
}

$where = isset($_SESSION["favoritos"])?"WHERE p.estrella":""; //WHERE para hacer SELECT con personas favoritas o no

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

$mayorId=0;//variable para destacar la última entrada de la agenda, que tendrá el mayor ID
//bucle para obtener el mayorId
if(isset($_REQUEST["todos"]))
foreach ($rs as $fila) {
    if ($fila["p_id"] > $mayorId)
        $mayorId = $fila["p_id"];
}
?>



<html>

<head>
    <meta charset='UTF-8'>

    <style>
    <?php
        $color1="table{ 
                    background-color: lightcyan;
                    }";
        $color2="table{ 
                    background-color: lightgreen
                    }";
        $color3="table{ 
                    background-color: lightcoral
                    }";
        $color = rand(1,3);
        if($colorChange)
            switch ($color) {
                case 1:
                    echo $color1;
                    break;
                case 2:
                    echo $color2;
                    break;
                case 3:
                    echo $color3;
                    break;
                default:
                    echo $color1;
                    break;
            }
        ?>

    body{
        background-color: <?= $_SESSION["tema"]; ?>;
    }

    </style>

</head>

<body>

<h1>Listado de Personas</h1>

    <table border='1' >

        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Categoría</th>
        </tr>

        <?php foreach ($rs as $fila) { ?>
            <?php
                if($fila["p_id"]==$mayorId)
                    echo "<tr style='background-color: yellow'>";
                else
                    echo "<tr>";
            ?>

                <td>
                    <p> <?=$fila["p_nombre"] ?>
                        <?php
                            $urlImagen = $fila["p_estrella"] ? "img/estrellaRellena.png" : "img/estrellaVacia.png";
                        ?>
                    <a href='personaEstablecerEstadoEstrella.php?id=<?=$fila["p_id"]?>'><img src=<?=$urlImagen?> width='16' height='16'></a>
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

<?php if(!$colorChange){?>
    <a  href=   'personaListado.php?colorChange=1'><img src="img/color.png" width='100' height='100'</a>
<?php }elseif($colorChange){?>
    <a  href=   'personaListado.php?colorChange=0'><img src="img/color.png" width='100' height='100'</a>
<?php }?>



<br />
<?php if(!isset($_SESSION["favoritos"])){?>
    <a href='personaListado.php?favoritos'>Ver Favoritos</a>
<?php }else{?>
    <a href='personaListado.php?todos'>Ver Todos</a>
<?php }?>

<br />
<br />

<a href='personaFicha.php?id=-1&c_id=-1&tema'>Crear entrada</a>

<br />
<br />

<a href='categoriaListado.php'>Gestionar listado de Categorías</a>


</body>

</html>

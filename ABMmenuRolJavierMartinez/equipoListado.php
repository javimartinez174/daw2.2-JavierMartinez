<?php
require_once "_varios.php";

$conexionBD = obtenerPdoConexionBD();

session_start();

//variables de control de guardado
if(isset($_REQUEST["correcto"])) {
    $correcto = $_REQUEST["correcto"];
    $datosNoModificados = $_REQUEST["datosNoModificados"];
    $nuevaEntrada = $_REQUEST["nuevaEntrada"];
}
else {
    $correcto = false;
    $datosNoModificados = false;
    $nuevaEntrada = false;
}

//variables de control de eliminado
if(isset($_REQUEST["correctoNormal"])) {
    $correctoNormal = $_REQUEST["correctoNormal"];
    $noExistia = $_REQUEST["noExistia"];
}
else {
    $correctoNormal = false;
    $noExistia = false;
}

if (isset($_REQUEST["eFavoritos"])) {
    $_SESSION["eFavoritos"] = true;
}
if (isset($_REQUEST["eTodos"])) {
    unset($_SESSION["eFavoritos"]);
}

$where = isset($_SESSION["eFavoritos"])?"WHERE e.estrella":""; //WHERE para hacer SELECT con equipos favoritos o no


$sql = "
               SELECT
                    e.id        AS eId,
                    e.arma      AS eArma,
                    e.magia     AS eMagia,
                    e.armadura  AS eArmadura,
                    e.estrella  AS eEstrella,
                    p.id        AS pId,
                    p.nombre    AS pNombre,   
                    p.regionId  AS rId                 
                FROM
                   equipo AS e INNER JOIN personaje AS p
                   ON e.personajeId = p.id
                ".$where."
                ORDER BY p.nombre
        ";

$select = $conexionBD->prepare($sql);
$select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
$rs = $select->fetchAll();

$mayorId=0;//variable para destacar la última entrada de la agenda, que tendrá el mayor ID
//bucle para obtener el mayorId
if(!isset($_REQUEST["eTodos"]) && !isset($_REQUEST["eFavoritos"]))
    foreach ($rs as $fila) {
        if ($fila["eId"] > $mayorId)
            $mayorId = $fila["eId"];
    }
?>



<html>

<head>
    <meta charset='UTF-8'>

    <style>

        a:link{
            text-decoration: none;
            color: red;
        }
        a:visited{
            color:darkred;
        }
        a:hover{
            text-decoration: underline;
        }
        table{
            border: 5px double grey;
            background-color: palegoldenrod;
        }
        th{
            background-color: lightcoral;
        }
        td{
            border: 2px solid black;
        }



        <?php

            ?>


    </style>

</head>

<body>

<h1>Listado de Equipos</h1>


<table border='5' >

    <tr>
        <th>Arma</th>
        <th>Magia</th>
        <th>Armadura</th>
        <th>Personaje</th>
    </tr>

    <?php foreach ($rs as $fila) { ?>
    <?php
        if($fila["eId"]==$mayorId)
            echo "<tr style='background-color: yellow'>";
        else
            echo "<tr>";
        ?>

        <td><p> <?=$fila["eArma"] ?>                                                                                                  </p></td>
        <td><p> <?=$fila["eMagia"]?>                                                                                                  </p></td>
        <td><p> <?=$fila["eArmadura"]?>                                                                                               </p></td>
        <td><a  href=   'personajeFicha.php?id=<?=$fila["pId"]?>&rId=<?=$fila["rId"]?>'> <?=$fila["pNombre"] ?>                       </a></td>
        <td><a  href=   'equipoEliminar.php?id=<?=$fila["eId"]?>'> (X)                                                                </a></td>
        <td><a  href=   'equipoFicha.php?id=<?=$fila["eId"]?>&pId=<?=$fila["pId"] ?>&pNombre=<?=$fila["pNombre"] ?>'> (Editar)        </a>
            <?php
            $urlImagen = $fila["eEstrella"] ? "img/estrellaRellena.png" : "img/estrellaVacia.png";
            ?>
            <a href='equipoFavorito.php?id=<?=$fila["eId"]?>'><img src=<?=$urlImagen?> width='16' height='16'></a>
        </td>
    </tr>
    <?php } ?>

</table>




<br />
<?php if(!isset($_SESSION["eFavoritos"])){?>
    <button><a href='equipoListado.php?eFavoritos'>Ver Favoritos</a></button>
<?php }else{?>
    <button><a href='equipoListado.php?eTodos'>Ver Todos</a></button>
<?php }?>

<br />
<br />

<a href='equipoFicha.php?id=-1&pId=-1'>Crear entrada</a>

<br />
<br />

<a href='personajeListado.php'>Gestionar listado de Personajes</a>


<?php
//datos de guardado
if(isset($_REQUEST["correcto"])){
    // Todos bien tanto si se han guardado los datos nuevos como si no se habían modificado.
    if ($correcto || $datosNoModificados) { ?>
        <?php if ($nuevaEntrada) { ?>
            <h1>Inserción completada</h1>
            <p>Se ha insertado correctamente la nueva entrada.</p>
        <?php } else { ?>
            <h1>Guardado completado</h1>
            <p>Se han guardado correctamente los datos.</p>

            <?php if ($datosNoModificados) { ?>
                <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
            <?php } ?>
        <?php }
        ?>

        <?php
    } else {
        ?>

        <?php if ($nuevaEntrada) { ?>
            <h1>Error en la creación.</h1>
            <p>No se ha podido crear el nuevo equipo.</p>
        <?php } else { ?>
            <h1>Error en la modificación.</h1>
            <p>No se han podido guardar los datos del equipo.</p>
        <?php } ?>

        <?php
    }
}
?>

<?php
//datos de eliminado
if(isset($_REQUEST["correctoNormal"])){
    if ($correctoNormal) { ?>

        <h1>Eliminación completada</h1>
        <p>Se ha eliminado correctamente el equipo.</p>

    <?php } else if ($noExistia) { ?>

        <h1>Eliminación no realizada</h1>
        <p>No existe el equipo que se pretende eliminar (quizá la eliminaron en paraleo o, ¿ha manipulado Vd. el parámetro id?).</p>

    <?php } else { ?>

        <h1>Error en la eliminación</h1>
        <p>No se ha podido eliminar el equipo.</p>

    <?php }
}
?>


</body>

</html>


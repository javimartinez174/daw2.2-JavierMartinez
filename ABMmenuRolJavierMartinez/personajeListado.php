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

//sesión favoritos y todos
if (isset($_REQUEST["pFavoritos"])) {
    $_SESSION["pFavoritos"] = true;
}
if (isset($_REQUEST["pTodos"])) {
    unset($_SESSION["pFavoritos"]);
}

$where = isset($_SESSION["pFavoritos"])?"WHERE p.estrella":""; //WHERE para hacer SELECT con personajes favoritos o no


        $sql = "
               SELECT
                    p.id        AS pId,
                    p.nombre    AS pNombre,
                    p.apodo     AS pApodo,
                    p.raza      AS pRaza,
                    p.clase     AS pClase,
                    p.estrella  AS pEstrella,
                    r.id        AS rId,
                    r.nombre    AS rNombre                    
                FROM
                   personaje AS p INNER JOIN region AS r
                   ON p.regionId = r.id
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
    if ($fila["pId"] > $mayorId)
        $mayorId = $fila["pId"];
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


    </style>

</head>

<body>

<h1>Listado de Personajes</h1>


    <table border='5' >

        <tr>
            <th>Nombre</th>
            <th>Apodo</th>
            <th>Raza</th>
            <th>Clase</th>
            <th>Region</th>
        </tr>

        <?php foreach ($rs as $fila) { ?>
            <?php
                if($fila["pId"]==$mayorId)
                    echo "<tr style='background-color: yellow'>";
                else
                    echo "<tr>";
            ?>

                <td><p> <?=$fila["pNombre"] ?>                                                                                                           </p></td>
                <td><p> <?=$fila["pApodo"]?>                                                                                                             </p></td>
                <td><p> <?=$fila["pRaza"]?>                                                                                                              </p></td>
                <td><p> <?=$fila["pClase"]?>                                                                                                             </p></td>
                <td><a  href=   'regionFicha.php?id=<?=$fila["rId"]?>'> <?=$fila["rNombre"] ?>                                                           </a></td>
                <td><a  href=   'personajeEliminar.php?id=<?=$fila["pId"]?>'> (X)                                                                        </a></td>
                <td><a  href=   'personajeFicha.php?id=<?=$fila["pId"]?>&rId=<?=$fila["rId"] ?>&rNombre=<?=$fila["rNombre"] ?>'> (Editar)                </a>
                    <?php
                    $urlImagen = $fila["pEstrella"] ? "img/estrellaRellena.png" : "img/estrellaVacia.png";
                    ?>
                    <a href='personajeFavorito.php?id=<?=$fila["pId"]?>'><img src=<?=$urlImagen?> width='16' height='16'></a>
                </td>
            </tr>
        <?php } ?>

    </table>




<br />
<?php if(!isset($_SESSION["pFavoritos"])){?>
    <button><a href='personajeListado.php?pFavoritos'>Ver Favoritos</a></button>
<?php }else{?>
    <button><a href='personajeListado.php?pTodos'>Ver Todos</a></button>
<?php }?>

<br />
<br />

<a href='personajeFicha.php?id=-1&rId=-1'>Crear entrada</a>

<br />
<br />

<a href='regionListado.php'>Gestionar listado de Regiones</a>
<br>
<a href='equipoListado.php'>Gestionar listado de Equipos</a>


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
            <p>No se ha podido crear la nueva personaje.</p>
        <?php } else { ?>
            <h1>Error en la modificación.</h1>
            <p>No se han podido guardar los datos de la personaje.</p>
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
    <p>Se ha eliminado correctamente el personaje.</p>

    <?php } else if ($noExistia) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe el personaje que se pretende eliminar (quizá la eliminaron en paraleo o, ¿ha manipulado Vd. el parámetro id?).</p>

    <?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar el personaje.</p>

    <?php }
}?>





</body>

</html>

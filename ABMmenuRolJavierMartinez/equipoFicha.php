<?php

require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$pId = (int)$_REQUEST["pId"];
$armasTipos = array("Martillo de Acero", "Espada de Silthur", "Maza de oro", "Daga Colmillo", "Guadaña De La Hermandad", "Arco del Arrepentimiento");
$magiasTipos = array("Escarcha", "Oscuridad", "Sol del Oasis", "Fuego Fatuo", "Inquebrantable", "Escudo Fantasmal");
$armadurasTipos = array("Armadura de Piel", "Armadura de Hueso", "Armadura de Damasco", "Armadora enana pesada", "Armadura Hechizada", "Armadura Tenebrosa");

// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de un equipo existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);


//cogemos todos los nombres de personaje para hacer un select html
$sql = "SELECT * FROM personaje ORDER BY nombre";
$select = $conexion->prepare($sql);
$select->execute([]);
$rsPersonaje = $select->fetchAll();


if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $equipoArma = "<introduzca Arma>";
    $equipoMagia = "<introduzca Magia>";
    $equipoArmadura = "<introduzca Armadura>";
    $equipoEstrella = false;

} else { // Quieren VER la ficha de un equipo existente, cuyos datos se cargan.
    $sql = "SELECT arma, magia, armadura, estrella FROM equipo WHERE id=?";


    $select = $conexion->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $equipoArma = $rs[0]["arma"];
    $equipoMagia = $rs[0]["magia"];
    $equipoArmadura = $rs[0]["armadura"];
    $equipoEstrella = ($rs[0]["estrella"] == 1); //convertimos a boolean
}



// INTERFAZ:
// $nuevaEntrada
// $armasTipos
// $magiasTipos
// $armadurasTipos
// $equipoArma
// $equipoMagia
// $equipoArmadura
// $equipoEstrella
// $rsPersonaje

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
        <?php

            ?>


    </style>
</head>

<body>

<?php if ($nuevaEntrada) { ?>
    <h1>Nueva ficha de equipo</h1>
<?php } else { ?>
    <h1>Ficha de equipo</h1>
<?php } ?>

<form method='post' action='equipoGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />


    <ul>
        <li>
            <strong>Arma:   </strong>
            <select style='margin:10px; width:200px;' name="arma">
                <?php foreach ($armasTipos as $nArma) {
                    if($equipoArma==$nArma)
                        echo "<option value=\"$nArma\" selected>$nArma</option>";
                    else
                        echo "<option value=\"$nArma\"     >$nArma</option>";
                } ?>
            </select>
        </li>
        <li>
            <strong>Magia:   </strong>
            <select style='margin:10px; width:200px;' name="magia">
                <?php foreach ($magiasTipos as $nMagia) {
                    if($equipoMagia==$nMagia)
                        echo "<option value=\"$nMagia\" selected>$nMagia</option>";
                    else
                        echo "<option value=\"$nMagia\"     >$nMagia</option>";
                } ?>
            </select>
        </li>
        <li>
            <strong>Armadura: </strong>
            <select style='margin:10px; width:200px;' name="armadura">
                <?php foreach ($armadurasTipos as $nArmadura) {
                    if($equipoArmadura==$nArmadura)
                        echo "<option value=\"$nArma\" selected>$nArmadura</option>";
                    else
                        echo "<option value=\"$nArmadura\"     >$nArmadura</option>";
                } ?>
            </select>
        </li>
        <li>
            <strong>Personaje: </strong>
            <select style='margin:10px; width:200px;' name="pNombre">
                <?php foreach ($rsPersonaje as $fila) {
                    $nombre = $fila["nombre"];
                    if($pId==$fila["id"])
                        echo "<option value=\"$nombre\" selected>$nombre</option>";
                    else
                        echo "<option value=\"$nombre\">$nombre</option>";
                } ?>
            </select>
        </li>
        <li>
            <strong><label for='estrella'>Favorito:</label></strong>
            <input style='margin:10px; width:200px;' type='checkbox' name='estrella' <?= $equipoEstrella ? "checked" : "" ?> />
        </li>
    </ul>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear equipo' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
        <br />
        <br />
        <a href='personajeEliminar.php?id=<?=$id?>'>Eliminar equipo</a>
    <?php } ?>



</form>

<br />

<a href='personajeListado.php'>Volver al listado de personajes.</a>
<br />
<a href='regionListado.php'>Volver al listado de regiones.</a>

</body>

</html>

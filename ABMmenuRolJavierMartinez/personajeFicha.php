<?php

require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];
$rId = (int)$_REQUEST["rId"];
$razasTipos = array("Humano", "Orco", "Elfo", "Enano");
$clasesTipos = array("Guerrero", "Asesino", "Mago", "Tanque");

//seleccionamos todas los equipos que tenga el personaje con ese id
$sql = "SELECT arma, magia, armadura FROM equipo WHERE personajeId=?";

$select = $conexion->prepare($sql);
$select->execute([$id]); // Se añade el parámetro a la consulta preparada.
$rsEquipo = $select->fetchAll();


// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de un personaje existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);


//cogemos todos los nombres de categoría para hacer un select html
$sql = "SELECT * FROM region ORDER BY nombre";
$select = $conexion->prepare($sql);
$select->execute([]); // Se añade el parámetro a la consulta preparada.
$rsRegion = $select->fetchAll();


if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $personajeNombre = "<introduzca Nombre>";
    $personajeApodo = "<introduzca Apodo>";
    $personajeRaza = "<introduzca Raza>";
    $personajeClase = "<introduzca Clase>";
    $personajeEstrella = false;

} else { // Quieren VER la ficha de una persona existente, cuyos datos se cargan.
    $sql = "SELECT nombre, apodo, raza, clase, estrella FROM personaje WHERE id=?";


    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $personajeNombre = $rs[0]["nombre"];
    $personajeApodo = $rs[0]["apodo"];
    $personajeRaza = $rs[0]["raza"];
    $personajeClase = $rs[0]["clase"];
    $personajeEstrella = ($rs[0]["estrella"] == 1); //convertimos a boolean
}



// INTERFAZ:
// $nuevaEntrada
// $razasTipos
// $clasesTipos
// $personajeNombre
// $personajeApodo
// $personajeRaza
// $personajeClase
// $rsRegion

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
    <h1>Nueva ficha de personaje</h1>
<?php } else { ?>
    <h1>Ficha de personaje</h1>
<?php } ?>

<form method='post' action='personajeGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />


    <ul>
        <li>
            <strong>Nombre:   </strong>
            <input style='margin:10px' type='text' name='nombre'   value='<?=$personajeNombre?>' />
        </li>
        <li>
            <strong>Apodo:   </strong>
            <input style='margin:10px' type='text' name='apodo'   value='<?=$personajeApodo?>' />
        </li>
        <li>
            <strong>Raza: </strong>
            <select style='margin:10px; width:200px;' name="raza">
                <?php foreach ($razasTipos as $nRaza) {
                    if($personajeRaza==$nRaza)
                        echo "<option value=\"$nRaza\" selected>$nRaza</option>";
                    else
                        echo "<option value=\"$nRaza\"     >$nRaza</option>";
                } ?>
            </select>
        </li>
        <li>
            <strong>Clase: </strong>
            <select style='margin:10px; width:200px;' name="clase">
                <?php foreach ($clasesTipos as $nClase) {
                    if($personajeClase==$nClase)
                        echo "<option value=\"$nClase\" selected>$nClase</option>";
                    else
                        echo "<option value=\"$nClase\"     >$nClase</option>";
                } ?>
            </select>
        </li>
        <li>
            <strong>Region: </strong>
                <select style='margin:10px; width:200px;' name="rNombre">
                    <?php foreach ($rsRegion as $fila) {
                        $nombre = $fila["nombre"];
                        if($rId==$fila["id"])
                            echo "<option value=\"$nombre\" selected>$nombre</option>";
                        else
                            echo "<option value=\"$nombre\">$nombre</option>";
                    } ?>
                </select>
        </li>
        <li>
            <strong><label for='estrella'>Favorito:</label></strong>
            <input style='margin:10px; width:200px;' type='checkbox' name='estrella' <?= $personajeEstrella ? "checked" : "" ?> />
        </li>
    </ul>

    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear personaje' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
        <br />
        <br />

        <h4>Equipos del personaje: <?=$personajeNombre?></h4>

        <?php foreach ($rsEquipo as $fila) { ?>
            <ul>
                <li>Arma:        <?=$fila["arma"]?>      </li>
                <li>Magia:       <?=$fila["magia"]?>     </li>
                <li>Armadura:    <?=$fila["armadura"]?>  </li>
            </ul>
        <?php } ?>


        <br />
        <br />
        <a href='personajeEliminar.php?id=<?=$id?>'>Eliminar personaje</a>
    <?php } ?>



</form>

<br />

<a href='personajeListado.php'>Volver al listado de personajes.</a>

</body>

</html>

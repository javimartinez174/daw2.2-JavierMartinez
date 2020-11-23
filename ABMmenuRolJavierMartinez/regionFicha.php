<?php
require_once "_varios.php";

$conexion = obtenerPdoConexionBD();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

//seleccionamos todos los personajes que estén dentro de la region con ese id
$sql = "SELECT nombre, apodo, raza, clase FROM personaje WHERE regionId=?";

$select = $conexion->prepare($sql);
$select->execute([$id]); // Se añade el parámetro a la consulta preparada.
$rsPersonaje = $select->fetchAll();


// Si id es -1 quieren CREAR una nueva entrada ($nueva_entrada tomará true).
// Sin embargo, si id NO es -1 quieren VER la ficha de una region existente
// (y $nueva_entrada tomará false).
$nuevaEntrada = ($id == -1);

if ($nuevaEntrada) { // Quieren CREAR una nueva entrada, así que no se cargan datos.
    $regionNombre = "<introduzca nombre>";
} else { // Quieren VER la ficha de una region existente, cuyos datos se cargan.
    $sql = "SELECT nombre FROM region WHERE id=?";

    $select = $conexion->prepare($sql);
    $select->execute([$id]); // Se añade el parámetro a la consulta preparada.
    $rs = $select->fetchAll();

    // Con esto, accedemos a los datos de la primera (y esperemos que única) fila que haya venido.
    $regionNombre = $rs[0]["nombre"];
}



// INTERFAZ:
// $nuevaEntrada
// $categoriaNombre
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
    <h1>Nueva ficha de región</h1>
<?php } else { ?>
    <h1>Ficha de región</h1>
<?php } ?>

<form method='post' action='regionGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type='text' name='nombre' value='<?=$regionNombre?>' />
        </li>
    </ul>




    <?php if ($nuevaEntrada) { ?>
        <input type='submit' name='crear' value='Crear región' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
        <br />
        <br />

            <h4>Personajes de la región: <?=$regionNombre?></h4>

            <?php foreach ($rsPersonaje as $fila) { ?>
                <ul>
                    <li>Nombre:    <?=$fila["nombre"]?>    </li>
                    <li>Apodo:     <?=$fila["apodo"]?>     </li>
                    <li>Raza:      <?=$fila["raza"]?>      </li>
                    <li>Clase:     <?=$fila["clase"]?>     </li>
                </ul>
            <?php } ?>

        <br />
        <br />
        <a href='regionEliminar.php?id=<?=$id?>'>Eliminar region</a>
        <br />
        <br />





    <?php } ?>

</form>

<br />

<a href='regionListado.php'>Volver al listado de regiones.</a>

</body>
</html>

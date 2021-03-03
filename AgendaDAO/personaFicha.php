<?php
require_once "_com/DAO.php";

recogerTema();

// Se recoge el parámetro "id" de la request.
$id = (int)$_REQUEST["id"];

$persona = DAO::personaObtenerPorId($id);

if ($persona == null) {
    $personaNombre = "<introduzca nombre>";
    $personaApellidos = "<introduzca apellidos>";
    $personaTelefono = "<introduzca telefono>";
    $personaEstrella = "<introduzca estrella>";
    $personaCategoriaId = "<introduzca categoriaId>";
}else {
    $personaNombre = $persona->getNombre();
    $personaApellidos = $persona->getApellidos();
    $personaTelefono = $persona->getTelefono();
    $personaEstrella = $persona->getEstrella();
    $personaCategoriaId = $persona->getCategoriaId();
}
?>

<html>

<head>
    <style>
    body{
        background-color: <?= $_SESSION["fondo"]; ?>;
        }
    </style>
    <meta charset='UTF-8'>
</head>



<body>

<?php if ($id==-1) { ?>
    <h1>Nueva ficha de persona</h1>
<?php } else { ?>
    <h1>Ficha de persona</h1>
<?php } ?>

<form method='post' action='personaGuardar.php'>

    <input type='hidden' name='id' value='<?=$id?>' />

    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type='text' name='nombre' value='<?=$personaNombre?>' />
        </li>
        <li>
            <strong>Apellido: </strong>
            <input type='text' name='apellidos' value='<?=$personaApellidos?>' />
        </li>
        <li>
            <strong>Telefono: </strong>
            <input type='text' name='telefono' value='<?=$personaTelefono?>' />
        </li>
        <li>
            <strong>Categoria: </strong>
            <input type='number' name='categoriaId' value='<?=$personaCategoriaId?>' />
        </li>
        <li>
            <strong>Favoritos</strong>
            <input type="checkbox" name="estrella" <?= $personaEstrella ? "checked" : "" ?> />
        </li>
        <br>

    <?php if ($id==-1) { ?>
        <input type='submit' name='crear' value='Crear persona' />
    <?php } else { ?>
        <input type='submit' name='guardar' value='Guardar cambios' />
    <?php } ?>

</form>

<br>

<a href='personaEliminar.php?id=<?=$id?>'>Eliminar persona</a>

<br />
<br />

<a href='personaListado.php'>Volver al listado de personas.</a>

</body>


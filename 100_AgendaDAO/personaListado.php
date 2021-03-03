<?php
require_once "_com/DAO.php";

$personas = DAO::personaObtenerTodas();

recogerTema();

if(isset($_REQUEST["soloEstrellas"])){
    $_SESSION["soloEstrellas"] = true;
}
if(isset($_REQUEST["todos"])){
    unset($_SESSION["soloEstrellas"]);
}

?>

<html>

<head>
    <meta charset='UTF-8'>
</head>

<style>
    body{
        background-color: <?= $_SESSION["fondo"]; ?>;
    }
</style>

<body>

<h1>Listado de persona</h1>

<table border='1'>

    <tr>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Telefono</th>
        <th>Categoria</th>
    </tr>

    <?php if(isset($_SESSION["soloEstrellas"])) {  ?>
        <?php foreach ($personas as $persona) { ?>
            <?php if($persona->getEstrella()==1) {  ?>
                <tr>
                    <td>
                        <?php
                        echo "<a href='personaFicha.php?id=".$persona->getId()."'>";
                        echo $persona->getNombre();
                        echo"</a>";
                        if($persona->getEstrella()==1)
                            $urlImagen = "img/estrellaRellena.png";
                        else
                            $urlImagen = "img/estrellaVacia.png";
                        echo  "<a href='personaEstablecerEstadoEstrella.php?id=".$persona->getId()."'><img src='$urlImagen' width='16' height='16'></a>";
                        ?>
                    </td>
                    <td><?=$persona->getApellidos()?> </td>
                    <td><?=$persona->getTelefono()?></td>
                    <td><?=$persona->obtenerCategoria()->getNombre()?></td>
                    <td><a href='personaEliminar.php?id=<?=$persona->getId()?>'> (X)                   </a></td>
                </tr>
            <?php }?>
        <?php } ?>
    <?php }else{ ?>
        <?php foreach ($personas as $persona) { ?>
                <tr>
                    <td>
                        <?php
                        echo "<a href='personaFicha.php?id=".$persona->getId()."'>";
                        echo $persona->getNombre();
                        echo"</a>";
                        if($persona->getEstrella()==1)
                            $urlImagen = "img/estrellaRellena.png";
                        else
                            $urlImagen = "img/estrellaVacia.png";
                        echo  "<a href='personaEstablecerEstadoEstrella.php?id=".$persona->getId()."'><img src='$urlImagen' width='16' height='16'></a>";
                        ?>
                    </td>
                    <td><?=$persona->getApellidos()?> </td>
                    <td><?=$persona->getTelefono()?></td>
                    <td><?=$persona->obtenerCategoria()->getNombre()?></td>
                    <td><a href='personaEliminar.php?id=<?=$persona->getId()?>'> (X)                   </a></td>
                </tr>
        <?php } ?>
    <?php } ?>

</table>

<br />
<?php if(!isset($_SESSION["soloEstrellas"])){?>
    <a href='personaListado.php?soloEstrellas'>Mostrar solo contactos con estrella</a>
<?php } else {?>
    <a href='personaListado.php?todos'>Mostrar todos los contactos</a>
<?php } ?>
<br>
<br>

<a href='personaFicha.php?id=-1'>Crear entrada</a>

<br />
<br />

<a href='categoriaListado.php'>Gestionar listado de Categorias</a>

</body>


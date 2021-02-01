<?php
require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

if(isset($_REQUEST["identificador"])){
    $muro = $_REQUEST["identificador"];
    $id = $_REQUEST["id"];
}
else {
    $muro = $_SESSION["identificador"];
    $id = $_SESSION["id"];
}

$tema = comprobarTema();
?>

<html lang=''>

<head>
    <meta charset='UTF-8'>
    <title></title>
    <?php if ($tema) { ?>
        <link rel="stylesheet" href="_styles/styleBlack.css">
    <?php } else { ?>
        <link rel="stylesheet" href="_styles/style.css">
    <?php } ?>
</head>

<body>

<?php pintarInfoSesion(); ?>

<h1>Muro de <?= $muro?></h1>

<p>Aquí mostraremos los mensajes que hayan sido publicados para el usuario indicado como parámetro. Si no indican nada, veo los mensajes dirigidos a mí. Si indican otra cosa, veo los mensajes dirigidos a ese usuario.</p>

<?php $publicaciones = DAO::obtenerPublicacionDestinatarioId($id); ?>

<?php foreach ($publicaciones as $publicacion) { ?>

    <div class="publicacion">
        <hr>
        <p>Fecha: <?= $publicacion->getFecha() ?></p>
        <p><?= DAO::obtenerUsuarioId($publicacion->getEmisorId())->getIdentificador() ?></p>
        <p>Asunto: <?= $publicacion->getAsunto() ?></p>
        <p>Contenido: <?= $publicacion->getContenido() ?></p>
        <p><a href="borrarPublicacion.php?id=<?= $publicacion->getId() ?>">Eliminar</a></p>
        <hr>
    </div>
    <br>

<?php } ?>

    <div class="crearPublicacion">
        <form method='post' action='PublicacionNuevaCrear.php?id=<?=$id?>&&muro=<?=$muro?>'>
            <h2>Crear Publicación Nueva</h2>
            <table>
                <tr>
                    <td>
                        <input type='text' name='asunto' id='asunto' placeholder="Asunto"
                               required/>
                        <br><br>
                        <input type='text' name='contenido' id='contenido' placeholder="Contenido"
                               required/>
                        <br><br>
                    </td>
                </tr>
            </table>
            <br/>
            <button type='submit' name='crear' value='crearPublicacion'>Crear</button>
        </form>
    </div>

<a href='PaginaPrincipal.php'>Ir a Página Principal</a>
<br>

<a href='MuroVerGlobal.php'>Ir a Muro Global</a>

</body>

</html>
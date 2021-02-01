<?php
require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");

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

<body>

<?php pintarInfoSesion(); ?>

<h1>Muro global</h1>

<p>Aquí mostraremos todos los mensajes de todos a todos.</p>

<?php $publicaciones = DAO::publicacionObtenerTodas(); ?>

<?php foreach ($publicaciones as $publicacion) { ?>

    <div class="publicacion">
        <hr>
        <p>Fecha: <?= $publicacion->getFecha() ?></p>
        <p><?= DAO::obtenerUsuarioId($publicacion->getEmisorId())->getIdentificador() ?></p>
        <p>Asunto: <?= $publicacion->getAsunto() ?></p>
        <p>Contenido: <?= $publicacion->getContenido() ?></p>
        <hr>
    </div>
    <br>

<?php } ?>

<?php $usuarios = DAO::obtenerusuario(); ?>

<?php foreach ($usuarios as $usuario) { ?>

    <div class="muros">
        <hr>
        <li>Muro de <a href='MuroVerDe.php?identificador=<?=$usuario->getIdentificador() ?>&&id=<?=$usuario->getId() ?>'><?= $usuario->getIdentificador() ?></a></li>
        <hr>
    </div>
    <br>

<?php } ?>

    <div class="crearPublicacion">
        <form method='post' action='PublicacionNuevaCrear.php'>
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

<a href='MuroVerDe.php'>Ir a mi muro.</a>

</body>

</html>
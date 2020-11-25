<?php

//Javier Mártinez- VIllanueva Fernández ENTORNO SERVIDOR

if(isset($_REQUEST["resultado"]))
    $resultado = (int)$_REQUEST["resultado"];
else
    $resultado = 0;

if (!isset($_REQUEST["acumulado"])) // Si NO hay formulario enviado (1ª vez)
    $acumulado = 0;

if(isset($_REQUEST["suma"])) {
    $resultado = $resultado + (int)$_REQUEST["acumulado"];
    $acumulado = (int)$_REQUEST["acumulado"];
}else if(isset($_REQUEST["resta"])){
    $resultado = $resultado - (int)$_REQUEST["acumulado"];
    $acumulado = (int)$_REQUEST["acumulado"];
}

?>



<html>

    <body>

        <form method='get'>

            <input type='submit' value='-' name='resta'>

            <input type='text' name='acumulado' value='<?=$acumulado?>'>

            <input type="hidden" name="resultado" value="<?=$resultado?>">

            <input type='submit' value='+' name='suma'>

            <br /><br />

        </form>

        <h3>Resultado: <?=$resultado?></h3>

        <a href='<?= $_SERVER["PHP_SELF"] ?>'>Resetear</a>

    </body>
</html>
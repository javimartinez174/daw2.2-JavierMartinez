<?php
//Declaración de variables

//numero oculto del formulario 1
if(!isset($_POST["oculto"]))
    $oculto = (int)$_POST["numero"];
else
    $oculto = $_POST["oculto"];

//numero a probar por el jugador 2
if(!isset($_POST["intento"]))
    if($oculto!=0) $intento = 0;
    else $intento = -1;
else
    $intento = (int)$_POST["intento"];

//distancia en asteriscos
$distancia="";
for($i=0; $i < (int)abs($oculto-$intento)/2; $i++){
    $distancia= $distancia."*";
}

//contador de intentos y limite de intentos
$nIntentoMax=10;
if(isset($_POST["nIntento"]))
    $nIntento = (int)$_POST["nIntento"]+1;
else
    $nIntento=0;

//puntuación
if(isset($_POST["puntuacion"]))
    $puntuacion = (int)$_POST["puntuacion"] + 10*$nIntento + (int)abs($intento-$oculto);
else
    $puntuacion=0;

?>

<html>
<head>
    <title></title>

    <style>
        <?php
            if($oculto==$intento || $nIntento==$nIntentoMax)
                echo "#formulario{
                            display:none;
                            }";
         ?>

    </style>

</head>
<body>

<div id="formulario">
    <form method="post">
        <label> Jugador 2:
            <input type='number' name='intento' value="<?=$intento?>">
        </label>

        <input type='hidden' name="oculto" value="<?=$oculto?>">
        <input type='hidden' name="nIntento" value="<?=$nIntento?>">
        <input type='hidden' name="puntuacion" value="<?=$puntuacion?>">

        <input type="submit" value="Probar" name="probar">

        <br /><br />
    </form>
</div>

<?php
//Información en pantalla de menor, mayor, victoria, derrota y puntuacion
    if(isset($_POST["probar"])) {
        if ($oculto < $intento && $nIntento<$nIntentoMax)
            echo "<h3>El numero secreto es Menor ($distancia)</h3>";
        elseif ($oculto > $intento && $nIntento<$nIntentoMax)
            echo "<h3>El numero secreto es Mayor ($distancia)</h3>";
        elseif ($oculto!=$intento)
            echo "<h3 style='color:#ff0303'>Lo siento, has perdido, el número secreto era: $oculto</h3>";
        else {
            echo "<h3 style='color:#48f666'>Enhorabuena, has ganado</h3>";
            echo "<h3>Puntuación: $puntuacion</h3>";
        }
        echo "<h3>Intento: $nIntento (máx. $nIntentoMax)</h3>";
    }
?>


<a href=20-adivinar-inicio.php>Nuevo</a>

</body>
</html>
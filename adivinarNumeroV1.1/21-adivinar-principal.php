<?php
//Declaración de variables

//numero oculto del formulario 1
if(!isset($_POST["oculto"]))
    $oculto = (int)$_POST["numero"];
else
    $oculto = $_POST["oculto"];

//numero a probar por el jugador 2
if(!isset($_POST["intento"]))
    $intento = null;
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
    $puntuacion=null;


//ranking
if(!isset($_POST["rankPuntos"]))
    $rankPuntos = $_POST["rankPuntosInicio"];
else
    $rankPuntos = $_POST["rankPuntos"];
$insertarPuntuacion = false; //insertar en el ranking solo cuando haya victoria
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


        a:link {
            color: green;
        }
        a:visited {
            color: green;
        }
        a:hover {
            color: red;
        }
        a:active {
            color: yellow;
        }

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

        <input type='hidden' name="rankPuntos" value="<?=$rankPuntos?>">

        <?php
        /*foreach($rankPuntos as $value){
        echo '<input type="hidden" name="rankPuntos[]" value="'.$value.'">';
        }*/
        ?>

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
            $insertarPuntuacion = true;
        }
        echo "<h3>Intento: $nIntento (máx. $nIntentoMax)</h3>";
    }
?>

<?php
//hacemos push al array con la nueva puntuación y lo escribimos en la tabla
if($insertarPuntuacion) {
    $rankPuntos = explode(",", $rankPuntos);
    array_push($rankPuntos, "$puntuacion");
    sort($rankPuntos);

    echo "<table>";
    echo "<tr>";
    echo "<th> Ranking Puntuación </th>";
    echo "</tr>";
    echo "<tr>";
    echo "</tr>";
    foreach ($rankPuntos as $value) {
        echo "<tr> <td>" . $value . "</td> </tr>";
    }
    echo "</table>";

    $rankPuntos = implode(",", $rankPuntos);
}
?>

<a href=20-adivinar-inicio.php?rankPuntos=<?=$rankPuntos?>">Nuevo Juego</a><br>
<a href=20-adivinar-inicio.php>Resetear</a>

</body>
</html>
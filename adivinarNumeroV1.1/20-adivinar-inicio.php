<?php

    if(isset($_GET["rankPuntos"]))
        $rankPuntosInicio = $_GET["rankPuntos"];
    else {
        $rankPuntosInicio = array(null);
        $rankPuntosInicio = implode(",", $rankPuntosInicio);
    }

?>

<html>
<head>
    <title></title>

</head>
<body>

    <form action="21-adivinar-principal.php" method="post">
        <label> Jugador 1:
            <input type='number' name='numero'>
        </label>

        <input type='hidden' name="rankPuntosInicio" value="<?=$rankPuntosInicio?>">


        <input type='submit' value='Guardar Numero' name='guardar'>

        <br /><br />
    </form>

</body>
</html>


<?php

//Declaración de variables

$operando1 = (int)$_GET["operando1"];
$operando2 = (int)$_GET["operando2"];
$operacion = $_GET["operacion"];
$resultado = 0;
if($operando2==0)
    $errorDivCero = true;
else
    $errorDivCero=false;


//Operaciones

if($operacion=="sum")
    $resultado = $operando1+$operando2;
elseif($operacion=="res")
    $resultado = $operando1-$operando2;
elseif($operacion=="mul")
    $resultado = $operando1*$operando2;
else{
    if(!$errorDivCero)
        $resultado = $operando1 / $operando2;
    else
        $resultado = "Error, dividido entre cero";
}

?>

<html>
    <head>
        <title></title>

    </head>
    <body>



    <?php
    echo "<h3>Operación: $operando1 ($operacion) $operando2</h3>";
    echo "<h3>El resultado es: $resultado</h3>";
    ?>


    <a href=12a-calculadora-formulario.php>Nuevo</a>

    </body>
</html>

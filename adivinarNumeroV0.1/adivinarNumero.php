<?php

//Javier Mártinez- VIllanueva Fernández ENTORNO SERVIDOR

if(!isset($_GET["numero"])) //numero que mete el jugador 1
    $numero = 0;

if (!isset($_GET["oculto"])) //variable a la que se le pasa el valor de numero (hidden)
    $oculto = 0;


if(isset($_GET["guardado"])) //boolean para saber que se ha guardado el numero del jugador 1 y del jugador 2
    $guardado = $_GET["guardado"];
else
    $guardado = false;
if(isset($_GET["vuelve"])) {
    $guardado = false;
}

if(isset($_GET["adivinado"])) //boolean para saber cuando adivina el numero el jugador 2
    $adivinado = $_GET["adivinado"];
else
    $adivinado = false;

/*if (!isset($_GET["player"])) //jugador (hidden)
    $player = 0;*/


if(!$guardado && isset($_GET["guardar1"])) { //momento en el que se guarda el numero del jugador 1
    $oculto = (int)$_GET["numero"];
    $guardado = true;
}



if(!isset($_GET["numeroProbado"])) //numero que prueba el jugador 2
    $numeroProbado = 0;

$intentosMax = 10;
if (!isset($_GET["intentos"])) //numero de intentos del jugador 2 (hidden)
    $intentos = 0;

if (!isset($_GET["puntuacion"])) //puntuacion del jugador 2 (hidden)
    $puntuacion = 0;



/*if (!isset($_GET["puntos"])) //array de puntuaciones (hidden)
    $puntos[$player] = 0;*/

if(isset($_GET["guardar2"])) {  //momento en el que se guarda el numero que va a probar el jugador 2
    $numeroProbado = (int)$_GET["numeroProbado"];
    $oculto = (int)$_GET["oculto"];
    $guardado = true;
    $intentos = (int)$_GET["intentos"] + 1;
    $puntuacion = (int)$_GET["puntuacion"] + 10*$intentos + ($numeroProbado-$oculto)/2;
    //$puntos[$player] = $puntuacion;
}

if($numeroProbado==$oculto && isset($_GET["guardar2"])){ //comparacion para saber si se ha adivinado o no
    $adivinado = true;
}else {
    $adivinado = false;
}

?>




<html>

<head>


    <title></title>

    <style>
    <?php /*muestra y ocultación de los formularios según avanza el programa*/ ?>
            #volver{
                display:none;
            }

        <?php if($guardado){?>
                    #jugador1{
                        display:none;
                    }
                    #jugador2{
                        display:block;
                    }
        <?php } else if(!$guardado){?>
                    #jugador1{
                        display:block;
                    }
                    #jugador2{
                        display:none;
                    }
        <?php }
            if($adivinado || $intentos==$intentosMax){?>

                #jugador2{
                    display:none;
                }
                #volver{
                    display:block;
                }
                #derrota{
                    display:block;
                }
    }
        <?php }
            if(isset($_GET["vuelve"])){?>
                #volver{
                    display:none;
                }
                #derrota{
                    display:none;
                }
            <?php }?>

    </style>


</head>

<body>
    <div id="volver">
        <form method='get'>
            <input style="margin:10px" type='submit' value='Vuelve a Jugar' name='vuelve'>
        </form>
    </div>


    <div id="jugador1">
        <form method='get'>

            <label> Jugador 1:
                <input type='text' name='numero' value='<?=$numero?>'>
            </label>

            <input type="hidden" name="guardado" value="<?=$guardado?>">


            <input type='submit' value='Guardar Numero Oculto' name='guardar1'>

            <br /><br />

        </form>
    </div>

    <div id="jugador2">
        <form method='get'>

            <label> Jugador 2:
                <input type='text' name='numeroProbado' value='<?=$numeroProbado?>'>
            </label>

            <input type="hidden" name="oculto" value="<?=$oculto?>">

            <input type="hidden" name="adivinado" value="<?=$adivinado?>">

            <input type="hidden" name="intentos" value="<?=$intentos?>">

            <input type="hidden" name="puntuacion" value="<?=$puntuacion?>">

            <input type='submit' value='Probar Numero' name='guardar2'>

            <br /><br />

        </form>
    </div>



    <?php if(!$adivinado && !isset($_GET["guardar1"])){
            if($numeroProbado>$oculto && $intentos<$intentosMax){?>
                <h3>El numero secreto es menor que <?=$numeroProbado?></h3>
                    <?php if($numeroProbado-$oculto<50){?>
                        <h3>*</h3>
                    <?php
                        }if($numeroProbado-$oculto>50 && $numeroProbado-$oculto<100){?>
                        <h3>**</h3>
                    <?php
                        }if($numeroProbado-$oculto>100){?>
                        <h3>***</h3>
                    <?php
                        }?>
                <h4>Intentos: <?=$intentos?></h4>
            <?php
            }else if($numeroProbado<$oculto && $intentos<$intentosMax){ ?>
                <h3>El numero secreto es mayor que <?=$numeroProbado?></h3>
                    <?php if($oculto-$numeroProbado<50){?>
                        <h3>*</h3>
                    <?php
                        }if($oculto-$numeroProbado>50 && $oculto-$numeroProbado<100){?>
                        <h3>**</h3>
                    <?php
                        }if($oculto-$numeroProbado>100){?>
                        <h3>***</h3>
                    <?php
                        } ?>
                    <h4>Intentos: <?=$intentos?></h4>
            <?php
            }
    }else if($adivinado){?>
        <h3 style="color:#00ff19">Enhorabuena, has acertado el numero secreto: <?=$numeroProbado?></h3>
        <h4>Intentos: <?=$intentos?></h4>
        <h3>Puntuación: <?=$puntuacion?></h3>
    <?php } ?>

    <div id="derrota">
        <?php if($intentos==$intentosMax){?>
            <h3 style="color:#ff0000">Lo siento, has agotado tus intentos</h3>
            <h4>Intentos: <?=$intentos?></h4>
            <h3>Puntuación: <?=$puntuacion?></h3>
        <?php } ?>
    </div>

    <a href='<?= $_SERVER["PHP_SELF"] ?>'>Resetear</a>

</body>
</html>
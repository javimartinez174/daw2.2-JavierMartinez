<?php


?>

<html>
<head>
    <title></title>

</head>
<body>

<form action="12b-calculadora-resultado.php" method="get">
    Operando 1: <input type="number" name="operando1">
    <br><br>
    <select name="operacion">
        <option value="sum">Sumar+</option>
        <option value="res">Restar-</option>
        <option value="mul">Multiplicar*</option>
        <option value="div">Dividir/</option>
    </select>
    <br><br>
    Operando 2: <input type="number" name="operando2">
    <br><br>
    <input type="submit" name="operar" value="Operar">
    <br><br>
</form>



</body>
</html>

<?php

require_once "_com/DAO.php";

$categoriaId = $_REQUEST["id"];
$personasCategoria = DAO::personasObtenerPorCategoria($categoriaId);

?>

<html>

<head>
	<meta charset='UTF-8'>
</head>

<body>

<h2 id="titulo">Personas que pertenecen actualmente a la categoría: <?=DAO::categoriaObtenerPorId($categoriaId)->getNombre()?></h2>

<ul>
<?php
    foreach ($personasCategoria as $fila) {
        echo "<li>"."Nombre: ".$fila->getNombre()."<br>Teléfono: ".$fila->getTelefono()."</li><br>";
    }
?>
</ul>

<div id="modificarCategoria">
    <form id="formulario">
        <label for='nombreMod'>Modificar categoría</label>
        <input type='text' name='nombreMod' id='nombreMod' placeholder='<nombre de la categoría>' value='' />
        <input type='hidden' name='idMod' id='idMod' value='<?=$categoriaId?>' />
    </form>
    <button id="submitModificarCategoria">Modificar Categoria</button>
</div>

<br><br><a href="Agenda.html">¿Te redirecciono?</a>

<script>
    var categoriaNueva;

    window.onload = function () {
        submitModificarCategoria.addEventListener("click", modificarCategoria, false);
    }

    function modificarCategoria(){
        var newCategoria = document.getElementById("nombreMod").value;
        var newCategoriaId = document.getElementById("idMod").value;
        if(newCategoria!="") {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    categoriaNueva = JSON.parse(this.responseText);
                    document.getElementById("nombreMod").value = "";
                    document.getElementById("titulo").innerHTML = "Personas que pertenecen actualmente a la categoría: "+categoriaNueva.nombre;
                }
            };
            xhttp.open("GET", "CategoriaModificar.php?id=" + newCategoriaId + "&&nombre=" + newCategoria, true);
            xhttp.send();
        }else{}
    }
</script>
</body>

</html>
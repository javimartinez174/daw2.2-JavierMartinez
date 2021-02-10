var categoriasJson; // varible global con el objeto JSON una vez leído

window.onload = function () {
    cargarJson();
    setTimeout(crearTablaCategorias, 100); // hay que meter delay para cargar categoriasJson
    //mostrarCategorias.addEventListener("click", crearTablaCategorias, false);

    submitCrearCategoria.addEventListener("click", crearCategoria, false);
}

function cargarJson() { // leemos las categorias y las cargamos en categoriasJson
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            categoriasJson = JSON.parse(this.responseText);
        }
    };
    xhttp.open("GET", "CategoriaObtenerTodas.php", true);
    xhttp.send();
}

function crearCategoria(){
    var newCategoria = document.getElementById("nombre").value;
    if(newCategoria!="") {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                categoriasJson = JSON.parse(this.responseText);
                crearTablaCategorias();
                document.getElementById("nombre").value = "";
            }
        };
        xhttp.open("GET", "CategoriaCrear.php?nombre=" + newCategoria, true);
        xhttp.send();
    }else{}
}

function eliminarCategoria(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            categoriasJson = JSON.parse(this.responseText);
            crearTablaCategorias();
        }
    };
    xhttp.open("GET", "CategoriaEliminar.php?id=" + this.id, true);
    xhttp.send();
}

function crearTablaCategorias() { // creamos una tabla y la rellenamos con las categorias obtenidas en categoriasJson
    document.getElementById("tablaCategorias").innerHTML = ""; // limpiamos el div donde se crea la tabla

    var br = document.createElement("BR");
    document.getElementById("tablaCategorias").appendChild(br);

    var tabla = document.createElement("TABLE");
    tabla.setAttribute("id", "miTabla");
    tabla.setAttribute("style", "border: 1px solid black");
    document.getElementById("tablaCategorias").appendChild(tabla);

    var tr = document.createElement("TR");
    tr.setAttribute("id", "miTr");
    document.getElementById("miTabla").appendChild(tr);

    var td1 = document.createElement("TH");
    var text = document.createTextNode("ID");
    td1.appendChild(text);
    document.getElementById("miTabla").appendChild(td1);

    var td2 = document.createElement("TH");
    var text = document.createTextNode("NOMBRE");
    td2.appendChild(text);
    document.getElementById("miTabla").appendChild(td2);

    for (var i = 0; i < categoriasJson.length; i++) {
        var tr = document.createElement("TR");
        tr.setAttribute("id", "miTr");
        document.getElementById("miTabla").appendChild(tr);

        var td = document.createElement("TD");
        var text = document.createTextNode(categoriasJson[i].id);
        td.appendChild(text);
        document.getElementById("miTabla").appendChild(td);

        var td = document.createElement("TD");
        var a = document.createElement("a");
        a.setAttribute("href","CategoriaFicha.php?id=" + categoriasJson[i].id);
        var text = document.createTextNode(categoriasJson[i].nombre);
        a.appendChild(text);
        td.appendChild(a);
        document.getElementById("miTabla").appendChild(td);

        var td = document.createElement("TD");
        var button = document.createElement("button");
        button.setAttribute("id",""+categoriasJson[i].id);
        var text = document.createTextNode("ELIMINAR");
        button.appendChild(text);
        td.appendChild(button);
        document.getElementById("miTabla").appendChild(td);
    }
    // funcionalidad botones de borrar, hay que dársela cada vez que se crea la tabla
    var botones = document.getElementById("miTabla").getElementsByTagName("button");
    for(var i=0; i<botones.length; i++){
        botones[i].addEventListener("click", eliminarCategoria, false);
    }

    var br = document.createElement("BR");
    document.getElementById("tablaCategorias").appendChild(br);

}




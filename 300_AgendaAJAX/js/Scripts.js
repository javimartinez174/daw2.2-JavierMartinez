
cambiaContenido.addEventListener("click", cambiarContenido, false);

function cambiarContenido(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cargaXML(this.responseText);
        }
    };
    xhttp.open("GET", "CategoriaObtenerTodas.php", true);
    xhttp.send();

}

function cargaXML(xml){
    var x = JSON.parse(xml);

    var tabla = document.createElement("TABLE");
    tabla.setAttribute("id", "miTabla");
    tabla.setAttribute("style", "border: 1px solid black");
    document.getElementById("aqui").appendChild(tabla);

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

    for(var i = 0; i < x.length; i++){

        var tr = document.createElement("TR");
        tr.setAttribute("id", "miTr");
        document.getElementById("miTabla").appendChild(tr);

        var td = document.createElement("TD");
        var text = document.createTextNode(x[i].id);
        td.appendChild(text);
        document.getElementById("miTabla").appendChild(td);

        var td = document.createElement("TD");
        var text = document.createTextNode(x[i].nombre);
        td.appendChild(text);
        document.getElementById("miTabla").appendChild(td);
    }
}


function mostrarInputsBusqueda(){
    getSelectValue = document.getElementById("busqueda").value;
    if(getSelectValue=="titulo"){
        document.getElementById("nombre").style.display = "inline-block";
        document.getElementById("genero").style.display = "none";
        document.getElementById("puntuacion").style.display = "none";
    }else if(getSelectValue=="genero"){
        document.getElementById("nombre").style.display = "none";
        document.getElementById("genero").style.display = "inline-block";
        document.getElementById("puntuacion").style.display = "none";
    }else if(getSelectValue=="puntuacion"){
        document.getElementById("nombre").style.display = "none";
        document.getElementById("genero").style.display = "none";
        document.getElementById("puntuacion").style.display = "inline-block";
    }
}
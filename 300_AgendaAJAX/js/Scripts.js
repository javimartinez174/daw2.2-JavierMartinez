


// TODO Quedaría pendiente poner un timer para actualizar lo local si actualizan el servidor. Una solución óptima sería poner timestamp de modificación en la tabla y pedir categoriaObtenerModificadasDesde(timestamp), donde timestamp es la última vez que he pedido algo.



window.onload = inicializar;

var divCategoriasDatos;
var inputCategoriaNombre;
var divPersonasDatos;
var inputPersonaNombre;
var inputPersonaApellidos;
var inputPersonaTelefono;
var inputPersonaEstrella;
var inputPersonaCategoriaId;


// ---------- VARIOS DE BASE/UTILIDADES ----------

function notificarUsuario(texto) {
    // TODO En lugar del alert, habría que añadir una línea en una zona de notificaciones, arriba, con un temporizador para que se borre solo en ¿5? segundos.
    alert(texto);
}

function llamadaAjax(url, parametros, manejadorOK, manejadorError) {
    //TODO PARA DEPURACIÓN: alert("Haciendo ajax a " + url + "\nCon parámetros " + parametros);

    var request = new XMLHttpRequest();

    request.open("POST", url);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function() {
        if (this.readyState == 4 && request.status == 200) {
            manejadorOK(request.responseText);
        }
        if (manejadorError != null && request.readyState == 4 && this.status != 200) {
            manejadorError(request.responseText);
        }
    };

    request.send(parametros);
}

function extraerId(texto) {
    return texto.split('-')[1];
}

function objetoAParametrosParaRequest(objeto) {
    // Esto convierte un objeto JS en un listado de clave1=valor1&clave2=valor2&clave3=valor3
    return new URLSearchParams(objeto).toString();
}

function debug() {
    // Esto es útil durante el desarrollo para programar el disparado de acciones concretas mediante un simple botón.
}



// ---------- MANEJADORES DE EVENTOS / COMUNICACIÓN CON PHP ----------

function inicializar() {
    divCategoriasDatos = document.getElementById("categoriasDatos");
    inputCategoriaNombre = document.getElementById("categoriaNombre");

    document.getElementById('btnCategoriaCrear').addEventListener('click', clickCategoriaCrear);

    llamadaAjax("CategoriaObtenerTodas.php", "",
        function(texto) {
            var categorias = JSON.parse(texto);

            for (var i=0; i<categorias.length; i++) {
                // No se fuerza la ordenación, ya que PHP nos habrá dado los elementos en orden correcto y sería una pérdida de tiempo.
                domCategoriaInsertar(categorias[i], false);
            }
        }
    );

    divPersonasDatos = document.getElementById("personasDatos");
    inputPersonaNombre = document.getElementById("personaNombre");
    inputPersonaApellidos = document.getElementById("personaApellidos");
    inputPersonaTelefono = document.getElementById("personaTelefono");
    inputPersonaEstrella = document.getElementById("personaEstrella");
    inputPersonaCategoriaId = document.getElementById("personaCategoriaId");

    document.getElementById('btnPersonaCrear').addEventListener('click', clickPersonaCrear);

    llamadaAjax("PersonaObtenerTodas.php", "",
        function(texto) {
            var personas = JSON.parse(texto);

            for (var i=0; i<personas.length; i++) {
                // No se fuerza la ordenación, ya que PHP nos habrá dado los elementos en orden correcto y sería una pérdida de tiempo.
                domPersonaInsertar(personas[i], false);
            }
        }
    );
}

function clickCategoriaCrear() {
    inputCategoriaNombre.disabled = true;

    llamadaAjax("CategoriaCrear.php", "nombre=" + inputCategoriaNombre.value,
        function(texto) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var categoria = JSON.parse(texto);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            domCategoriaInsertar(categoria, true);

            inputCategoriaNombre.value = "";
            inputCategoriaNombre.disabled = false;
        },
        function(texto) {
            notificarUsuario("Error Ajax al crear: " + texto);
            inputCategoriaNombre.disabled = false;
        }
    );
}

function clickPersonaCrear() {
    inputPersonaNombre.disabled = true;
    inputPersonaApellidos.disabled = true;
    inputPersonaTelefono.disabled = true;
    inputPersonaEstrella.disabled = true;
    inputPersonaCategoriaId.disabled = true;

    llamadaAjax("PersonaCrear.php", "nombre=" + inputPersonaNombre.value+"&&apellidos="+inputPersonaApellidos.value+"&&telefono="+inputPersonaTelefono.value+"&&estrella="+parseInt(inputPersonaEstrella.value)+"&&categoriaId="+parseInt(inputPersonaCategoriaId.value),
        function(texto) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var persona = JSON.parse(texto);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            domPersonaInsertar(persona, true);

            inputPersonaNombre.value = "";
            inputPersonaNombre.disabled = false;
            inputPersonaApellidos.value = "";
            inputPersonaApellidos.disabled = false;
            inputPersonaTelefono.value = "";
            inputPersonaTelefono.disabled = false;
            inputPersonaEstrella.value = "";
            inputPersonaEstrella.disabled = false;
            inputPersonaCategoriaId.value = "";
            inputPersonaCategoriaId.disabled = false;

        },
        function(texto) {
            notificarUsuario("Error Ajax al crear: " + texto);
            inputPersonaNombre.disabled = false;

        }
    );
}


function blurPersonaModificar(input) {
    let divPersona = input.parentElement.parentElement;
    let id = extraerId(divPersona.id);
    let nombre = document.getElementById("nombreInput"+id).value;
    let apellidos = document.getElementById("apellidosInput"+id).value;
    let telefono = document.getElementById("telefonoInput"+id).value;
    let categoriaId = document.getElementById("categoriaIdInput"+id).value;

    let Persona = { "id":  id, "nombre": nombre, "apellidos": apellidos, "telefono": telefono, "categoriaId": categoriaId};

    llamadaAjax("PersonaActualizar.php", objetoAParametrosParaRequest(Persona),
        function(texto) {
            if (texto != "null") {
                // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
                Persona = JSON.parse(texto);
                domPersonaModificar(Persona);
            } else {
                alert("Error Ajax al modificar: " + texto);
            }
        },
        function(texto) {
            alert("Error Ajax al modificar: " + texto);
        }
    );
}

function clickPersonaEliminar(id) {
    llamadaAjax("PersonaEliminar.php", "id="+id,
        function(texto) {
            var Persona = JSON.parse(texto);
            domPersonaEliminar(id);
        },
        function(texto) {
            alert("Error Ajax al eliminar: " + texto);
        }
    );
}

function blurCategoriaModificar(input) {
    let divCategoria = input.parentElement.parentElement;
    let id = extraerId(divCategoria.id);
    let nombre = input.value;

    let categoria = { "id":  id, "nombre": nombre};

    llamadaAjax("CategoriaActualizar.php", objetoAParametrosParaRequest(categoria),
        function(texto) {
            if (texto != "null") {
                // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
                categoria = JSON.parse(texto);
                domCategoriaModificar(categoria);
            } else {
                alert("Error Ajax al modificar: " + texto);
            }
        },
        function(texto) {
            alert("Error Ajax al modificar: " + texto);
        }
    );
}

function clickCategoriaEliminar(id) {
    llamadaAjax("CategoriaEliminar.php", "id="+id,
        function(texto) {
            var Categoria = JSON.parse(texto);
            domCategoriaEliminar(id);
        },
        function(texto) {
            alert("Error Ajax al eliminar: " + texto);
        }
    );
}




// ---------- GESTIÓN DEL DOM CATEGORIAS----------

function domCategoriaCrearDiv(categoria) {
    let nombreInput = document.createElement("input");
    nombreInput.setAttribute("type", "text");
    nombreInput.setAttribute("value", categoria.nombre);
    nombreInput.setAttribute("onblur", "blurCategoriaModificar(this); return false;");
    let nombreDiv = document.createElement("div");
    nombreDiv.appendChild(nombreInput);

    let eliminarImg = document.createElement("img");
    eliminarImg.setAttribute("src", "img/Eliminar.png");
    eliminarImg.setAttribute("onclick", "clickCategoriaEliminar(" + categoria.id + "); return false;");
    let eliminarDiv = document.createElement("div");
    eliminarDiv.appendChild(eliminarImg);

    let divCategoria = document.createElement("div");
    divCategoria.setAttribute("id", "categoria-" + categoria.id);
    divCategoria.appendChild(nombreDiv);
    divCategoria.appendChild(eliminarDiv);

    return divCategoria;
}

function domCategoriaObtenerDiv(pos) {
    let div = divCategoriasDatos.children[pos];
    return div;
}

function domCategoriaObtenerObjeto(pos) {
    let divCategoria = domCategoriaObtenerDiv(pos);
    let divNombre = divCategoria.children[0];
    let input = divNombre.children[0];

    return { "id":  extraerId(divCategoria.id), "nombre": input.value}; // Devolvemos un objeto recién creado con los datos que hemos obtenido.
}

function domCategoriaEjecutarInsercion(pos, categoria) {
    let divReferencia = domCategoriaObtenerDiv(pos);
    let divNuevo = domCategoriaCrearDiv(categoria);

    divCategoriasDatos.insertBefore(divNuevo, divReferencia);
}

function domCategoriaInsertar(categoriaNueva, enOrden=false) {
    // Si piden insertar en orden, se buscará su lugar. Si no, irá al final.
    if (enOrden) {
        for (let pos = 0; pos < divCategoriasDatos.children.length; pos++) {
            let categoriaActual = domCategoriaObtenerObjeto(pos);

            if (categoriaNueva.nombre.localeCompare(categoriaActual.nombre) == -1) {
                // Si la categoría nueva va ANTES que la actual, este es el punto en el que insertarla.
                domCategoriaEjecutarInsercion(pos, categoriaNueva);
                return;
            }
        }
    }

    domCategoriaEjecutarInsercion(divCategoriasDatos.children.length, categoriaNueva);
}

function domCategoriaLocalizarPosicion(id) {
    var trs = divCategoriasDatos.children;

    for (var pos=0; pos < divCategoriasDatos.children.length; pos++) {
        let categoriaActual = domCategoriaObtenerObjeto(pos);

        if (categoriaActual.id == id) return (pos);
    }

    return -1;
}

function domCategoriaEliminar(id) {
    domCategoriaObtenerDiv(domCategoriaLocalizarPosicion(id)).remove();
}

function domCategoriaModificar(categoria) {
    domCategoriaEliminar(categoria.id);

    // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
    domCategoriaInsertar(categoria, true);
}


// ---------- GESTIÓN DEL DOM PERSONAS----------

function domPersonaCrearDiv(persona) {
    let nombreInput = document.createElement("input");
    nombreInput.setAttribute("type", "text");
    nombreInput.setAttribute("id", "nombreInput"+persona.id);
    nombreInput.setAttribute("value", persona.nombre);
    nombreInput.setAttribute("onblur", "blurPersonaModificar(this); return false;");
    let nombreDiv = document.createElement("div");
    nombreDiv.appendChild(nombreInput);

    let apellidosInput = document.createElement("input");
    apellidosInput.setAttribute("type", "text");
    apellidosInput.setAttribute("id", "apellidosInput"+persona.id);
    apellidosInput.setAttribute("value", persona.apellidos);
    apellidosInput.setAttribute("onblur", "blurPersonaModificar(this); return false;");
    let apellidosDiv = document.createElement("div");
    apellidosDiv.appendChild(apellidosInput);

    let telefonoInput = document.createElement("input");
    telefonoInput.setAttribute("type", "text");
    telefonoInput.setAttribute("id", "telefonoInput"+persona.id);
    telefonoInput.setAttribute("value", persona.telefono);
    telefonoInput.setAttribute("onblur", "blurPersonaModificar(this); return false;");
    let telefonoDiv = document.createElement("div");
    telefonoDiv.appendChild(telefonoInput);

    let estrellaInput = document.createElement("input");
    estrellaInput.setAttribute("type", "text");
    estrellaInput.setAttribute("id", "estrellaInput"+persona.id);
    estrellaInput.setAttribute("value", persona.estrella);
    estrellaInput.setAttribute("onblur", "blurPersonaModificar(this); return false;");
    let estrellaDiv = document.createElement("div");
    estrellaDiv.appendChild(estrellaInput);

    let categoriaIdInput = document.createElement("input");
    categoriaIdInput.setAttribute("type", "text");
    categoriaIdInput.setAttribute("id", "categoriaIdInput"+persona.id);
    categoriaIdInput.setAttribute("value", persona.categoriaId);
    categoriaIdInput.setAttribute("onblur", "blurPersonaModificar(this); return false;");
    let categoriaIdDiv = document.createElement("div");
    categoriaIdDiv.appendChild(categoriaIdInput);

    let eliminarImg = document.createElement("img");
    eliminarImg.setAttribute("src", "img/Eliminar.png");
    eliminarImg.setAttribute("onclick", "clickPersonaEliminar(" + persona.id + "); return false;");
    let eliminarDiv = document.createElement("div");
    eliminarDiv.appendChild(eliminarImg);

    let divPersona = document.createElement("div");
    divPersona.setAttribute("id", "Persona-" + persona.id);
    divPersona.appendChild(nombreDiv);
    divPersona.appendChild(apellidosDiv);
    divPersona.appendChild(telefonoDiv);
    divPersona.appendChild(estrellaDiv);
    divPersona.appendChild(categoriaIdDiv);
    divPersona.appendChild(eliminarDiv);

    return divPersona;
}

function domPersonaObtenerDiv(pos) {
    let div = divPersonasDatos.children[pos];
    return div;
}

function domPersonaObtenerObjeto(pos) {
    let divPersona = domPersonaObtenerDiv(pos);
    let divNombre = divPersona.children[0];
    let input = divNombre.children[0];

    return { "id":  extraerId(divPersona.id), "nombre": input.value}; // Devolvemos un objeto recién creado con los datos que hemos obtenido.
}

function domPersonaEjecutarInsercion(pos, persona) {
    let divReferencia = domPersonaObtenerDiv(pos);
    let divNuevo = domPersonaCrearDiv(persona);

    divPersonasDatos.insertBefore(divNuevo, divReferencia);
}

function domPersonaInsertar(personaNueva, enOrden=false) {
    // Si piden insertar en orden, se buscará su lugar. Si no, irá al final.
    if (enOrden) {
        for (let pos = 0; pos < divPersonasDatos.children.length; pos++) {
            let personaActual = domPersonaObtenerObjeto(pos);

            if (personaNueva.nombre.localeCompare(personaActual.nombre) == -1) {
                // Si la categoría nueva va ANTES que la actual, este es el punto en el que insertarla.
                domPersonaEjecutarInsercion(pos, personaNueva);
                return;
            }
        }
    }

    domPersonaEjecutarInsercion(divPersonasDatos.children.length, personaNueva);
}

function domPersonaLocalizarPosicion(id) {
    var trs = divPersonasDatos.children;

    for (var pos=0; pos < divPersonasDatos.children.length; pos++) {
        let personaActual = domPersonaObtenerObjeto(pos);

        if (personaActual.id == id) return (pos);
    }

    return -1;
}

function domPersonaEliminar(id) {
    domPersonaObtenerDiv(domPersonaLocalizarPosicion(id)).remove();
}

function domPersonaModificar(persona) {
    domPersonaEliminar(persona.id);

    // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
    domPersonaInsertar(persona, true);
}



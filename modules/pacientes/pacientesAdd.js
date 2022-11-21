var apellido = document.getElementById("apellido");
var nombre = document.getElementById("nombre");
var error = document.getElementById("error");
error.style.color = "red";

function enviarFormulario() {
    console.log("enviando formulario");

    var mensajesError = [];

    if(apellido.value === null || apellido.value === '') {
        mensajesError.push("el campo APELLIDO no puede quedar vacio");
    }

    if(nombre.value === null || nombre.value === '') {
        mensajesError.push("el campo NOMBRE no puede quedar vacio");
    }

    // convertimos el arreglo a una cadena de texto
    error.innerHTML = mensajesError.join(", ");

    return false;
}
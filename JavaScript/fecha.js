// Función para mostrar el mensaje según la opción seleccionada y la fecha límite
function mostrarMensaje() {
  var cargoSeleccionado = document.getElementById("cargo").value;
  var messageContainer = document.getElementById("message-container");

  var fechaA = new Date();

  // Obtener el día, mes y año por separado
  var dia = fechaA.getDate();
  var mes = fechaA.getMonth() + 1; // Los meses se numeran del 0 al 11, sumamos 1
  var anio = fechaA.getFullYear();

  // Crear una cadena con el formato deseado (en este caso, DD/MM/YYYY)
  var fechaFormateada = dia + '/' + mes + '/' + anio;

  if (cargoSeleccionado !== "") {
    messageContainer.textContent = "El cargo: " + cargoSeleccionado + ". esta habilitado hasta." + fechaFormateada;
  } else {
    messageContainer.textContent = "Por favor, seleccione un cargo.";
  }
}

// Verificar fecha límite y deshabilitar opciones si es necesario
document.addEventListener("DOMContentLoaded", function () {
  var opciones = document.getElementById("cargo").options;
  var fechaActual = new Date();

  for (var i = 0; i < opciones.length; i++) {
    var fechaLimite = new Date(opciones[i].getAttribute("data-fechalimite"));

    if (fechaActual > fechaLimite) {
      opciones[i].disabled = true;
    }
  }
});

// Asignar la función al evento de cambio del select
document.getElementById("cargo").addEventListener("change", mostrarMensaje);
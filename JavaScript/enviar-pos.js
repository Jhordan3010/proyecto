 // Obtener el valor almacenado en localStorage
 var valorRecibido = localStorage.getItem('valorCompartido');

 // Mostrar el valor en el segundo input
 document.getElementById('username').value = valorRecibido;
<?php
$registroExitoso = false;  // Bandera de registro exitoso
$registroHabilitado = true;  // Bandera para habilitar/deshabilitar el registro

// Fecha límite para postulaciones (formato: "YYYY-MM-DD")
$fechaLimite = "2024-01-15";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $registroHabilitado) {
    // Procesar y validar datos del formulario
    
    // Obtener la fecha actual
    $fechaActual = date("Y-m-d");

    // Verificar si la fecha actual es antes o igual a la fecha límite
    if (strtotime($fechaActual) <= strtotime($fechaLimite)) {
        // La fecha actual está dentro del plazo, establecer la bandera
        $registroExitoso = true;
    } else {
        // La fecha límite ha pasado, deshabilitar el registro
        $registroHabilitado = false;
    }
}

// Mostrar mensaje de éxito si la bandera está establecida
if ($registroExitoso) {
    echo "Registro exitoso. ¡Gracias por postularte!";
} elseif (!$registroHabilitado) {
    echo "El plazo para postulaciones ha expirado. Ya no se aceptan más postulaciones.";
} else {
    // Mostrar el formulario de postulación
    // ...
}
?>
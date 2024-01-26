<?php
// Asegurarse de que las carpetas existan
$carpetas = ['../pdf/cv', '../pdf/cedulas', '../pdf/estudios_postulante'];

foreach ($carpetas as $carpeta) {
    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777, true);  // Crear la carpeta con permisos 0777
    }
}
$permisos = 0777;

foreach ($carpetas as $carpeta) {
    if (is_dir($carpeta)) {
        chmod($carpeta, $permisos);
    }
}
?>

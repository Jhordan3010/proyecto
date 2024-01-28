
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["tipo"]) && isset($_GET["id"])) {
    $tipo = $_GET["tipo"];
    $id_postulante = $_GET["id"];

    // Obtener la ruta del archivo PDF según el tipo
    $pdfFolder = "../pdf/";
    $ruta = '';

    switch ($tipo) {
        case 'cv':
            $ruta = $pdfFolder . "cv/cv_{$id_postulante}.pdf";
            break;
        case 'cedula':
            $ruta = $pdfFolder . "cedulas/cedula_{$id_postulante}.pdf";
            break;
        case 'estudios':
            $ruta = $pdfFolder . "estudios_postulante/estudios_{$id_postulante}.pdf";
            break;
        default:
            echo "Tipo de PDF no válido.";
            exit;
    }

    // Verificar si el archivo existe
    if (file_exists($ruta)) {
        // Mostrar el PDF en una nueva ventana
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $ruta . '"');
        readfile($ruta);
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "Solicitud no válida.";
}
?>

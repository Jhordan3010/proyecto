<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CI = $_POST['CI'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $cargo = $_POST['cargo'];
    $sueldo = $_POST['sueldo'];

    // Conectar a la base de datos
    $servername = 'localhost';
    $username = 'Jhordan';
    $password = '123456789';
    $dbname = 'midb_Proyecto';
    $port = 3306;
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión a base de datos falló: " . $conn->connect_error);
    }

    // Actualizar los datos en la base de datos
    $sql = "UPDATE persona SET nombre='$nombre', apellido='$apellido', direccion='$direccion', telefono='$telefono', email='$email', cargo='$cargo', sueldo='$sueldo' WHERE CI='$CI'";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la lista de empleados después de la actualización
        header('Location: listaempledos.php');
        exit; // Asegura que el script se detenga después de redirigir
    } else {
        echo "Error al actualizar: " . $conn->error;
    }

    $conn->close();
}
?>

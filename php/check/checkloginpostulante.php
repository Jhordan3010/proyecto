<?php
session_start();

function conectar($dbname) {
    $servername = 'localhost';
    $username = 'Jhordan';
    $password = '123456789';
    $port = 3306;
    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    // Chequear si no hubo error en la conexión
    if ($conn->connect_error) {
        die("Conexión a base de datos falló: " . $conn->connect_error);
    }
    return $conn;
}

// Conectarse al servidor y abrir la base de datos
$conn = conectar("midb_proyecto");

// Tomar los datos ingresados en el input
$input_username = $_POST['username'];
$input_password = $_POST['password'];

// Consultar si el Usuario existe en la tabla de usuarios
$sql = "SELECT * FROM usuario WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $input_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Comparar la contraseña almacenada en la base de datos con la proporcionada en el formulario
    if (password_verify($input_password, $row['passwd'])) {
        $_SESSION['username'] = $input_username;
        header("location: ../perfil.php");
        exit();
    } else {
        print '<script>alert("Contraseña Incorrecta!");</script>';
        print '<script>window.location.assign("../login.php");</script>';
    }
} else {
    print '<script>alert("Nombre de Usuario Incorrecto!");</script>';
    print '<script>window.location.assign("../login.php");</script>';
}

$conn->close();
?>

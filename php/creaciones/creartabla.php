<?php
$servername = 'localhost';
$username = 'Jhordan';
$password = '123456789';
$dbname = 'midb_proyecto';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Sentencia SQL para crear la tabla
$sql = "CREATE TABLE evaluacion_general (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Desempeño VARCHAR(255),
    comportamiento  VARCHAR(255),
    pregunta3 VARCHAR(255),
    pregunta4 VARCHAR(255),
    pregunta5 VARCHAR(255)
)";

// Intentar ejecutar la sentencia SQL
if ($conn->query($sql) === TRUE) {
    echo "Tabla creada exitosamente";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

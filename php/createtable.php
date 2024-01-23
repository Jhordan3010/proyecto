<?php
    // ----------------- con Orientación a Objetos -------- */
    // variables de entorno
    $user = 'Jhordan';
    $password = '123456789';
    $host = 'localhost';
    $port = 3306;
    $db = 'miDB_Proyecto';

     
    $conn = new mysqli($host, $user, $password, $db, $port);
    // Check connection
    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        }

    // SQL para crear tabla 
    CREATE TABLE evaluar_empleado (
        id_evaluacion INT AUTO_INCREMENT PRIMARY KEY,
        id_empleado INT,
        desempeno ENUM('Malo', 'Bueno', 'Excelente'),
        comportamiento ENUM('Malo', 'Bueno', 'Excelente'),
        adaptabilidad ENUM('Malo', 'Bueno', 'Excelente'),
        FOREIGN KEY (id_empleado) REFERENCES empleado(id_empleado)
    );
    
    if ($conn->query($sql1) === TRUE) {
        echo "Tabla Usuarios creada satisfactoriamente";
    } else {
        echo "Error en creación de tabla: " . $conn->error;
    }

    // Cerra Conexión
    $sql1->free();
    $conn->close();
?>
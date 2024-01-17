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
    $sql1 = "CREATE TABLE Persona (
        CI VARCHAR(30) NOT NULL PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL,
        apellido VARCHAR(50) NOT NULL,
        direccion VARCHAR(25) NOT NULL,
        telefono VARCHAR(10) NOT NULL,
        email VARCHAR(10) ,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
    
    if ($conn->query($sql1) === TRUE) {
        echo "Tabla Usuarios creada satisfactoriamente";
    } else {
        echo "Error en creación de tabla: " . $conn->error;
    }

    // Cerra Conexión
    $sql1->free();
    $conn->close();
?>
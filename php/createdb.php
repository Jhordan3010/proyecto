<?php
    // ----------------- con Orientación a Objetos -------- */
    // variables de entorno
    $user = 'Jhordan';
    $password = '123456789';
    $host = 'localhost';
    $port = 3306;

    // Create connection
    /*$conn = mysql_connect(
        "$host:$port", 
        $user, 
        $password
    );*/
    $conn = new mysqli($host, $user, $password, "", $port);
    // Check connection
    if ($conn->connect_errno) {
        die("Conexión fallada: " . $conn->connect_error);
        }

    // Crear database
    $sql = "CREATE DATABASE miDB_Proyecto";
    if ($conn->query($sql) === TRUE) {
            echo "Database creada satisfactoriamente";
        } else {
            echo "Error en creación de database: " . $conn->error;
        }
    // Cerra Conexión
    //$sql->free();
    $conn->close();
?>
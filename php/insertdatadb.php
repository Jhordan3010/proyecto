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

    // SQL para insertar elementos a Personas
    $sql2 = "INSERT INTO persona(CI,apellido,nombre,direccion,telefono, email) 
            VALUES ('1002003001','Huera','Jhordan','Ibarra','099054678','jmhn@gmail.com');";
    

    if ($conn->query($sql2) === TRUE) {
        echo "Nuevo registro creado satisfactoriamente en la Tabla Usuarios";
    } else {
        echo "Error de inserción de registro:" . $sql2 . "<br>" . $conn->error;
    }

    // SQL para insertar elementos a USUARIOS
    // $sql3 = "INSERT INTO `usuarios`(`email`, `username`, `contraseña`, `PersonID`) 
    // VALUES ('pdg@utn.edu.ec','pdg','pdg','2');";
    
    
    // if ($conn->query($sql3) === TRUE) {
    //     echo "Nuevo registro creado satisfactoriamente";
    // } else {
    //     echo "Error: " . $sql3 . "<br>" . $conn->error;
    // }

    // SQL Seleccionar base de datos creada
    //$db_selected = mysql_select_db($db, $conn);

    // Cerra Conexión
    
    $conn->close(); 
?>
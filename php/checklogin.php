<?php
    session_start();

    function conectar ($dbname){
        $servername = 'localhost';
	    $username = 'Jhordan';
	    $password = '123456789';
	    $port = 3306;
	    // Crear la conexión 
	    $conn = new mysqli($servername, $username, $password, $dbname, $port);
	    // Chequear si no hubo error en la conexión
        if ($conn->connect_error) {
            die("Conexión a base de datos fallo: " . $conn->connect_error);
            }
        return $conn;
        }

    // Conectarse al servidor y abrir la base de datos  
    $conn = conectar ("midb_Proyecto"); 
   
    // tomar los datos ingresador en el input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultar si el Usuario existe en la tabla de usuarios
    $sql = "Select * from administrador WHERE username='$username';";
    $query = $conn->query($sql);
 
    $user = "";
    $passw = "";
    if ($query->num_rows > 0) { // Comprobar si existe el nombre de usuario 
        // datos de salida de cada fila de la tabla
        while($row = $query->fetch_assoc()) // mostrar todas las filas de la consulta 
        {
            $user = $row['username'];       //la primera fila de nombre de usuario es
            $passw = $row['passwd'];      // pasado a $user, y a $passw
                                            // y así sucesivamente hasta que finalice la consulta 
            if(($username == $user) && ($password == $passw)) // comprobar si hay campos coincidentes 
            {
                $_SESSION['user'] = $username;    // establecer el nombre de usuario en una sesión.
                                                  // Esto sirve como variable global 
                header("location: ../html/menu.html");    // redirige al usuario autenticado
                                                  // a la página de inicio 
            }
            else
            {
                Print '<script>alert("Contraseña Incorrecta!");</script>';        // Prompts a usuario
                Print '<script>window.location.assign("../html/loginAdmin.html");</script>';    // redirige a página login.php
            }
        }
    }
    else {
        Print '<script>alert("Nombre de Usuario Incorrecto!");</script>';   // Prompts a usuario
        Print '<script>window.location.assign("../html/loginAdmin.html");</script>';      // redirige a página login.php
        }
    $conn->close();
?>
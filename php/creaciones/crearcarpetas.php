<?php
  function conectar($dbname) {
        $servername = 'localhost';
        $username = 'Jhordan';
        $password = '123456789';
        $port = 3306;

        $conn = new mysqli($servername, $username, $password, $dbname, $port);

        if ($conn->connect_error) {
            die("Conexión a base de datos falló: " . $conn->connect_error);
        }

        return $conn;
    }
   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $CI = $_POST['CI'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];

    // Conectar a la base de datos
    $conn = conectar("midbd_Proyecto");

    if ($conn->connect_error) {
        die("Conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Verificar si la cédula ya está registrada
    $sql_verificar_cedula = "SELECT id_persona FROM personas WHERE CI = '$CI'";
    $result_verificar_cedula = $conn->query($sql_verificar_cedula);

    if ($result_verificar_cedula === FALSE) {
        die("Error al ejecutar la consulta: " . $conn->error);
    }

    if ($result_verificar_cedula->num_rows > 0) {
        echo "La cédula ya está registrada en la base de datos.";
    } else {
        // La cédula no está registrada, proceder con la inserción

        // Insertar datos en la tabla "personas"
        $sql_personas = "INSERT INTO personas (CI, nombre, apellido, direccion, telefono, email) 
                         VALUES ('$CI', '$nombre', '$apellido', '$direccion', '$telefono', '$correo')";

        if ($conn->query($sql_personas) === TRUE) {
            $id_persona = $conn->insert_id;

            // Obtener nombres de archivos
            $cv = $_FILES['cv']['name'];
            $cedula_escaneada = $_FILES['cedula-pdf']['name'];
            $estudios_postulante = $_FILES['estudios']['name'];

            // Mover archivos a la carpeta deseada (ajustar la ruta según tu estructura)
            move_uploaded_file($_FILES['cv']['tmp_name'], '../pdf/cv/' . $cv);
            move_uploaded_file($_FILES['cedula-pdf']['tmp_name'], '../pdf/cedulas/' . $cedula_escaneada);
            move_uploaded_file($_FILES['estudios']['tmp_name'], '../pdf/estudios_postulante/' . $estudios_postulante);


            // Insertar datos en la tabla "postulante" relacionando con la tabla "personas"
            $sql_postulante = "INSERT INTO postulante (id_persona, cv, cedula_escaneada, estudios_postulante, cargo_postulante) 
                               VALUES ('$id_persona', '$cv', '$cedula_escaneada', '$estudios_postulante', '$cargo')";

            if ($conn->query($sql_postulante) === TRUE) {
                echo "Datos insertados correctamente.";
            } else {
                echo "Error al insertar datos en la tabla 'postulante': " . $conn->error;
            }
        } else {
            echo "Error al insertar datos en la tabla 'personas': " . $conn->error;
        }
    }

}
?>

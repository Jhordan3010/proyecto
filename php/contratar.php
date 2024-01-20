<!DOCTYPE html>
<html lang="es">
<head>

    <link rel="stylesheet" href="../css/contrato.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/listaempleados.css">
    <title>Contratar Postulante</title>
</head>
<body>

<h2>Contratar Postulante</h2>

<?php
function conectar($dbname)
{
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
// ...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cedula"])) {
        // Proceso de búsqueda por cédula
        $conn = conectar("midb_proyecto");
        $cedula = mysqli_real_escape_string($conn, $_POST["cedula"]);

        $sqlBuscarPostulante = "SELECT persona.id_persona, persona.nombre, persona.apellido, persona.CI, postulante.id_postulante, postulante.cargo_postulante, postulante.cv, postulante.cedula_escaneada, postulante.estudios_postulante
                                FROM persona
                                LEFT JOIN postulante ON persona.id_persona = postulante.id_persona
                                WHERE persona.CI = '$cedula'";
        $resultBuscarPostulante = $conn->query($sqlBuscarPostulante);

        if ($resultBuscarPostulante === FALSE) {
            echo "Error en la consulta SQL: " . $conn->error;
        } else {
            if ($resultBuscarPostulante->num_rows > 0) {
                echo "<form action='' method='post' enctype='multipart/form-data'>";
                echo "<label for='postulante_id'>Seleccionar Postulante:</label>";
                echo "<select name='postulante_id' required>";

                while ($rowPersona = $resultBuscarPostulante->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($rowPersona['id_postulante']) . "'>" . htmlspecialchars($rowPersona['nombre']) . " " . htmlspecialchars($rowPersona['apellido']) . " - CI: " . htmlspecialchars($rowPersona['CI']) . "</option>";
                }

                echo "</select>";
                echo "<label for='sueldo'>Sueldo:</label>";
                echo "<input type='text' name='sueldo' required>";
                
                echo "<input type='submit' value='Contratar'>";
                echo "</form>";
            } else {
                echo "No se encontró ningún postulante con la cédula proporcionada.";
            }

            // Cerrar la conexión
            $conn->close();
        }
    } elseif (isset($_POST["postulante_id"])) {
        // Proceso de contratación
        $conn = conectar("midb_proyecto");

        // Validar y escapar datos
        $postulante_id = mysqli_real_escape_string($conn, $_POST["postulante_id"]);
        $sueldo = mysqli_real_escape_string($conn, $_POST["sueldo"]);

        // Obtener información del postulante seleccionado
        $sqlObtenerInfoPostulante = "SELECT * FROM postulante WHERE id_postulante = $postulante_id";
        $resultObtenerInfoPostulante = $conn->query($sqlObtenerInfoPostulante);

        if ($resultObtenerInfoPostulante === FALSE) {
            echo "Error en la consulta SQL: " . $conn->error;
        } else {
            $row = $resultObtenerInfoPostulante->fetch_assoc();

            // Verificar si el postulante ya ha sido contratado
            $sqlVerificarContratacion = "SELECT * FROM empleado WHERE id_postulante = $postulante_id";
            $resultVerificarContratacion = $conn->query($sqlVerificarContratacion);

            if ($resultVerificarContratacion->num_rows > 0) {
                echo "<p>Este postulante ya ha sido contratado anteriormente.</p>";
            } else {
                // Continuar con el proceso de contratación
                // ...

                // Actualizar la tabla de empleados
                $sqlInsert = "INSERT INTO empleado (id_persona, sueldo_empleado, cargo_empleado, cv, cedula_escaneada, titulo)
                              VALUES ({$row['id_persona']}, $sueldo, '{$row['cargo_postulante']}', '{$row['cv']}', '{$row['cedula_escaneada']}', '{$row['estudios_postulante']}')";
                $resultInsert = $conn->query($sqlInsert);

                if ($resultInsert === FALSE) {
                    echo "Error al contratar al postulante: " . $conn->error;
                    echo "Consulta SQL: " . $sqlInsert;
                } else {
                    echo "<p>Postulante contratado con éxito.</p>";

                    // Resto del código para eliminar el postulante de la tabla postulante
                    $sqlEliminarPostulante = "DELETE FROM postulante WHERE id_postulante = $postulante_id";
                    $resultEliminarPostulante = $conn->query($sqlEliminarPostulante);

                    if ($resultEliminarPostulante === FALSE) {
                        echo "Error al eliminar el postulante: " . $conn->error;
                        echo "Consulta SQL: " . $sqlEliminarPostulante;
                    }
                }
            }
        }

        // Cerrar la conexión
        $conn->close();
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <label for="cedula">Buscar por Cédula:</label>
    <input type="text" name="cedula" required>
    <input type="submit" value="Buscar">
</form>

</body>
</html>



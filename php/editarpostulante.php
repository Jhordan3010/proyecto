<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="../css/editar.css">
</head>

<body>
    <h1>Editar Empleado</h1>

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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = conectar("midb_Proyecto");

        $CI = $_POST['CI'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $cargo_empleado = $_POST['cargo_empleado'];
        $sueldo_empleado = $_POST['sueldo_empleado'];

        // Actualizar datos en la tabla "persona"
        $sqlPersona = "UPDATE sesion SET nombre=?, apellido=?, direccion=?, telefono=?, email=? WHERE CI=?";
        $stmtPersona = $conn->prepare($sqlPersona);
        $stmtPersona->bind_param("ssssss", $nombre, $apellido, $direccion, $telefono, $email, $CI);
        $stmtPersona->execute();

        // Obtener el id_persona para la actualización en la tabla "empleados"
        $sqlIdPersona = "SELECT id_sesion FROM sesion WHERE CI=?";
        $stmtIdPersona = $conn->prepare($sqlIdPersona);
        $stmtIdPersona->bind_param("s", $CI);
        $stmtIdPersona->execute();
        $resultIdPersona = $stmtIdPersona->get_result();

        

        $conn->close();
    } else {
        if (isset($_GET['CI'])) {
            $CI = $_GET['CI'];
            $conn = conectar("midb_Proyecto");
            $sql = "SELECT persona.*, empleado.cargo_empleado, empleado.sueldo_empleado 
                    FROM persona 
                    LEFT JOIN empleado ON persona.id_persona = empleado.id_persona 
                    WHERE persona.CI=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $CI);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                echo "<form action='editar.php' method='post'>";
                echo "Cédula: <input type='text' name='CI' value='" . $row['CI'] . "' readonly><br>";
                echo "Nombre: <input type='text' name='nombre' value='" . $row['nombre'] . "'><br>";
                echo "Apellido: <input type='text' name='apellido' value='" . $row['apellido'] . "'><br>";
                echo "Dirección: <input type='text' name='direccion' value='" . $row['direccion'] . "'><br>";
                echo "Teléfono: <input type='text' name='telefono' value='" . $row['telefono'] . "'><br>";
                echo "Email: <input type='text' name='email' value='" . $row['email'] . "'><br>";
                echo "Cargo: <select name='cargo_empleado'>";
                echo "<option value='Gerente de Ventas' " . ($row['cargo_empleado'] == 'Gerente de Ventas' ? 'selected' : '') . ">Gerente de Ventas</option>";
                echo "<option value='Recepcionista' " . ($row['cargo_empleado'] == 'Recepcionista' ? 'selected' : '') . ">Recepcionista</option>";
                echo "<option value='Gerente General' " . ($row['cargo_empleado'] == 'Gerente General' ? 'selected' : '') . ">Gerente General</option>";
                echo "<option value='Técnico de Servicio Mecánico' " . ($row['cargo_empleado'] == 'Técnico de Servicio Mecánico' ? 'selected' : '') . ">Técnico de Servicio Mecánico</option>";
                // Añade más opciones según sea necesario
                echo "</select><br>";
                echo "Sueldo: <input type='text' name='sueldo_empleado' value='" . $row['sueldo_empleado'] . "'><br>";
                echo "<input type='submit' value='Actualizar' class='actualizar-button'>";
                echo "</form>";
            } else {
                echo "Empleado no encontrado.";
            }

            $conn->close();
        } else {
            echo "Cédula no proporcionada.";
        }
    }
    ?>

    <a href="../html/menu.html" class="menu-button">Ir al Menú</a>
</body>

</html>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../css/listaempleados.css">
</head>
<body>
    <header>
        <h1>Lista de Empleados</h1>
    </header>

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

    $conn = conectar("midb_Proyecto");

    $sql = "SELECT persona.CI, persona.nombre, persona.apellido, persona.direccion, persona.telefono, persona.email, 
                   empleado.cargo_empleado, empleado.sueldo_empleado
            FROM persona
            LEFT JOIN empleado ON persona.id_persona = empleado.id_persona";

    $resultado = $conn->query($sql);

    if (!$resultado) {
        die("Error en la consulta: " . $conn->error);
    }

    if ($resultado->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Cargo Empleado</th>
                <th>Sueldo Empleado</th>
                <th>Acciones</th>
              </tr>";

        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['CI'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['apellido'] . "</td>";
            echo "<td>" . $fila['direccion'] . "</td>";
            echo "<td>" . $fila['telefono'] . "</td>";
            echo "<td>" . $fila['email'] . "</td>";
            echo "<td>" . $fila['cargo_empleado'] . "</td>";
            echo "<td>" . $fila['sueldo_empleado'] . "</td>";
            echo "<td>
                    <a class='edit-link' href='editar.php?CI=" . $fila['CI'] . "'>Editar</a> 
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No se encontraron empleados.";
    }

    $conn->close();
    ?>

    <a href="../html/menu.html" class="menu-button">Ir al Menú</a>
    <!-- <a href="ver_todas_evaluaciones.php" class="menu-button">Ver Todas las Evaluaciones</a> -->
</body>
</html>
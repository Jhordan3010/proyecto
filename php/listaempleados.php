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

    // Asegúrate de que la columna id_persona esté en la tabla persona
    $sql = "SELECT persona.CI, persona.nombre, persona.apellido, persona.direccion, persona.telefono, persona.email, 
                   empleado.cargo_empleado, empleado.sueldo_empleado, empleado.cv, empleado.cedula_escaneada, empleado.titulo
            FROM persona
            LEFT JOIN empleado ON persona.id_persona = empleado.id_persona
            WHERE empleado.id_empleado IS NOT NULL";  // Agregamos esta condición

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
                <th>CV</th>
                <th>Cédula Escaneada</th>
                <th>Título</th>
                <th>Acciones</th>
              </tr>";

              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                          <td>{$row['id_postulante']}</td>
                          <td>{$row['CI']}</td>
                          <td>{$row['nombre']}</td>
                          <td>{$row['apellido']}</td>
                          <td>{$row['direccion']}</td>
                          <td>{$row['telefono']}</td>
                          <td>{$row['email']}</td>   
                          <td>{$row['cargo_postulante']}</td>
                          <td><a href='../pdf/cv/{$row['cv']}' target='_blank'>Ver CV</a></td>
                          <td><a href='../pdf/cedulas/{$row['cedulas']}' target='_blank'>Ver Cédula</a></td>
                          <td><a href='../pdf/estudios_postulante/{$row['estudios_postulante']}' target='_blank'>Ver título</a></td>
                      </tr>";
            }
            
            
            

        echo "</table>";
    } else {
        echo "No se encontraron empleados con id_empleado.";
    }

    $conn->close();
    ?>

    <a href="../html/menu.html" class="menu-button">Ir al Menú</a>
    <a href="ver_todas_evaluaciones.php" class="menu-button">Ver Todas las Evaluaciones</a>
</body>
</html>


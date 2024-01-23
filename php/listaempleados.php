<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../css/listaempleado.css">
</head>
<body>
<header>
    <h1>Lista de Empleados</h1>
</header>
<main>
    <section>
        <form method="GET">
            <label for="cargo">Buscar por Cargo:</label>
            <input type="text" id="cargo" name="cargo" placeholder="Ingrese el cargo">
            <input type="submit" value="Buscar">
        </form>

        <?php
        // Tu función conectar
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

        // Obtener datos de la tabla empleado uniendo con la tabla persona y filtrar por cargo si se proporciona en la búsqueda
        $conn = conectar("midb_proyecto");
        $sql = "SELECT empleado.id_empleado, persona.CI, persona.nombre, persona.apellido, persona.direccion, persona.telefono, persona.email, empleado.cargo_empleado, empleado.sueldo_empleado, empleado.cv, empleado.cedula_escaneada, empleado.titulo FROM empleado
                  INNER JOIN persona ON empleado.id_persona = persona.id_persona";

        if (isset($_GET['cargo']) && !empty($_GET['cargo'])) {
            $cargo = $_GET['cargo'];
            $sql .= " WHERE empleado.cargo_empleado LIKE '%$cargo%'";
        }

        $result = $conn->query($sql);

        if ($result === FALSE) {
            // Imprimir el error de la consulta SQL
            echo "Error en la consulta SQL: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                echo "<table>
                          <tr>
                            <th>ID Empleado</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Cargo Empleado</th>
                            <th>Sueldo Empleado</th>
                            <th>Ver CV</th>
                            <th>Ver Cédula</th>
                            <th>Ver Titulo</th>
                            <th>Acciones</th>
                          </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                              <td>{$row['id_empleado']}</td>
                              <td>{$row['CI']}</td>
                              <td>{$row['nombre']}</td>
                              <td>{$row['apellido']}</td>
                              <td>{$row['direccion']}</td>
                              <td>{$row['telefono']}</td>
                              <td>{$row['email']}</td>   
                              <td>{$row['cargo_empleado']}</td>
                              <td>{$row['sueldo_empleado']}</td>
                              <td><a href='{$row['cv']}' target='_blank'>Ver CV</a></td>
                              <td><a href='{$row['cedula_escaneada']}' target='_blank'>Ver Cédula</a></td>
                              <td><a href='{$row['titulo']}' target='_blank'>Ver Título</a></td>
                              <td> <a class='edit-link' href='editar.php?CI=" . $row['CI'] . "'>Editar</a> </td>
                            </tr>";
                }

                echo "</table>";
            } else {
                echo "No hay empleados registrados.";
            }
        }

        // Cerrar la conexión
        $conn->close();
        ?>

        <!-- Botón para ir al menú -->
        <a href="../html/menu.html" class="btn-menu">Ir al Menú</a>
    </section>
</main>
</body>
</html>


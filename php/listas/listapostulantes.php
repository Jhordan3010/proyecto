<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Postulantes</title>
    <link rel="stylesheet" href="../../css/listapostulante.css">
</head>
<body>
<header>
    <h1>Lista de Postulantes</h1>
</header>

<main>
    <section>
        <form method="GET">
            <label for="cargo">Buscar por Cargo:</label>
            <select id="cargo" name="cargo">
                <option value="" disabled selected>Seleccione un cargo</option>
                <option value="Gerente de Ventas">Gerente de Ventas</option>
                <option value="Gerente General">Gerente General</option>
                <option value="Mecánico">Mecánico</option>
                <option value="Recepcionista">Recepcionista</option>
                <!-- Agrega más opciones según tus cargos -->
            </select>
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

        // Obtener datos de la tabla postulante uniendo con la tabla persona y filtrar por cargo si se proporciona en la búsqueda
        $conn = conectar("midb_proyecto");
        $sql = "SELECT postulante.id_postulante, persona.CI, persona.nombre, persona.apellido, persona.direccion, persona.telefono, persona.email, postulante.cv, postulante.cedula_escaneada, postulante.estudios_postulante, postulante.cargo_postulante FROM postulante
          INNER JOIN persona ON postulante.id_persona = persona.id_persona";

        if (isset($_GET['cargo']) && !empty($_GET['cargo'])) {
            $cargo = $_GET['cargo'];
            $sql .= " WHERE postulante.cargo_postulante LIKE '%$cargo%'";
        }

        $result = $conn->query($sql);

        if ($result === FALSE) {
            // Imprimir el error de la consulta SQL
            echo "Error en la consulta SQL: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                echo "<table>
                          <tr>
                            <th>ID Postulante</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Cargo Postulante</th>
                            <th>Ver CV</th>
                            <th>Ver Cédula</th>
                            <th>Ver Titulo</th>
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
                              <td><a href='{$row['cv']}' target='_blank'>Ver CV</a></td>
                              <td><a href='{$row['cedula_escaneada']}' target='_blank'>Ver Cédula</a></td>
                              <td><a href='{$row['estudios_postulante']}' target='_blank'>Ver título</a></td>
                            </tr>";
                }

                echo "</table>";
            } else {
                echo "No hay postulantes registrados.";
            }
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </section>
</main>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Todas las Evaluaciones</title>
    <link rel="stylesheet" href="../css/ver_todas_evaluacione.css">
</head>
<body>
    <header>
        <h1>Ver Todas las Evaluaciones</h1>
    </header>
    <main>
        <section>
            <form action="ver_todas_evaluaciones.php" method="post">
                <label for="cedula">Buscar por Cédula:</label>
                <input type="text" id="cedula" name="cedula" required>
                <button type="submit" class="menu-button">Buscar</button>
            </form>

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

            // Verificar si se envió una solicitud de búsqueda
            if(isset($_POST['cedula'])){
                $cedula = $_POST['cedula'];

                $sql = "SELECT persona.CI, persona.nombre, persona.apellido, 
                               empleado.cargo_empleado, 
                               evaluacion.desempeno, evaluacion.comportamiento, evaluacion.adaptabilidad,
                               evaluacion.reg_date
                        FROM persona
                        INNER JOIN empleado ON persona.id_persona = empleado.id_persona
                        INNER JOIN evaluar_empleado evaluacion ON empleado.id_empleado = evaluacion.id_empleado
                        WHERE persona.CI = '$cedula'";
            } else {
                // Si no hay solicitud de búsqueda, obtener todas las evaluaciones realizadas
                $sql = "SELECT persona.CI, persona.nombre, persona.apellido, 
                               empleado.cargo_empleado, 
                               evaluacion.desempeno, evaluacion.comportamiento, evaluacion.adaptabilidad,
                               evaluacion.reg_date
                        FROM persona
                        INNER JOIN empleado ON persona.id_persona = empleado.id_persona
                        INNER JOIN evaluar_empleado evaluacion ON empleado.id_empleado = evaluacion.id_empleado";
            }

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
                        <th>Cargo Empleado</th>
                        <th>Desempeño</th>
                        <th>Comportamiento</th>
                        <th>Adaptabilidad</th>
                        <th>Fecha de Registro</th>
                      </tr>";

                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila['CI'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['apellido'] . "</td>";
                    echo "<td>" . $fila['cargo_empleado'] . "</td>";
                    echo "<td>" . $fila['desempeno'] . "</td>";
                    echo "<td>" . $fila['comportamiento'] . "</td>";
                    echo "<td>" . $fila['adaptabilidad'] . "</td>";
                    echo "<td>" . $fila['reg_date'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No se encontraron evaluaciones.";
            }

            $conn->close();
            ?>

            <a href="../html/menu.html" class="menu-button">Ir al Menú</a>
        </section>
    </main>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluaciones por Cédula</title>
    <link rel="stylesheet" href="../css/listaempleados.css">
</head>
<body>
    <header>
        <h1>Evaluaciones por Cédula</h1>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cedula = $_POST["cedula"];

        $conn = conectar("midb_Proyecto");

        $sql = "SELECT persona.CI, persona.nombre, persona.apellido, persona.direccion, persona.telefono, persona.email, 
                       empleado.cargo_empleado, empleado.sueldo_empleado,
                       evaluacion.desempeno, evaluacion.comportamiento, evaluacion.adaptabilidad,
                       evaluacion.reg_date
                FROM persona
                LEFT JOIN empleado ON persona.id_persona = empleado.id_persona
                LEFT JOIN evaluar_empleado evaluacion ON empleado.id_empleado = evaluacion.id_empleado
                WHERE persona.CI = '$cedula'";

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
            echo "No se encontraron evaluaciones para la cédula ingresada.";
        }

        $conn->close();
    }
    ?>

    <a href="listaempleados.php" class="menu-button">Atrás</a>
</body>
</html>

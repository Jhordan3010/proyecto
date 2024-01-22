<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/despedir.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>Recursos humanos</title>
    <script src="../JavaScript/liquidacion.js"></script>
</head>
<body>
    <header>
        <h1>Despedir Empleado</h1>
    </header>

    <main>
        <form class="form-b" action="" method="post">
                <label for="CI">Cédula Empleado</label>
                <input type="text" name="CI" required>
                <button type="submit" name="buscar">Buscar</button>
        </form>

        <section class="section-borders">
            <label id="informacion-empleado" for="info-empleado"></label>
        </section>

        <form class="liquid" action="" method="post">
            
            <input type="hidden" name="id_persona" id="hiddenIdPersona" value="" required>
            <input type="hidden" id="sueldo-empleado" name="sueldo_empleado" value="">

            <div>
                <label for="antiguedad">Antigüedad (en años)</label>
                <input type="number" name="antiguedad" id="antiguedad" required>
            </div>

            <div>
                <label for="dias_vacaciones">Días de Vacaciones no tomados</label>
                <input type="number" name="dias_vacaciones" id="dias_vacaciones" required>
            </div>

            <div class="calcular-liquid">
            <button type="button" onclick="calcularLiquidacion()">Calcular Liquidación</button>

            <label id="resultado-liquidacion" for="resultado-liquidacion"></label>
            </div>

            <button type="submit" id="despedir-button" name="despedir">Despedir</button>

        </form>
    </main>

    <footer>
    </footer>

    
    <?php
    session_start();

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
        $CI = isset($_POST['CI']) ? $_POST['CI'] : '';

        if (isset($_POST['buscar'])) {
            $conn = conectar("midb_Proyecto");

            // Modificar la consulta para incluir la información de la tabla 'empleado'
            $sql = "SELECT p.*, e.cargo_empleado, e.sueldo_empleado 
                    FROM persona p 
                    LEFT JOIN empleado e ON p.id_persona = e.id_persona 
                    WHERE p.CI='$CI'";
            
            $query = $conn->query($sql);

            if ($query) {
                if ($query->num_rows > 0) {
                    $row = $query->fetch_assoc();
                    $informacion_empleado = '<h2>Información del Empleado</h2>';
                    $informacion_empleado .= '<table>';
                    $informacion_empleado .= '<tr><th>Nombre</th><td>' . $row['nombre'] . '</td></tr>';
                    $informacion_empleado .= '<tr><th>Apellido</th><td>' . $row['apellido'] . '</td></tr>';
                    $informacion_empleado .= '<tr><th>Dirección</th><td>' . $row['direccion'] . '</td></tr>';
                    $informacion_empleado .= '<tr><th>Teléfono</th><td>' . $row['telefono'] . '</td></tr>';
                    $informacion_empleado .= '<tr><th>E-mail</th><td>' . $row['email'] . '</td></tr>';
                    $informacion_empleado .= '<tr><th>Cargo</th><td>' . $row['cargo_empleado'] . '</td></tr>';
                    $informacion_empleado .= '<tr><th>Sueldo</th><td>$' . $row['sueldo_empleado'] . '</td></tr>';
                    // Puede agregar más campos según la estructura de su base de datos
                    $informacion_empleado .= '</table>';

                    // Asignar la información a la sección correspondiente
                    echo '<script>document.getElementById("informacion-empleado").innerHTML = \'' . $informacion_empleado . '\';</script>';

                    // Actualizar el valor del campo oculto
                    echo '<script>document.getElementById("hiddenIdPersona").value = \'' . $row['id_persona'] . '\';</script>';
                    // Actualizar el valor del sueldo en el campo oculto
                    echo '<script>document.getElementById("sueldo-empleado").value = \'' . $row['sueldo_empleado'] . '\';</script>';
                } else {
                    echo '<script>alert("No se encontró información para la cédula ingresada.");</script>';
                }
            } else {
                echo '<script>alert("Error en la consulta: ' . $conn->error . '");</script>';
            }

            $conn->close();
        } elseif (isset($_POST['despedir'])) {
            $id_persona = isset($_POST['id_persona']) ? $_POST['id_persona'] : '';

            if (empty($id_persona)) {
                echo '<script>alert("Error al obtener el ID del empleado.");</script>';
            } else {
                $conn = conectar("midb_Proyecto");

                $sql_delete = "DELETE FROM persona WHERE id_persona='$id_persona'";
                
                if ($conn->query($sql_delete) === TRUE) {
                    echo '<script>alert("Empleado despedido exitosamente!");</script>';
                    // Puede redirigir a una página específica después de despedir al empleado
                    echo '<script>window.location.assign("../html/menu.html");</script>';
                } else {
                    echo '<script>alert("Error al despedir: ' . $conn->error . '");</script>';
                }

                $conn->close();
            }
        }
    }
    ?>
</body>
</html>


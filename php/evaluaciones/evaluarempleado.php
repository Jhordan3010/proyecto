<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>Evaluar Empleado</title>
    <link rel="stylesheet" href="../../css/evaluar.css">
</head>
<body>  
    <header>
        <h1>Evaluar Empleado</h1>
    </header>

    <main>
        <section>
            <img src="../../imagenes/renault.png" alt="renault">
            <article class="buscar-info">
                <form method="post" action="">
                    <label for="cedula">Cédula Empleado</label>
                    <input type="text" name="cedula" required>
                    <button type="submit" name="buscar">Buscar</button>
                </form>
            </article>
            <article>
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

                function buscarEmpleadoPorCI($CI)
                {
                    $conn = conectar("midb_Proyecto");

                    $sql = "SELECT persona.*, empleado.cargo_empleado 
                            FROM persona
                            LEFT JOIN empleado ON persona.id_persona = empleado.id_persona
                            WHERE persona.CI='$CI'";

                    $resultado = $conn->query($sql);

                    if ($resultado->num_rows > 0) {
                        $empleado = $resultado->fetch_assoc();
                        return $empleado;
                    } else {
                        return null; // No se encontró al empleado con la CI dada
                    }
                }

                function guardarEvaluacion($id_empleado, $desempeno, $comportamiento, $adaptabilidad)
                {
                    $conn = conectar("midb_Proyecto");

                    try {
                        // Verificar si el id_empleado existe antes de insertar la evaluación
                        $verificarEmpleado = "SELECT * FROM empleado WHERE id_empleado = '$id_empleado'";
                        $resultadoVerificacion = $conn->query($verificarEmpleado);

                        if ($resultadoVerificacion->num_rows === 0) {
                            throw new Exception("El empleado con id_empleado $id_empleado no existe.");
                        }

                        // Validar que la evaluación no contenga el valor "-"
                        if ($desempeno === '-' || $comportamiento === '-' || $adaptabilidad === '-') {
                            throw new Exception("Por favor, seleccione valores válidos para la evaluación.");
                        }

                        // Guardar la evaluación en la tabla correspondiente
                        $sql = "INSERT INTO evaluar_empleado (id_empleado, desempeno, comportamiento, adaptabilidad) 
                                VALUES ('$id_empleado', '$desempeno', '$comportamiento', '$adaptabilidad')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Evaluación guardada exitosamente.";
                        } else {
                            throw new Exception("Error al guardar la evaluación: " . $conn->error);
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }

                    $conn->close();
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
                    $CI = $_POST['cedula'];

                    $empleado = buscarEmpleadoPorCI($CI);

                    if ($empleado) {
                        echo "Información del empleado encontrado:<br>";
                        echo "Cédula: " . $empleado['CI'] . "<br>";
                        echo "Nombre: " . $empleado['nombre'] . "<br>";
                        echo "Apellido: " . $empleado['apellido'] . "<br>";
                        echo "Cargo: " . $empleado['cargo_empleado'] . "<br>";

                        echo '<h2>Parámetros de evaluación</h2>';
                        echo '<form method="post" action="">';
                        echo '<input type="hidden" name="cedula" value="' . $CI . '">';
                        echo '<input type="hidden" name="cargo" value="' . $empleado['cargo_empleado'] . '">';
                        echo '<div>';
                        echo '<label for="desempeno">Desempeño</label>';
                        echo '<label for="comportamiento">Comportamiento</label>';
                        echo '<label for="adaptabilidad">Adaptabilidad</label>';
                        echo '</div>';
                        echo '<div>';
                        echo '<select name="desempeno" id="desempeno" required>';
                        echo '<option value="-">-</option>';
                        echo '<option value="Malo">Malo</option>';
                        echo '<option value="Bueno">Bueno</option>';
                        echo '<option value="Excelente">Excelente</option>';
                        echo '</select>';
                        echo '<select name="comportamiento" id="comportamiento" required>';
                        echo '<option value="-">-</option>';
                        echo '<option value="Malo">Malo</option>';
                        echo '<option value="Bueno">Bueno</option>';
                        echo '<option value="Excelente">Excelente</option>';
                        echo '</select>';
                        echo '<select name="adaptabilidad" id="adaptabilidad" required>';
                        echo '<option value="-">-</option>';
                        echo '<option value="Malo">Malo</option>';
                        echo '<option value="Bueno">Bueno</option>';
                        echo '<option value="Excelente">Excelente</option>';
                        echo '</select>';
                        echo '</div>';
                        echo '<button type="submit" name="evaluar" id="evaluar-button">Evaluar Empleado</button>';
                        echo '</form>';
                    } else {
                        echo "Empleado no encontrado con la CI proporcionada.";
                    }
                } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['evaluar'])) {
                    // Validar que se haya seleccionado una cédula antes de procesar la evaluación
                    if (isset($_POST['cedula']) && !empty($_POST['cedula'])) {
                        $CI = $_POST['cedula'];
                        $cargo = $_POST['cargo'];
                        $desempeno = $_POST['desempeno'];
                        $comportamiento = $_POST['comportamiento'];
                        $adaptabilidad = $_POST['adaptabilidad'];

                        // Validar que la evaluación no esté vacía y no contenga el valor "-"
                        if ($desempeno !== '-' && $comportamiento !== '-' && $adaptabilidad !== '-') {
                            $empleado = buscarEmpleadoPorCI($CI);

                            if ($empleado) {
                                $id_empleado = $empleado['id_persona'];
                                guardarEvaluacion($id_empleado, $desempeno, $comportamiento, $adaptabilidad);
                            } else {
                                echo "Empleado no encontrado con la CI proporcionada.";
                            }
                        } else {
                            echo "Por favor, seleccione valores válidos para la evaluación.";
                        }
                    } else {
                        echo "Por favor, seleccione una cédula antes de evaluar.";
                    }
                }
                ?>
            </article>
        </section>
    </main>
    <a href="../html/menu.html" class="menu-button">Ir al Menú</a>
    
    <footer>
    </footer>
</body>
</html>

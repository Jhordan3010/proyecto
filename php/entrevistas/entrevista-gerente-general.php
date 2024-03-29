<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../css/entrevista.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente Ventas</title>
</head>

<body>
    <header>
        <h1>Evaluación Gerente General</h1>
    </header>
    <main>
        <section>
            <img src="../imagenes/renault.png" alt="">

            <form class="preguntas" action="">
                <label for="cedula_postulante">Cédula del postulante:</label>
                <input type="text" id="cedula_postulante" name="cedula_postulante" required>
                <label for="accion_importante">¿Cuál de las siguientes acciones considera más importante para el éxito
                    de la concesionaria?</label>
                <select id="accion_importante" name="accion_importante" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Desarrollo de estrategias de marketing efectivas">Desarrollo de estrategias de
                        marketing efectivas</option>
                    <option value="Optimización de procesos internos y eficiencia operativa">Optimización de procesos
                        internos y eficiencia operativa</option>
                    <option value="Fomentar un ambiente de trabajo positivo y motivador">Fomentar un ambiente de trabajo
                        positivo y motivador</option>
                    <option value="Desarrollo de relaciones sólidas con clientes y proveedores">Desarrollo de relaciones
                        sólidas con clientes y proveedores</option>
                </select>

                <label for="liderazgo">¿Cómo describiría su estilo de liderazgo?</label>
                <select id="liderazgo" name="liderazgo" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Liderazgo participativo">Liderazgo participativo</option>
                    <option value="Liderazgo autocrático">Liderazgo autocrático</option>
                    <option value="Liderazgo transformacional">Liderazgo transformacional</option>
                    <option value="Liderazgo situacional">Liderazgo situacional</option>
                </select>

                <label for="metas">¿Cómo establecería y mediría las metas para el éxito de la concesionaria?</label>
                <select id="metas" name="metas" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Utilizando indicadores clave de rendimiento (KPIs)">Utilizando indicadores clave de
                        rendimiento (KPIs)</option>
                    <option
                        value="Estableciendo metas SMART (Específicas, Medibles, Alcanzables, Relevantes, Limitadas en el Tiempo)">
                        Estableciendo metas SMART</option>
                    <option value="Realizando análisis de tendencias del mercado">Realizando análisis de tendencias del
                        mercado</option>
                    <option value="Colaborando con el equipo para establecer metas colectivas">Colaborando con el equipo
                        para establecer metas colectivas</option>
                </select>

                <label for="clientes">¿Cómo garantizaría la satisfacción del cliente en la concesionaria?</label>
                <select id="clientes" name="clientes" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Implementando programas de atención al cliente">Implementando programas de atención
                        al cliente</option>
                    <option value="Recopilando y analizando comentarios de los clientes">Recopilando y analizando
                        comentarios de los clientes</option>
                    <option value="Ofreciendo servicios postventa de alta calidad">Ofreciendo servicios postventa de
                        alta calidad</option>
                    <option value="Desarrollando relaciones personalizadas con los clientes">Desarrollando relaciones
                        personalizadas con los clientes</option>
                </select>


                <button type="submit">Enviar</button>
            </form>

        </section>

    </main>
    <?php
$servername = 'localhost';
$username = 'Jhordan';
$password = '123456789';
$dbname = 'midb_proyecto';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ci_postulante = $_POST["cedula_postulante"];
    $accion_importante = $_POST["accion_importante"];
    $liderazgo = $_POST["liderazgo"];
    $metas = $_POST["metas"];
    $clientes = $_POST["clientes"];

    // Guardar la entrevista en la tabla entrevista_gerente_general
    $sql_entrevista_general = "INSERT INTO entrevista_gerente_general (CI, accion_importante, liderazgo, metas, clientes)
                               VALUES ('$ci_postulante', '$accion_importante', '$liderazgo', '$metas', '$clientes')";

    if ($conn->query($sql_entrevista_general) === TRUE) {
        echo "<p>Entrevista registrada correctamente.</p>";
    } else {
        echo "<p>Error al registrar la entrevista: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
</body>

</html>
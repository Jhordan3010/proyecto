<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../css/entrevista.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mecánico</title>
</head>

<body>
    <header>
        <h1>Entrevista Mecánico</h1>
    </header>
    <main>
        <section>
            <img src="../imagenes/renault.png" alt="">
            <form class="preguntas" action="">
               <label for="cedula_postulante">Cédula del postulante:</label>
                <input type="text" id="cedula_postulante" name="cedula_postulante" required>
                <label for="experiencia">¿Cuántos años de experiencia tiene como Técnico de Servicios Mecánicos?</label>
                <select id="experiencia" name="experiencia" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Menos de 1 año">Menos de 1 año</option>
                    <option value="1-3 años">1-3 años</option>
                    <option value="4-6 años">4-6 años</option>
                    <option value="Más de 6 años">Más de 6 años</option>
                </select>

                <label for="certificacion">¿Posee alguna certificación o formación especializada en servicios
                    mecánicos?</label>
                <select id="certificacion" name="certificacion" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Certificación ASE">Certificación ASE</option>
                    <option value="Formación en sistemas de frenos">Formación en sistemas de frenos</option>
                    <option value="Certificación en diagnóstico de motores">Certificación en diagnóstico de motores
                    </option>
                    <option value="Otra certificación relevante">Otra certificación relevante</option>
                </select>

                <label for="actualizacion_tecnologica">¿Cómo se mantiene actualizado/a con las nuevas tecnologías en el
                    campo automotriz?</label>
                <select id="actualizacion_tecnologica" name="actualizacion_tecnologica" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Asistiendo a cursos y talleres">Asistiendo a cursos y talleres</option>
                    <option value="Participando en conferencias y eventos de la industria">Participando en conferencias
                        y eventos de la industria</option>
                    <option value="Leyendo publicaciones y recursos en línea">Leyendo publicaciones y recursos en línea
                    </option>
                    <option value="Colaborando con colegas y compartiendo experiencias">Colaborando con colegas y
                        compartiendo experiencias</option>
                </select>

                <label for="seguridad_trabajo">¿Cómo garantiza la seguridad en su lugar de trabajo durante las
                    operaciones mecánicas?</label>
                <select id="seguridad_trabajo" name="seguridad_trabajo" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Siguiendo protocolos de seguridad establecidos">Siguiendo protocolos de seguridad
                        establecidos</option>
                    <option value="Realizando inspecciones regulares de equipos">Realizando inspecciones regulares de
                        equipos</option>
                    <option value="Promoviendo la capacitación continua en seguridad">Promoviendo la capacitación
                        continua en seguridad</option>
                    <option value="Fomentando una cultura de seguridad entre el equipo">Fomentando una cultura de
                        seguridad entre el equipo</option>
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
    $cedula_postulante = $_POST["cedula_postulante"];
    $experiencia = $_POST["experiencia"];
    $certificacion = $_POST["certificacion"];
    $actualizacion_tecnologica = $_POST["actualizacion_tecnologica"];
    $seguridad_trabajo = $_POST["seguridad_trabajo"];

    // Guardar la entrevista en la tabla entrevista_mecanico
    $sql_entrevista_mecanico = "INSERT INTO entrevista_mecanico (cedula_postulante, experiencia, certificacion, actualizacion_tecnologica, seguridad_trabajo)
                           VALUES ('$cedula_postulante', '$experiencia', '$certificacion', '$actualizacion_tecnologica', '$seguridad_trabajo')";

    if ($conn->query($sql_entrevista_mecanico) === TRUE) {
        echo "<p>Entrevista registrada correctamente.</p>";
    } else {
        echo "<p>Error al registrar la entrevista: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

</body>

</html>
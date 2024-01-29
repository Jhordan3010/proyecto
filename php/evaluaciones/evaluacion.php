<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/evaluacion.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluación de Satisfacción</title>
</head>
<body>
    <header>
        <h1>Evaluación de Satisfacción</h1>
    </header>
    <main>
        <section>
            <img src="../../imagenes/renault.png" alt="">
            <form method="post"> <!-- Cambiado action y agregado method -->

                <h3>¿Cómo calificaría su experiencia general en la concesionaria?</h3>
                <select name="pregunta1" id="pregunta1">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <h3>¿Cómo evaluaría la amabilidad y profesionalismo del personal de ventas?</h3>
                <select name="pregunta2" id="pregunta2">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <h3>¿Está satisfecho con la variedad de vehículos disponibles para su elección?</h3>
                <select name="pregunta3" id="pregunta3">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <h3>¿Cómo calificaría el proceso de financiamiento y la claridad de la información proporcionada?</h3>
                <select name="pregunta4" id="pregunta4">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <h3>¿Recomendaría nuestra concesionaria a familiares o amigos?</h3>
                <select name="pregunta5" id="pregunta5">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <button type="submit">Enviar</button>

            </form>
        </section>
    </main>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuración de la base de datos
    $servername = 'localhost';
    $username = 'Jhordan';
    $password = '123456789';
    $dbname = 'midb_proyecto';
    $port = 3306;

    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Recoger los datos del formulario
    $pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];
    $pregunta3 = $_POST['pregunta3'];
    $pregunta4 = $_POST['pregunta4'];
    $pregunta5 = $_POST['pregunta5'];

    // Consulta SQL para insertar los datos en la tabla
    $sql = "INSERT INTO evaluacion_satisfaccion (pregunta1, pregunta2, pregunta3, pregunta4, pregunta5)
            VALUES ('$pregunta1', '$pregunta2', '$pregunta3', '$pregunta4', '$pregunta5')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>


</body>
</html>
 

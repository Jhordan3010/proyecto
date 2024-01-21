<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/evaluacion.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Evaluación de Satisfacción</h1>
    </header>
    <main>
        <section>
            <img src="../imagenes/renault.png" alt="">
            <form  method="post"> <!-- Cambiado action y agregado method -->

                <h3 for="">¿Cómo calificaría su experiencia general en la concesionaria?</h3>     
                <select name="pregunta1" id="">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <h3 for="">¿Cómo evaluaría la amabilidad y profesionalismo del personal de ventas?</h3>
                <select name="pregunta2" id="">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <h3 for="">¿Está satisfecho con la variedad de vehículos disponibles para su elección?</h3>
                <select name="pregunta3" id="">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <h3 for="">¿Cómo calificaría el proceso de financiamiento y la claridad de la información proporcionada?</h3>
                <select name="pregunta4" id="">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <h3 for="">¿Recomendaría nuestra concesionaria a familiares o amigos?</h3>
                <select name="pregunta5" id="">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Malo">Malo</option>
                </select>

                <button type="submit">Enviar</button>

            </form>
        </section>
    </main>
    <?php
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
    die("Conexión a base de datos falló: " . $conn->connect_error);
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $pregunta1 = mysqli_real_escape_string($conn, $_POST["pregunta1"]);
    $pregunta2 = mysqli_real_escape_string($conn, $_POST["pregunta2"]);
    $pregunta3 = mysqli_real_escape_string($conn, $_POST["pregunta3"]);
    $pregunta4 = mysqli_real_escape_string($conn, $_POST["pregunta4"]);
    $pregunta5 = mysqli_real_escape_string($conn, $_POST["pregunta5"]);

    // Consulta SQL preparada para insertar los datos en la base de datos
    $sql = $conn->prepare("INSERT INTO evaluacion_general (pregunta1, pregunta2, pregunta3, pregunta4, pregunta5) VALUES (?, ?, ?, ?, ?)");

    // Vincular parámetros
    $sql->bind_param("sssss", $pregunta1, $pregunta2, $pregunta3, $pregunta4, $pregunta5);

    // Intentar ejecutar la consulta
    if ($sql->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        // Mostrar información detallada sobre el error
        echo "Error al guardar los datos: " . $sql->error;
        echo "<br>";
        // Mostrar la consulta SQL para depuración
        echo "Consulta SQL: " . $sql->queryString;
    }

    // Cerrar la consulta
    $sql->close();
}

// Cerrar la conexión
$conn->close();
?>

</body>
</html>

    

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/evaluacion-general.css">
    <meta charset="UTF-8">
    <title>Resultados de Evaluación de Satisfacción</title>

</head>
<body>
    <header>
    <h2>Resultados de Evaluación de Satisfacción</h2>

    </header>


<main>
<section>
<?php
// Configuración de la base de datos
$servername = 'localhost';
$username = 'Jhordan';
$password = '123456789';
$dbname = 'midb_proyecto';

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Consulta SQL para obtener los resultados
$sql = "SELECT * FROM evaluacion_satisfaccion";
$result = $conn->query($sql);

if ($result === FALSE) {
    // Imprimir el error de la consulta SQL
    echo "Error en la consulta SQL: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        echo "<table>
                  <tr>
                    <th>ID</th>
                    <th>Pregunta 1</th>
                    <th>Pregunta 2</th>
                    <th>Pregunta 3</th>
                    <th>Pregunta 4</th>
                    <th>Pregunta 5</th>
                  </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                      <td>{$row['id']}</td>
                      <td>{$row['pregunta1']}</td>
                      <td>{$row['pregunta2']}</td>
                      <td>{$row['pregunta3']}</td>
                      <td>{$row['pregunta4']}</td>
                      <td>{$row['pregunta5']}</td>
                    </tr>";
        }

        echo "</table>";
    } else {
        echo "No hay resultados de evaluación.";
    }
}

// Cerrar la conexión
$conn->close();
?>
</section>
</main>


</body>
</html>

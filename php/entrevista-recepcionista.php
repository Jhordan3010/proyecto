<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/entrevista.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recepcionista</title>
</head>

<body>
    <header>
        <h1>Entrevista Recepcionista</h1>
    </header>
    <main>
        <section>
            <img src="../imagenes/renault.png" alt="">

            <form class="preguntas" action="">
                <label for="cedula_postulante">Cédula del postulante:</label>
                <input type="text" id="cedula_postulante" name="cedula_postulante" required>
                <label for="experiencia">¿Cuánta experiencia tiene en roles de recepción?</label>
                <select id="experiencia" name="experiencia" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Menos de 1 año">Menos de 1 año</option>
                    <option value="1-3 años">1-3 años</option>
                    <option value="4-6 años">4-6 años</option>
                    <option value="Más de 6 años">Más de 6 años</option>
                </select>
        
                <label for="habilidades">¿Cuáles de las siguientes habilidades posee?</label>
                <select id="habilidades" name="habilidades"  required>
                    <option value="Atención al cliente">Atención al cliente</option>
                    <option value="Manejo de llamadas telefónicas">Manejo de llamadas telefónicas</option>
                    <option value="Organización">Organización</option>
                    <option value="Manejo de herramientas de oficina">Manejo de herramientas de oficina</option>
                </select>
        
                <label for="idiomas">¿Qué idiomas habla con fluidez?</label>
                <select id="idiomas" name="idiomas"  required>
                    <option value="Español">Español</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Francés">Francés</option>
                    <option value="Otros">Otros</option>
                </select>
        
                <label for="disponibilidad">¿Cuál es su disponibilidad horaria?</label>
                <select id="disponibilidad" name="disponibilidad" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Tiempo completo">Tiempo completo</option>
                    <option value="Medio tiempo">Medio tiempo</option>
                    <option value="Turnos rotativos">Turnos rotativos</option>
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
    $habilidades = $_POST["habilidades"];
    $idiomas = $_POST["idiomas"];
    $disponibilidad = $_POST["disponibilidad"];

    // Guardar la entrevista en la tabla entrevista_recepcionista
    $sql_entrevista_recepcionista = "INSERT INTO entrevista_recepcionista (CI, experiencia, habilidades, idiomas, disponibilidad)
                           VALUES ('$cedula_postulante', '$experiencia', '$habilidades', '$idiomas', '$disponibilidad')";

    if ($conn->query($sql_entrevista_recepcionista) === TRUE) {
        echo "<p>Entrevista registrada correctamente.</p>";
    } else {
        echo "<p>Error al registrar la entrevista: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

 

</body>

</html>
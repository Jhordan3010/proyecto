<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/perfil-postulante.css">

    <title>Información del Postulante</title>
</head>

<body>
    <header>
        <h2>Información del Postulante</h2>

    </header>
    <main>
        <section>
            <article>
                <form method="POST" action="">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" readonly>
                    <button type="submit">Desplegar información</button>
                </form>
            </article>
            <section>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
                    $username = $_POST['username'];

                    // Lógica para obtener la información del postulante por su username
                    $conn = new mysqli('localhost', 'root', 'root', 'midb_proyecto', 3306);

                    if ($conn->connect_error) {
                        die("Conexión a base de datos falló: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM sesion WHERE username=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo "<h3>Información del Postulante</h3>";
                        echo "<form method='post'>";
                        echo "<table border='1'>";
                        echo "<tr><th>CI</th><th>Nombre</th><th>Apellido</th><th>Dirección</th><th>Teléfono</th><th>Correo</th><th>Username</th><th>Acciones</th></tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><input type='text' name='ci' value='{$row['CI']}'></td>";
                            echo "<td><input type='text' name='nombre' value='{$row['nombre']}'></td>";
                            echo "<td><input type='text' name='apellido' value='{$row['apellido']}'></td>";
                            echo "<td><input type='text' name='direccion' value='{$row['direccion']}'></td>";
                            echo "<td><input type='text' name='telefono' value='{$row['telefono']}'></td>";
                            echo "<td><input type='text' name='correo' value='{$row['correo']}'></td>";
                            echo "<td>{$row['username']}</td>";
                            echo "<td><button type='submit' name='guardar' value='{$row['username']}'>Guardar</button></td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                        echo "</form>";
                    } else {
                        echo "<p>No se encontró información para el username '$username'.</p>";
                    }

                    $stmt->close();
                    $conn->close();
                }

                // Lógica para guardar los cambios en la base de datos
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['guardar'])) {
                    $guardar_username = $_POST['guardar'];
                    $ci = $_POST['ci'];
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $direccion = $_POST['direccion'];
                    $telefono = $_POST['telefono'];
                    $correo = $_POST['correo'];

                    $conn = new mysqli('localhost', 'root', 'root', 'midb_proyecto', 3306);

                    if ($conn->connect_error) {
                        die("Conexión a base de datos falló: " . $conn->connect_error);
                    }

                    $sql = "UPDATE sesion SET CI=?, nombre=?, apellido=?, direccion=?, telefono=?, correo=? WHERE username=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sssssss", $ci, $nombre, $apellido, $direccion, $telefono, $correo, $guardar_username);
                    $stmt->execute();

                    $stmt->close();
                    $conn->close();
                }
                ?>
            </section>
        </section>
    </main>




    <script>
        // Obtener el valor almacenado en localStorage
        var valorRecibido = localStorage.getItem('valorCompartido');

        // Mostrar el valor en el segundo input
        document.getElementById('username').value = valorRecibido;
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/registrarPostulante.css">
    <title>Crear Cuenta Postulante</title>
</head>

<body>
    <header>
        <h1>Registrar Postulante</h1>

    </header>
    <main>
        <section>

            <form id="login-form" method="post" enctype="multipart/form-data">
                <article class="formulario">
                    <div class="datos">
                        <label for="CI">Cédula</label>
                        <label for="nombre">Nombre</label>
                        <label for="apellido">Apellido</label>
                        <label for="direccion">Dirección</label>
                        <label for="telefono">Teléfono</label>
                        <label for="correo">E-mail</label>
                        <label for="username">Usuario</label>
                        <label for="password">Contraseña</label>
                        <label for="password"> Repetir Contraseña</label>
                    </div>
                    <div class="campos">
                        <input type="text" name="CI">
                        <input type="text" name="nombre" required>
                        <input type="text" name="apellido" required>
                        <input type="text" name="direccion" required>
                        <input type="text" name="telefono" required>
                        <input type="text" name="correo" required>
                        <input type="text" name="username" required>
                        <input type="password" name="passwd" required>
                        <input type="password" name="repasswd" required>
                    </div>
                </article>

                <button type="submit">Enviar</button>
            </form>

            <?php
            session_start();

            function conectar($dbname)
            {
                $servername = 'localhost';
                $username = 'root';
                $password = 'root';
                $port = 3306;

                $conn = new mysqli($servername, $username, $password, $dbname, $port);

                if ($conn->connect_error) {
                    die("Conexión a base de datos falló: " . $conn->connect_error);
                }

                return $conn;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['CI'])) {
                $CI = $_POST['CI'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                $correo = $_POST['correo'];
                $username = $_POST['username'];
                $password = $_POST['passwd'];
                $repassword = $_POST['repasswd'];

                // Verificar si la contraseña y la confirmación de contraseña coinciden
                if ($password != $repassword) {
                    echo '<script>alert("Las contraseñas no coinciden.");</script>';
                    echo '<script>window.location.assign("loggin-postulante.php");</script>';
                    exit;
                }

                $conn = conectar("midb_proyecto");

                // Consulta preparada
                $sqlInsertUsuario = "INSERT INTO postulante (CI, nombre, apellido, direccion, telefono, correo, username, passwd) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sqlInsertUsuario);

                // Vincular parámetros
                $stmt->bind_param("ssssssss", $CI, $nombre, $apellido, $direccion, $telefono, $correo, $username, $password);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    echo '<script>alert("Registrado exitosamente!");</script>';
                    echo '<script>window.location.assign("loggin-postulante.php");</script>';
                } else {
                    echo '<script>alert("Error al insertar en postulante: ' . $stmt->error . '");</script>';
                    echo '<script>window.location.assign("loggin-postulante.php");</script>';
                }

                // Cerrar la conexión y la declaración
                $stmt->close();
                $conn->close();
            }
            ?>

        </section>
    </main>


</body>

</html>
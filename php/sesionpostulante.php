<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/postula.css">
    <title>Crear Cuenta Postulante</title>
</head>
<body>
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
            </div>
            <div class="campos">
                <input type="text" name="CI">
                <input type="text" name="nombre" required>
                <input type="text" name="apellido" required>
                <input type="text" name="direccion" required>
                <input type="text" name="telefono" required>
                <input type="text" name="correo" required>
                <input type="text" name="username" required>
                <input type="text" name="passwd" required>
            </div>
        </article>

        <button type="submit">Enviar</button>
    </form>
    
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['CI'])) {
    $CI = $_POST['CI'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $username = $_POST['username'];
    $password = $_POST['passwd'];

    $conn = conectar("midb_proyecto"); // Ajusta el nombre de tu base de datos aquí

    // Verificar si la cédula ya está registrada
    $sqlCedula = "SELECT * FROM persona WHERE CI='$CI'";
    $queryCedula = $conn->query($sqlCedula);

    if ($queryCedula->num_rows > 0) {
        echo '<script>alert("Cédula ya registrada!");</script>';
        echo '<script>window.location.assign("login.php");</script>';
    } else {
        // Verificar si el username ya está registrado
        $sqlUsername = "SELECT * FROM usuario WHERE username='$username'";
        $queryUsername = $conn->query($sqlUsername);

        if ($queryUsername->num_rows > 0) {
            echo '<script>alert("Usuario ya registrado!");</script>';
            echo '<script>window.location.assign("login.php");</script>';
        } else {
            // Insertar en la tabla "persona"
            $sqlInsertPersona = "INSERT INTO persona (CI, nombre,apellido,direccion,telefono,email) 
                    VALUES ('$CI','$nombre', '$apellido','$direccion','$telefono','$correo')";
            if ($conn->query($sqlInsertPersona) === TRUE) {
                // Obtener el ID generado automáticamente
                $idpersonas = $conn->insert_id;

                // Insertar en la tabla "usuario" relacionando con el ID de personas
                $sqlInsertUsuario = "INSERT INTO usuario (username, passwd, id_persona)
                        VALUES ('$username', '$password', '$idpersonas')";
                if ($conn->query($sqlInsertUsuario) === TRUE) {
                    echo '<script>alert("Registrado exitosamente!");</script>';
                    echo '<script>window.location.assign("login.php");</script>';
                } else {
                    echo '<script>alert("Error al insertar en usuario: ' . $conn->error . '");</script>';
                    echo '<script>window.location.assign("login.php");</script>';
                }
            } else {
                echo '<script>alert("Error al insertar en persona: ' . $conn->error . '");</script>';
                echo '<script>window.location.assign("login.php");</script>';
            }
        }
    }
    $conn->close();
}
?>

</body>
</html>

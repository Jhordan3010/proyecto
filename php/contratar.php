<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/contrato.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>Recursos humanos</title>
    
</head>
<body>
    <header>
        <h1>Registrar nuevo empleado</h1>
    </header>

    <main>
        <form action="contratar.php" method="POST">
            <article class="formulario">
                <div class="datos">
                    <label for="CI">Cédula</label>
                    <label for="nombre">Nombre</label>
                    <label for="apellido">Apellido</label>
                    <label for="direccion">Dirección</label>
                    <label for="telefono">Teléfono</label>
                    <label for="correo">E-mail</label>
                    <label for="cargo_empleado">Cargo</label>
                    <label for="sueldo_empleado">Sueldo</label>
                </div>
                <div class="campos">
                    <input type="text" name="CI">
                    <input type="text" name="nombre" required>
                    <input type="text" name="apellido" required>
                    <input type="text" name="direccion" required>
                    <input type="text" name="telefono" required>
                    <input type="text" name="correo" required>
                    <select name="cargo_empleado" id="">
                        <option value="-">-</option>
                        <option value="Gerente de ventas">Gerente de ventas</option>
                        <option value="Recepcionista">Recepcionista</option>
                        <option value="Gerente General">Gerente General</option>
                        <option value="Técnico de servicio mecánico">Técnico de servicio mecánico</option>
                    </select>
                    <input type="text" name="sueldo_empleado" required>
                </div>
            </article>
            <button id="registrar-button" type="submit">Registrar</button>
        </form>
        <a href="../html/menu.html"><button id="volver-menu-button">Volver al Menú</button></a>
    </main>

    <footer>
    </footer>
    
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CI = $_POST['CI'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $cargo_empleado = $_POST['cargo_empleado'];
        $sueldo_empleado = $_POST['sueldo_empleado'];

        // Verifica si algún campo está vacío y muestra un mensaje
        if (empty($CI) || empty($nombre) || empty($apellido) || empty($direccion) || empty($telefono) || empty($correo) || empty($cargo_empleado) || empty($sueldo_empleado)) {
            echo '<script>alert("Todos los campos deben estar llenos.");</script>';
        } else {
            $conn = conectar("midb_Proyecto");

            // Verifica si el empleado ya está registrado
            $sqlPersona = "SELECT * FROM persona WHERE CI=?";
            $stmtPersona = $conn->prepare($sqlPersona);
            $stmtPersona->bind_param("s", $CI);
            $stmtPersona->execute();
            $resultPersona = $stmtPersona->get_result();

            if ($resultPersona->num_rows > 0) {
                $row = $resultPersona->fetch_assoc();
                $CI = $row['CI'];
                echo '<script>alert("Empleado ya registrado!");</script>';
                echo '<script>window.location.assign("contratar.php");</script>';
            } else {
                // Insertar en la tabla "persona"
                $sql = "INSERT INTO persona (CI, nombre, apellido, direccion, telefono, email) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmtPersonaInsert = $conn->prepare($sql);
                $stmtPersonaInsert->bind_param("ssssss", $CI, $nombre, $apellido, $direccion, $telefono, $correo);
                $stmtPersonaInsert->execute();

                if ($stmtPersonaInsert->affected_rows > 0) {
                    // Obtener el ID generado automáticamente
                    $idpersonas = $stmtPersonaInsert->insert_id;

                    // Insertar en la tabla "usuarios" relacionando con el ID de persona
                    $sql = "INSERT INTO empleado (cargo_empleado, sueldo_empleado, id_persona)
                            VALUES (?, ?, ?)";
                    $stmtUsuariosInsert = $conn->prepare($sql);
                    $stmtUsuariosInsert->bind_param("ssi", $cargo_empleado, $sueldo_empleado, $idpersonas);
                    $stmtUsuariosInsert->execute();

                    if ($stmtUsuariosInsert->affected_rows > 0) {
                        echo '<script>alert("Registrado exitosamente!");</script>';
                        echo '<script>window.location.assign("contratar.php");</script>';
                    } else {
                        echo '<script>alert("Error al insertar en usuarios: ' . $stmtUsuariosInsert->error . '");</script>';
                        echo '<script>window.location.assign("contratar.php");</script>';
                    }
                } else {
                    echo '<script>alert("Error al insertar en persona: ' . $stmtPersonaInsert->error . '");</script>';
                    echo '<script>window.location.assign("contratar.php");</script>';
                }
            }

            $stmtPersona->close();
            $stmtPersonaInsert->close();
            $stmtUsuariosInsert->close();
            $conn->close();
        }
    }
    ?>
    <a href="../html/menu.html" class="menu-button">Ir al Menú</a>
</body>
</html>


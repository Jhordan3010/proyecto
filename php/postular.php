<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="../css/postular.css">
  <link rel="stylesheet" href="../JavaScript/LoogginJS.js">
</head>
<body>

  <header>
    <h1>Concesionario</h1>
  </header>
  <main>
    <section>
      <img src="../imagenes/renault.png" alt="">
      <h2>Postular</h2>

      <form id="login-form" action="postular.php" method="post" enctype="multipart/form-data">
        <article class="formulario">
          <div class="datos">
            <label for="CI">Cédula</label>
            <label for="nombre">Nombre</label>
            <label for="apellido">Apellido</label>
            <label for="direccion">Dirección</label>
            <label for="telefono">Teléfono</label>
            <label for="email">E-mail</label>
          </div>
          <div class="campos">
            <input type="text" name="CI">
            <input type="text" name="nombre" required>
            <input type="text" name="apellido" required>
            <input type="text" name="direccion" required>
            <input type="text" name="telefono" required>
            <input type="text" name="correo" required>
          </div>
        </article>

        <article class="input-group">
          <label for="cargo">Cargo a Postular</label>
          <select class="lista" name="cargo" required>
            <option value="Gerente de ventas">Gerente de ventas</option>
            <option value="Recepcionista">Recepcionista</option>
            <option value="Gerente General">Gerente General</option>
            <option value="Técnico de servicio mecánico">Técnico de servicio mecánico</option>
          </select>
        </article>

        <article class="documentos">
          <div class="adjuntos1 ">
            <label for="cv">Adjuntar CV</label> 
            <label for="cedula-pdf">Cédula Escaneada</label> 
            <label for="estudios">Estudios-Postulante</label> 
          </div>

          <div class="adjuntos2">
            <input id="subir-cv" type="file"  name="cv" accept=".pdf" required>
            <input id="subir-cedula" type="file"  name="cedula-pdf" accept=".pdf" required>
            <input id="subir-estudios" type="file"  name="estudios" accept=".pdf" required>
          </div>
        </article>
        <button type="submit">Enviar</button>
      </form>
      <p id="error-message" class="error-message"></p>
    </section>
  </main>

  <?php


function conectar($dbname)
{
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
    // Recibir datos del formulario
    $CI = $_POST['CI'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $cargo = $_POST['cargo'];

    // Conectar a la base de datos
    $conn = conectar("midb_proyecto");

    if ($conn->connect_error) {
        die("Conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Verificar si la cédula ya está registrada
    $sql_verificar_cedula = "SELECT id_persona FROM persona WHERE CI = '$CI'";
    $result_verificar_cedula = $conn->query($sql_verificar_cedula);

    if ($result_verificar_cedula === FALSE) {
        die("Error al ejecutar la consulta: " . $conn->error);
    }

    if ($result_verificar_cedula->num_rows > 0) {
        echo "La cédula ya está registrada en la base de datos.";
    } else {
        // La cédula no está registrada, proceder con la inserción

        // Insertar datos en la tabla "personas"
        $sql_personas = "INSERT INTO persona (CI, nombre, apellido, direccion, telefono, email) 
                         VALUES ('$CI', '$nombre', '$apellido', '$direccion', '$telefono', '$correo')";

        if ($conn->query($sql_personas) === TRUE) {
            $id_persona = $conn->insert_id;

            // Obtener nombres de archivos
            $cv = $_FILES['cv']['name'];
            $cedula_escaneada = $_FILES['cedula-pdf']['name'];
            $estudios_postulante = $_FILES['estudios']['name'];

            // Mover archivos a la carpeta deseada
            $ruta_cv = '../pdf/cv/' . $cv;
            $ruta_cedula = '../pdf/cedulas/' . $cedula_escaneada;
            $ruta_estudios = '../pdf/estudios_postulante/' . $estudios_postulante;

            move_uploaded_file($_FILES['cv']['tmp_name'], $ruta_cv);
            move_uploaded_file($_FILES['cedula-pdf']['tmp_name'], $ruta_cedula);
            move_uploaded_file($_FILES['estudios']['tmp_name'], $ruta_estudios);

            // Insertar datos en la tabla "postulante" relacionando con la tabla "personas"
            $sql_postulante = "INSERT INTO postulante (id_persona, cv, cedula_escaneada, estudios_postulante, cargo_postulante) 
                               VALUES ('$id_persona', '$ruta_cv', '$ruta_cedula', '$ruta_estudios', '$cargo')";

            if ($conn->query($sql_postulante) === TRUE) {
                echo "Datos insertados correctamente.";
            } else {
                echo "Error al insertar datos en la tabla 'postulante': " . $conn->error;
            }
        } else {
            echo "Error al insertar datos en la tabla 'personas': " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>

</body>
</html>

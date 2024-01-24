<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="../css/postular.css">
  
</head>
<body>

  <header>
    <h1>Concesionario</h1>
  </header>
  <main>
    
    <section>
      <img src="../imagenes/renault.png" alt="">
      <h2>Postular</h2>

      <form id="login-form" method="post" enctype="multipart/form-data">
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
        <label for="cargo_postulante">Cargo a Postular</label>
        <select id="cargo" name="cargo">
                    <option value="" disabled selected>Seleccione un cargo</option>
                    <option value="Gerente de Ventas">Gerente de Ventas</option>
                    <option value="Gerente General">Gerente General</option>
                    <option value="Mecánico">Mecánico</option>
                    <option value="Recepcionista">Recepcionista</option>
                    <!-- Agrega más opciones según tus cargos -->
                </select>
      </article>

      <article class="documentos">
        <div class="adjuntos1">
          <label for="cv">Adjuntar CV</label>
          <label for="cedula-pdf">Cédula Escaneada</label>
          <label for="estudios">Estudios-Postulante</label>
        </div>
        <div class="adjuntos2">
          <input id="subir-pdf" type="file" name="cv" accept=".pdf" required>
          <input id="subir-pdf" type="file" name="cedula-pdf" accept=".pdf" required>
          <input id="subir-pdf" type="file" name="estudios" accept=".pdf" required>
        </div>
      </article>
      <button type="submit">Enviar</button>

    </form>
    

    <p id="error-message" class="error-message"></p>
  </section>
  <section>
  <form id="requisitos">
        <pre>
             <b>GERENTE DE VENTAS</b>
        • Principales responsabilidades: 
        -Desarrollo de estrategias de ventas 
        -Establecimiento de metas y objetivos 
        •	Requisitos: 
        -Título en Administración de Empresas o carreras afines
        -Elevado nivel de relaciones interpersonales 
        -Manejar situaciones imprevistas y resolver problemas de manera eficiente
        -Habilidades de liderazgo
        </pre>
        <pre>
          <b>GERENTE GENERAL</b> 
        •	Principales responsabilidades: 
        -Planificación estratégica 
        -Desarrollo de negocios 
        -Desarrollo de políticas y procedimientos
        •	Requisitos: 
        -Título en Administración de Empresas, Gerencia de Empresas o carreras afines
        -Habilidades de comunicación 
        -Capacidad analítica
        -Innovación y Adaptación 
        -Habilidades de liderazgo
        </pre>
    </form>
  </section>

</main>
<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $CI = $_POST["CI"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $cargo = $_POST["cargo_postulante"];

    // Aquí deberías realizar la conexión a tu base de datos
    $servername = 'localhost';
    $username = 'Jhordan';
    $password = '123456789';
    $dbname = 'midb_proyecto';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión a la base de datos falló: " . $conn->connect_error);
    }

    // Verificar si la cédula ya existe en la tabla persona
    $sqlVerificarCedula = "SELECT id_persona FROM persona WHERE CI = '$CI'";
    $resultVerificarCedula = $conn->query($sqlVerificarCedula);

    if ($resultVerificarCedula->num_rows > 0) {
        echo '<p class="mensaje">La cédula ya ha sido registrada.</p>';
    } else {
        // Insertar en la tabla persona
        $sqlInsertPersona = "INSERT INTO persona (CI, nombre, apellido, direccion, telefono, email) 
                             VALUES ('$CI', '$nombre', '$apellido', '$direccion', '$telefono', '$correo')";
        $resultInsertPersona = $conn->query($sqlInsertPersona);

        if ($resultInsertPersona === FALSE) {
            echo '<p class="mensaje">Error al insertar en la tabla persona: </p>' . $conn->error;
        } else {
            // Obtener el ID de la persona recién insertada
            $id_persona = $conn->insert_id;

            // Rutas de las carpetas
            $pdfFolder = "../pdf/";
            $cvFolder = $pdfFolder . "cv/";
            $cedulaFolder = $pdfFolder . "cedulas/";
            $estudiosFolder = $pdfFolder . "estudios_postulante/";

            // Asegurarse de que las carpetas existan
            $carpetas = [$cvFolder, $cedulaFolder, $estudiosFolder];

            foreach ($carpetas as $carpeta) {
                if (!is_dir($carpeta)) {
                    mkdir($carpeta, 0777, true);  // Crear la carpeta con permisos 0777
                }
            }

            // Nombre de los archivos PDF
            $ruta_cv = $cvFolder . "cv_" . $id_persona . ".pdf";
            $ruta_cedula = $cedulaFolder . "cedula_" . $id_persona . ".pdf";
            $ruta_estudios = $estudiosFolder . "estudios_" . $id_persona . ".pdf";

            // Mover los archivos PDF temporales a las carpetas finales
            move_uploaded_file($_FILES["cv"]["tmp_name"], $ruta_cv);
            move_uploaded_file($_FILES["cedula-pdf"]["tmp_name"], $ruta_cedula);
            move_uploaded_file($_FILES["estudios"]["tmp_name"], $ruta_estudios);

            // Insertar en la tabla postulante
            $sqlInsertPostulante = "INSERT INTO postulante (id_persona, cargo_postulante, cv, cedula_escaneada, estudios_postulante) 
                                    VALUES ('$id_persona', '$cargo', '$ruta_cv', '$ruta_cedula', '$ruta_estudios')";
            $resultInsertPostulante = $conn->query($sqlInsertPostulante);

            if ($resultInsertPostulante === FALSE) {
                echo '<p class="mensaje">Error al insertar en la tabla postulante: </p>' . $conn->error;
            } else {
                echo '<p class="mensaje">Datos guardados con éxito en ambas tablas.</p>';
            }
        }
    }

    // Cerrar la conexión
    $conn->close();
}
?>

</body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Postulación</title>
  <link rel="stylesheet" href="../css/postular.css">
  <script src="../JavaScript/fecha.js" defer></script>
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
          <select id="cargo" name="cargo_postulante">
            <option value="" selected>Seleccione un cargo</option>
            <option value="Gerente de Ventas" data-fechalimite="2024-01-29">Gerente de Ventas</option>
            <option value="Gerente General" data-fechalimite="2024-01-30">Gerente General</option>
            <option value="Mecánico" data-fechalimite="2024-01-29 ">Mecánico</option>
            <option value="Recepcionista" data-fechalimite="2024-01-26">Recepcionista</option>
          </select>
        </article>
        <div id="message-container" class="message"></div>


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


    <section class="informacion">
      <article>
        <div>
          <h4>GERENTE DE VENTAS</h4>
          <ul>
            <b>Principales responsabilidades: </b>
            <li>Desarrollo de estrategias de ventas </li>
            <li>Establecimiento de metas y objetivos </li>
            <b>Requisitos:</b>
            <li>Título en Administración de Empresas o carreras afines</li>
            <li>Elevado nivel de relaciones interpersonales</li>
            <li>Manejar situaciones imprevistas y resolver problemas de manera eficiente</li>
            <li>Habilidades de liderazgo</li>
          </ul>

        </div>

        <div>
          <ul>
            <h4>MECÁNICO</h4>
            <b>Principales responsabilidades: </b>
            <li>Diagnosticar y reparar problemas eléctricos y electrónicos en vehículos </li>
            <li>Trabajar en sistemas mecánicos, como motores, transmisiones y sistemas de suspensión</li>
            <li>Mantener actualizado con las últimas tecnologías automotrices y participar en la formación continua</li>
            <b>Requisitos</b>
            <li>Formación técnica en mecánica automotriz, preferiblemente con certificaciones o cursos adicionales.</li>
            <li>Amplios conocimientos en sistemas mecánicos, eléctricos y electrónicos de vehículos.</li>

          </ul>
        </div>
      </article>

      <article>
        <div>
          <H4>GERENTE GENERAL</H4>
          <ul>
            <b>Principales responsabilidades: </b>
            <li>Planificación estratégica </li>
            <li>Desarrollo de negocios </li>
            <li>Desarrollo de políticas y procedimientos</li>
            <b>Requisitos: </b>
            <li>Título en Administración de Empresas, Gerencia de Empresas o carreras afines</li>
            <li>Habilidades de comunicación </li>
            <li>Capacidad analítica</li>
            <li>Innovación y Adaptación </li>
            <li>Habilidades de liderazgo</li>
          </ul>

        </div>
        <div>

          <h4>RECEPCIONISTA</h4>
          <ul>
            <b>Principales responsabilidades: </b>
            <li>Proporcionar información básica sobre los servicios y productos de la concesionaria.</li>
            <li>Programar y gestionar citas para servicios de mantenimiento, reparación y ventas.</li>
            <li>Contestar llamadas telefónicas y dirigirlas a la persona o departamento adecuado.</li>
            <b>Requisitos: </b>
            <li>Diplomado de secundaria o equivalente </li>
            <li>Excelentes habilidades de comunicación verbal y escrita</li>
            <li>Capacidad para interactuar de manera efectiva con clientes, empleados y proveedores.</li>
          </ul>

        </div>
      </article>



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
        $sqlInsertPostulante = "INSERT INTO postulante (id_persona, cv, cedula_escaneada, estudios_postulante, cargo_postulante) 
                                    VALUES ('$id_persona', '$ruta_cv', '$ruta_cedula', '$ruta_estudios','$cargo')";
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
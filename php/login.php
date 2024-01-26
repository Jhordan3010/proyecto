

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="../css/loggin-postulante.css">
</head>
<body>

  <header>
    <h1>Concesionario</h1>
  </header>
  <main>
    <article>

      <img src="../imagenes/renault.png" alt="">
      <h2>Iniciar Sesión Postulante</h2>

      <form action="check/checkloginpostulante.php" method="POST">
           Ingrese Usuario: <input type="text" name="username" required="required"  /> <br/>
           Ingrese Contraseña: <input type="password" name="password" required="required"  /> <br/>
           <input type="submit" value="Autentificarse"/>
        </form>

      <p id="error-message" class="error-message"><?php echo isset($error_message) ? $error_message : ""; ?></p>
      <a href="../php/sesionpostulante.php">Registrar Postulante</a>

    </article>
  </main>

</body>
</html>

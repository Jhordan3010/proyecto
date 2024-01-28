  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/loggin-postulante.css">

    
  </head>
  <body>

    <header>
      <h1>Concensionario</h1>
    </header>
    <main>
      <article>

        <img src="../imagenes/renault.png" alt="">
        <h2>Iniciar Sesión Postulante</h2>
        
        <form id="login-form" action="../php/conexion.php" method="post">
          
          <section class="input-group">
            <label for="username">Ingrese Usuario:</label>

              <input type="text" id="username" name="username" required>
          </section>
    
          <section class="input-group">
            <label for="password">Ingrese Contraseña:</label>
            <input type="password" id="password" name="password" required>
          </section>
          <button type="submit">Iniciar Sesión</button>
    
        </form>


      </article>

    </main>


        

    
  </body>
  </html>
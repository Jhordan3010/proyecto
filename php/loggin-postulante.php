  <!DOCTYPE html>
  <html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/loggin-postulantes.css">
    <script>
        function enviarValor() {
    var valor = document.getElementById('username').value;
    localStorage.setItem('valorCompartido', valor);45
    window.location.href = 'perfil-postulante.php';
}
    </script>
    
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
            <input type="password" id="passwd" name="passwd" required>
          </section>
          <button type="submit" onclick="enviarValor()">Iniciar Sesión</button>
    
        </form>
        <a href="sesionpostulante.php">
          <button  >Crear Cuenta</button>
        </a>


      </article>

    </main>


        

    
  </body>
  </html>
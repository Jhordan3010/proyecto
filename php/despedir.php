<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/desvincular.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1, initial-scale=1.0">
    <title>Recursos humanos</title>
</head>
<body>
    <header>
        <h1>Despedir empleado</h1>
    </header>

    <main>
        <form action="" method="post">
            <section class="buscar-info">
                <label for="CI">Cédula Empleado</label>
                <input type="text" name="CI" required>
                <button type="submit" name="buscar">Buscar</button>
            </section>
        </form>

        <section class="section-borders">
            <label id="informacion-empleado" for="info-empleado"></label>
        </section>

        <form action="" method="post">
            <input type="hidden" name="id_persona" id="hiddenIdPersona" value="" required>
            <!-- Puedes agregar campos adicionales si es necesario mostrar más información del empleado -->
            <button type="submit" id="despedir-button" name="despedir">Despedir</button>
        </form>
    </main>

    <footer>
    </footer>

    
</body>
</html>





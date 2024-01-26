<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/entrevista.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerente de Ventas</title>
</head>

<body>
    <header>
        <h1>Entrevista Gerente de Ventas</h1>
    </header>
    <main>
        <section>
            <img src="../imagenes/renault.png" alt="">
            
            <form class="preguntas" action="" method="POST">
                <label for="cedula_postulante">Cédula del postulante:</label>
                <input type="text" id="cedula_postulante" name="cedula_postulante" required>
                <label>1. ¿Cuántos años de experiencia tiene en roles de ventas?</label>
                <select name="experiencia">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Menos de 2 años">Menos de 2 años</option>
                    <option value="2-5 años">2-5 años</option>
                    <option value="5-10 años">5-10 años</option>
                    <option value="Más de 10 años">Más de 10 años</option>
                </select>
                <label>2. ¿Cuál de las siguientes estrategias considera más efectiva para aumentar las ventas?</label> 
                <select name="estrategia" >
                    <option value="" disabled selected>Seleccione una opción</option>

                    <option value="Desarrollo de relaciones con clientes existentes">Desarrollo de relaciones con clientes existentes</option>
                    <option value="Prospección activa de nuevos clientes">Prospección activa de nuevos clientes</option>
                    <option value="Utilización de tecnologías de venta en línea">Utilización de tecnologías de venta en línea</option>
                    <option value="Personalización de ofertas según el perfil del cliente">Personalización de ofertas según el perfil del cliente</option>
                </select>

                <label for="motivacion">3. Cuando se trata de motivar a un equipo de ventas, ¿cuál de las siguientes acciones considera más impactante?</label>
                <select id="motivacion" name="motivacion" required >
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Bonificaciones y recompensas financieras">Bonificaciones y recompensas financieras</option>
                    <option value="Reconocimiento público por logros">Reconocimiento público por logros</option>
                    <option value="Oportunidades de desarrollo profesional">Oportunidades de desarrollo profesional</option>
                    <option value="Creación de un ambiente de trabajo colaborativo">Creación de un ambiente de trabajo colaborativo</option>
                </select>
        
                <label for="objeciones">4. ¿Cómo aborda las objeciones de los clientes durante el proceso de ventas?</label>
                <select id="objeciones" name="objeciones" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Identificando las preocupaciones y ofreciendo soluciones personalizadas">Identificando las preocupaciones y ofreciendo soluciones personalizadas</option>
                    <option value="Destacando los beneficios clave del producto/servicio">Destacando los beneficios clave del producto/servicio</option>
                    <option value="Demostrando casos de éxito de clientes anteriores">Demostrando casos de éxito de clientes anteriores</option>
                    <option value="Todas las anteriores">Todas las anteriores</option>
                </select>
                <label for="seguimiento">5. ¿Cómo realiza el seguimiento del desempeño individual de los miembros de su equipo?</label>
                <select id="seguimiento" name="seguimiento" required>
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Revisión regular de métricas de ventas">Revisión regular de métricas de ventas</option>
                    <option value="Evaluaciones de desempeño formales">Evaluaciones de desempeño formales</option>
                    <option value="Sesiones de retroalimentación uno a uno">Sesiones de retroalimentación uno a uno</option>
                    <option value="Implementación de sistemas de reconocimiento">Implementación de sistemas de reconocimiento</option>
                </select>

                <button type="submit">Enviar</button>
            </form>

        </section>

    </main>
    <?php
$servername = 'localhost';
$username = 'Jhordan';
$password = '123456789';
$dbname = 'midb_proyecto';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula_postulante = $_POST["cedula_postulante"];
    $experiencia = $_POST["experiencia"];
    $estrategia = $_POST["estrategia"];
    $motivacion = $_POST["motivacion"];
    $objeciones = $_POST["objeciones"];
    $seguimiento = $_POST["seguimiento"];

    $sql_entrevista_ventas = "INSERT INTO entrevista_ventas (experiencia, estrategia, motivacion, objeciones, seguimiento, CI)
                               VALUES ('$experiencia', '$estrategia', '$motivacion', '$objeciones', '$seguimiento', '$cedula_postulante')";

    if ($conn->query($sql_entrevista_ventas) === TRUE) {
        echo "<p>Entrevista registrada correctamente.</p>";
    } else {
        echo "<p>Error al registrar la entrevista: " . $conn->error . "</p>";
    }
}

$conn->close();
?>


</body>

</html>



<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$conn = conectar("midb_proyecto");

$sql = "SELECT * FROM usuario WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Ajusta los nombres de los campos según tu estructura de tabla
    $nombre = $row['nombre']; 
    $apellido = $row['apellido'];

    // Obtén el ID del usuario
    $usuarioID = $row['id']; 
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>

<body>
    <h1>Bienvenido, <?php echo $nombre . ' ' . $apellido; ?></h1>
    <p>Tu ID de usuario es: <?php echo $usuarioID; ?></p>
    <!-- Puedes agregar más información del perfil aquí -->
    <a href="logout.php">Cerrar sesión</a>
</body>

</html>

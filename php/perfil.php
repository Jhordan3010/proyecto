

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $nombre . ' ' . $apellido; ?></h1>
    <p>Tu ID de usuario es: <?php echo $idPersona; ?></p>
    <!-- Puedes agregar más información del perfil aquí -->
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>

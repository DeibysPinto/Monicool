<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "monicool";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['contraseña'])) {
        die("Por favor, complete todos los campos del formulari.");
    }
    
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    $conexion = new mysqli($server, $user, $pass, $db);
    if($conexion->connect_errno) {
        die("Conección fallida: " . $conexion->connect_error);
    }

    $consulta_email = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado_email = $conexion->query($consulta_email);
    if ($resultado_email->num_rows > 0) {
        die("El correo electrónico ya está en uso.");
    }

    $consulta_nombre = "SELECT * FROM usuario WHERE nombre = '$nombre'";
    $resultado_nombre = $conexion->query($consulta_nombre);
    if ($resultado_nombre->num_rows > 0) {
        die("El nombre de usuario ya está en uso.");
    }

    $sql = "INSERT INTO usuario (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";
    if ($conexion->query($sql) === TRUE) {
        echo "Usuario creado correctamente";
    } else {
        echo "Error al crear usuario: " . $conexion->error;
    }

    $conexion->close();
}
?>

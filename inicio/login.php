<?php
global $conn;
include 'db_config.php'; // Asume que tienes un archivo db_config.php para la configuración de la base de datos

// Comprobar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $usuario = $conn->real_escape_string($_POST['email']);
    $contraseña = $_POST['password'];

    // Preparar la consulta SQL para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT contraseña FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Preparar la consulta SQL para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT contraseña FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashContraseña = $row['contraseña'];
        // Verificar si la contraseña es correcta
        if (password_verify($contraseña, $hashContraseña)) {
            // Contraseña correcta, redirigir al usuario a la página principal
            header("Location: inicio/inicio.html");
            exit();
        } else {
            // Contraseña incorrecta, mostrar un mensaje de error o algo similar
            echo "Contraseña incorrecta, regresando a LOGIN.";
            echo "<script>setTimeout(function(){ window.location.href = 'login.html'; }, 3000);</script>";
        }
    } else {
        // Usuario no encontrado, mostrar un mensaje de error o algo similar
        echo "Usuario no encontrado";
    }

    $stmt->close();
    $conn->close();
}
?>

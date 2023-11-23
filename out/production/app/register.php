<?php
global $conn;
include 'db_config.php'; // Asegúrate de que este archivo contiene la información correcta para conectarte a tu base de datos

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y sanitizar los datos del formulario
    $name = $conn->real_escape_string($_POST['new-email']);
    $password = password_hash($_POST['new-password'], PASSWORD_DEFAULT); // Hash de la contraseña

    // Preparar la sentencia SQL para insertar los datos
    $stmt = $conn->prepare("INSERT INTO user (Name, Password) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $password); // 'ss' indica que ambos parámetros son strings

    // Ejecutar la sentencia y verificar si fue exitosa
    if ($stmt->execute()) {
        echo "Nuevo usuario registrado con éxito.";
        echo ", redirigiendo a LOGIN.";
        echo "<script>setTimeout(function(){ window.location.href = 'login.html'; }, 4000);</script>";
        // Aquí puedes redirigir al usuario o realizar otras acciones necesarias
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // Redireccionar a la página del formulario si se accede a este script de manera incorrecta
    header("Location: register.html");
    exit();
}

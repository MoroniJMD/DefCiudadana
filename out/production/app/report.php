<?php
global $conn;
include 'db_config.php'; // Asegúrate de que este archivo contiene la configuración de tu base de datos

session_start();
define("ID_USUARIO_INVITADO", 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_Id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ID_USUARIO_INVITADO;
    $location = $conn->real_escape_string($_POST['location']);
    $description = $conn->real_escape_string($_POST['description']);
    $status = "Nuevo"; // Estado inicial del reporte

    $stmt = $conn->prepare("INSERT INTO reportes (user_id, location, description, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_Id, $location, $description, $status);

    if ($stmt->execute()) {
        echo "Reporte enviado con éxito";
        echo "<script>setTimeout(function(){ window.location.href = 'usuario/historial.html'; }, 3000);</script>";
    } else {
        echo "Error: " . $stmt->error;
        echo "<script>setTimeout(function(){ window.location.href = 'inicio/inicio.html'; }, 3000);</script>";
        // Considera registrar este error en un archivo de log
    }

    $stmt->close();
}
$conn->close();
?>

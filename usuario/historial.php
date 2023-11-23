<?php
global $conn;
include 'db_config.php';

session_start();
$user_id = $_SESSION['user_id'] ?? 0;

$sql = "SELECT * FROM reportes WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result->fetch_assoc()) {
    echo '<div id="report-card">';
    echo '<label>Ubicación:</label>';
    echo '<input type="text" value="' . htmlspecialchars($row['location']) . '" readonly>';
    echo '<label>Descripción:</label>';
    echo '<textarea readonly>' . htmlspecialchars($row['description']) . '</textarea>';
    // Agregar manejo de fotos si es necesario
    echo '</div>';
}
?>

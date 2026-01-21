<?php
require 'config.php';

$id = $_GET['id'] ?? 0;

// Valida ID antes de excluir
if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM sensor_readings WHERE id = ?");
    if ($stmt->execute([$id])) {
        header('Location: index.php?deleted=1');
        exit;
    }
}

// Se falhar, volta com erro
header('Location: index.php?error=1');
exit;
?>

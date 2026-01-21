<?php
require 'config.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? '';

// READ - Pega todos sensores
if ($action === 'read') {
    $stmt = $pdo->query("SELECT id, device_id, temperature, humidity, pressure, setor FROM sensor_readings ORDER BY id DESC LIMIT 50");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

// UPDATE - Atualiza valores todos sensores
if ($action === 'update_all') {
    $stmt = $pdo->query("SELECT id FROM sensor_readings");
    $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($ids as $id) {
        $temp = 18 + mt_rand(0, 3200) / 100;
        $hum = 25 + mt_rand(0, 750) / 10;
        $press = 990 + mt_rand(0, 500) / 10;
        
        $upd = $pdo->prepare("UPDATE sensor_readings SET temperature=?, humidity=?, pressure=? WHERE id=?");
        $upd->execute([$temp, $hum, $press, $id]);
    }
    
    echo json_encode(['status' => 'ok']);
    exit;
}

// GET BY SETOR
if ($action === 'by_setor') {
    $setor = $_GET['setor'] ?? 'Todos';
    if ($setor === 'Todos') {
        $stmt = $pdo->query("SELECT id, device_id, temperature, humidity, pressure, setor FROM sensor_readings ORDER BY id DESC");
    } else {
        $stmt = $pdo->prepare("SELECT id, device_id, temperature, humidity, pressure, setor FROM sensor_readings WHERE setor=? ORDER BY id DESC");
        $stmt->execute([$setor]);
    }
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

echo json_encode(['error' => 'Invalid']);
?>

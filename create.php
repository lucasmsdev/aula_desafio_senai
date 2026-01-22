<?php
require 'config.php';
$message = '';

if ($_POST) {
    $device_id = trim($_POST['device_id']);
    $setor = $_POST['setor'] ?? 'Geral';
    
    if (strlen($device_id) >= 3) {
        $temp = 22 + mt_rand(0, 1800) / 100;
        $hum = 40 + mt_rand(0, 500) / 10;
        $press = 1005 + mt_rand(-50, 50) / 10;
        
        $stmt = $pdo->prepare("INSERT INTO sensor_readings (device_id, temperature, humidity, pressure, setor) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$device_id, $temp, $hum, $press, $setor])) {
            header('Location: index.php?created=1');
            exit;
        }
    } else {
        $message = 'ID deve ter 3 ou mais caracteres';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div style="max-width: 500px; margin: 5rem auto;">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Novo Sensor IoT</h2>
                </div>
                <div class="card-body">
                    <?php if ($message): ?>
                        <div class="alert alert-danger"><?= $message ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">ID do Dispositivo</label>
                            <input type="text" name="device_id" class="form-control" required placeholder="SalaA-Sensor1" maxlength="50">
                            <small class="text-muted">Mínimo 3 caracteres</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Setor</label>
                            <select name="setor" class="form-select" required>
                                <option value="">-- Escolha um setor --</option>
                                <option value="Sala">Sala / Interno</option>
                                <option value="Fabrica">Fábrica</option>
                                <option value="Externa">Externa</option>
                                <option value="Armazem">Armazém</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 fw-bold">Criar Sensor</button>
                        <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

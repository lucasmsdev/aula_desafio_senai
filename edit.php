<?php
require 'config.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM sensor_readings WHERE id=?");
$stmt->execute([$id]);
$sensor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$sensor) {
    header('Location: index.php');
    exit;
}

if ($_POST) {
    $device_id = trim($_POST['device_id']);
    $setor = $_POST['setor'];
    
    $stmt = $pdo->prepare("UPDATE sensor_readings SET device_id=?, setor=? WHERE id=?");
    if ($stmt->execute([$device_id, $setor, $id])) {
        header('Location: index.php?updated=1');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <div style="max-width: 500px; margin: 5rem auto;">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Editar Sensor #<?= $id ?></h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">ID do Dispositivo</label>
                            <input type="text" name="device_id" class="form-control" value="<?= htmlspecialchars($sensor['device_id']) ?>" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Setor</label>
                            <select name="setor" class="form-select" required>
                                <option value="Sala" <?= $sensor['setor'] === 'Sala' ? 'selected' : '' ?>>Sala / Interno</option>
                                <option value="Fabrica" <?= $sensor['setor'] === 'Fabrica' ? 'selected' : '' ?>>Fábrica</option>
                                <option value="Externa" <?= $sensor['setor'] === 'Externa' ? 'selected' : '' ?>>Externa</option>
                                <option value="Armazem" <?= $sensor['setor'] === 'Armazem' ? 'selected' : '' ?>>Armazém</option>
                                <option value="Geral" <?= $sensor['setor'] === 'Geral' ? 'selected' : '' ?>>Geral</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 fw-bold">Salvar Alterações</button>
                        <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

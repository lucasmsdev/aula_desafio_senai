<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoT Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php 
    // Mostra alerta de sucesso quando exclui
    if (isset($_GET['deleted'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Sensor removido!',
                    text: 'O sensor foi excluído com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#c0392b'
                });
            });
        </script>
    <?php endif; ?>

    <?php 
    // Mostra alerta de erro
    if (isset($_GET['error'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Não foi possível excluir o sensor.',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#c0392b'
                });
            });
        </script>
    <?php endif; ?>

    <div class="container mt-5">
        <header>
            <h1>IoT Dashboard</h1>
            <p>Monitoramento de Sensores por Setor</p>
        </header>

        <div class="mb-4">
            <a href="create.php" class="btn btn-success btn-lg">Novo Sensor</a>
        </div>

        <div class="status-bar" id="statusBar">Carregando sensores...</div>

        <!-- Abas para selecionar setores -->
        <div class="sectors-tabs">
            <button class="tab-btn active" data-setor="Todos">Todos</button>
            <button class="tab-btn" data-setor="Sala">Sala</button>
            <button class="tab-btn" data-setor="Fabrica">Fábrica</button>
            <button class="tab-btn" data-setor="Externa">Externa</button>
            <button class="tab-btn" data-setor="Armazem">Armazém</button>
            <button class="tab-btn" data-setor="Geral">Geral</button>
        </div>

        <!-- Gauges dos setores -->
        <div class="gauges-grid" id="gaugesGrid">
            <p style="grid-column: 1/-1; text-align: center; padding: 3rem;">Carregando gauges...</p>
        </div>

        <!-- Tabela de sensores -->
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sensor</th>
                        <th>Setor</th>
                        <th>Temperatura</th>
                        <th>Umidade</th>
                        <th>Pressão</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="sensorTable">
                    <tr><td colspan="7" class="text-center">Carregando...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="assets/script.js"></script>
</body>
</html>

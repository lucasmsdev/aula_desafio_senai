// Armazena gráficos criados
let currentCharts = {};

// Configura clique nas abas de setores
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelector('.tab-btn.active').classList.remove('active');
        this.classList.add('active');
        loadSetor(this.dataset.setor);
    });
});

// Inicia o dashboard ao carregar página
document.addEventListener('DOMContentLoaded', () => {
    console.log('Dashboard iniciado');
    loadSetor('Todos');
    startLiveUpdates();
});

// Carrega sensores do setor escolhido
async function loadSetor(setor) {
    try {
        const response = await fetch(`api.php?action=by_setor&setor=${setor}`);
        const sensors = await response.json();
        
        console.log(`Setor ${setor}: ${sensors.length} sensores`);
        
        renderGauges(setor, sensors);
        updateTable(sensors);
        document.getElementById('statusBar').textContent = `Sensores ativos: ${sensors.length}`;
    } catch (e) {
        console.error('Erro:', e);
    }
}

// Renderiza os gauges circulares com dados
function renderGauges(setor, sensors) {
    const grid = document.getElementById('gaugesGrid');
    
    if (sensors.length === 0) {
        grid.innerHTML = `<p style="grid-column: 1/-1; text-align: center; padding: 3rem;">Nenhum sensor neste setor</p>`;
        return;
    }
    
    // Calcula valores médios dos sensores
    const avgTemp = sensors.reduce((a, s) => a + Number(s.temperature), 0) / sensors.length;
    const avgHum = sensors.reduce((a, s) => a + Number(s.humidity), 0) / sensors.length;
    const avgPress = sensors.reduce((a, s) => a + Number(s.pressure), 0) / sensors.length;
    
    // Monta HTML dos gauges
    grid.innerHTML = `
        <div class="sector-panel">
            <div class="sector-title">${setor}</div>
            <div class="gauges-container">
                <div class="gauge">
                    <div style="position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <canvas id="tempGauge" style="position: absolute; top: 0; left: 0;"></canvas>
                        <div class="gauge-value" style="position: relative;">${avgTemp.toFixed(1)}°</div>
                    </div>
                    <div class="gauge-label">Temperatura</div>
                </div>
                <div class="gauge">
                    <div style="position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <canvas id="humGauge" style="position: absolute; top: 0; left: 0;"></canvas>
                        <div class="gauge-value" style="position: relative;">${avgHum.toFixed(1)}%</div>
                    </div>
                    <div class="gauge-label">Umidade</div>
                </div>
                <div class="gauge">
                    <div style="position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                        <canvas id="pressGauge" style="position: absolute; top: 0; left: 0;"></canvas>
                        <div class="gauge-value" style="position: relative;">${avgPress.toFixed(1)}</div>
                    </div>
                    <div class="gauge-label">Pressão</div>
                </div>
            </div>
        </div>
    `;
    
    // Cria gráficos circulares
    createGauge('tempGauge', avgTemp, 15, 45, '#c0392b');
    createGauge('humGauge', avgHum, 0, 100, '#666666');
    createGauge('pressGauge', avgPress, 600, 1200, '#1a1a1a');

}

// Cria um gauge circular com Chart.js
function createGauge(canvasId, value, min, max, color) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;
    
    // Calcula percentual do valor
    const percent = ((value - min) / (max - min)) * 100;
    const ctx = canvas.getContext('2d');
    
    // Destrói gráfico anterior se existir
    if (currentCharts[canvasId]) currentCharts[canvasId].destroy();
    
    // Cria novo gráfico
    currentCharts[canvasId] = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [percent, 100 - percent],
                backgroundColor: [color, '#f0f0f0'],
                borderColor: ['transparent', 'transparent'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            circumference: 180,
            rotation: 270,
            cutout: '80%',
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });
}

// Atualiza tabela com dados dos sensores
function updateTable(sensors) {
    const tbody = document.getElementById('sensorTable');
    
    if (sensors.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center">Nenhum sensor</td></tr>';
        return;
    }
    
    // Monta linhas da tabela
    tbody.innerHTML = sensors.map(s => `
        <tr>
            <td>#${s.id}</td>
            <td>${s.device_id}</td>
            <td><span class="badge badge-setor">${s.setor}</span></td>
            <td><strong>${Number(s.temperature).toFixed(1)}°C</strong></td>
            <td>${Number(s.humidity).toFixed(1)}%</td>
            <td>${Number(s.pressure).toFixed(1)} hPa</td>
            <td>
                <a href="edit.php?id=${s.id}" class="btn btn-warning">Editar</a>
                <a href="javascript:void(0)" class="btn btn-danger" onclick="confirmDelete(${s.id})">Excluir</a>
            </td>
        </tr>
    `).join('');
}

// Confirma exclusão com SweetAlert
function confirmDelete(id) {
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Este sensor será removido permanentemente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#c0392b',
        cancelButtonColor: '#95a5a6',
        confirmButtonText: 'Sim, remover!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Se confirmar, redireciona para delete.php
            window.location.href = `delete.php?id=${id}`;
        }
    });
}

// Atualiza valores dos sensores a cada 3 segundos
function startLiveUpdates() {
    setInterval(async () => {
        try {
            // Faz update em todos os dados
            await fetch('api.php?action=update_all');
            // Carrega setor ativo
            const activeTab = document.querySelector('.tab-btn.active').dataset.setor;
            loadSetor(activeTab);
        } catch (e) {
            console.error('Erro de atualização:', e);
        }
    }, 3000);
}

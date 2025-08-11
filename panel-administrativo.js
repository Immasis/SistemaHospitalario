document.addEventListener("DOMContentLoaded", () => {
    cargarEstadisticas();
});

function cargarEstadisticas() {
    fetch('obtener_estadisticas.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la red');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('total-citas').textContent = data.total_citas;
            document.getElementById('citas-confirmadas').textContent = data.citas_confirmadas;
            document.getElementById('citas-pendientes').textContent = data.citas_pendientes;
            document.getElementById('citas-canceladas').textContent = data.citas_canceladas;
        })
        .catch(error => {
            console.error('Error al cargar las estadísticas:', error);
            document.getElementById('total-citas').textContent = '0';
            document.getElementById('citas-confirmadas').textContent = '0';
            document.getElementById('citas-pendientes').textContent = '0';
            document.getElementById('citas-canceladas').textContent = '0';
        });
}
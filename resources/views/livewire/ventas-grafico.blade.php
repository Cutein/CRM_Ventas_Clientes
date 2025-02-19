<div>
    <canvas id="ventasChart"></canvas>
    <!-- Cargar Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let ventasChartInstance = null; // Variable global para almacenar la instancia del gráfico

        function renderVentasChart() {
            if (typeof Chart === 'undefined') {
                console.error("Chart.js no está cargado aún.");
                return;
            }

            const canvas = document.getElementById('ventasChart');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');

            let ventasData = @json($ventasData->pluck('total'));
            let fechas = @json($ventasData->pluck('fecha'));

            // Si no hay datos, agregamos un punto con valor 0 en la fecha actual
            if (ventasData.length === 0) {
                fechas = [new Date().toISOString().split('T')[0]]; // Fecha de hoy
                ventasData = [0];
            }

            // Si ya existe un gráfico en este canvas, lo destruimos
            if (ventasChartInstance) {
                ventasChartInstance.destroy();
            }

            // Crear el gráfico
            ventasChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($ventasData->pluck('fecha')),
                    datasets: [{
                        label: 'Ventas (USD)',
                        data: @json($ventasData->pluck('total')),
                        borderColor: 'rgb(75, 192, 192)',
                        fill: false,
                        tension: 0.4
                    }]
                }
            });
        }

        // Ejecutar cuando la página se carga completamente
        document.addEventListener("DOMContentLoaded", renderVentasChart);

        // Ejecutar cuando Livewire navega sin recargar
        document.addEventListener("livewire:navigated", function() {
            setTimeout(renderVentasChart, 300); // Esperamos un poco para asegurarnos de que Chart.js esté cargado
        });
    </script>
</div>

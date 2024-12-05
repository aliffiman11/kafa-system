<x-app-layout>
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-semibold mb-4">Payment Status Graph</h2>
        <canvas id="paymentStatusGraph"></canvas>

        <h2 class="text-2xl font-semibold mb-4">Payment Method Comparison Graph</h2>
        <canvas id="paymentMethodComparisonGraph"></canvas>

        <h2 class="text-2xl font-semibold mb-4">Payment Type Graph</h2>
        <canvas id="paymentTypeGraph"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data from the Controller (Corrected)
        const paymentStatusData = @json($paymentStatusData);
        const paymentMethodData = @json($paymentMethodData);
        const paymentTypeData = @json($paymentTypeData);

        // Chart Rendering Function
        function renderBarChart(canvasId, data, label, colors) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: label,
                        data: Object.values(data),
                        backgroundColor: colors,
                        borderColor: colors.map(c => c.replace('0.5', '1')),
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Render Charts
        renderBarChart('paymentStatusGraph', paymentStatusData, 'Payment Status', ['rgba(255, 99, 132, 0.5)']);
        renderBarChart('paymentMethodComparisonGraph', paymentMethodData, 'Payment Method', ['rgba(106, 90, 205, 0.5)', 'rgba(54, 162, 235, 0.5)', 'rgba(255, 206, 86, 0.5)']);
        renderBarChart('paymentTypeGraph', paymentTypeData, 'Payment Type', ['rgba(255, 206, 86, 0.5)']);
    </script>
</x-app-layout>

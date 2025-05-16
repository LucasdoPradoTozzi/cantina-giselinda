<div>
    <div class="w-full h-[80vh] flex items-center justify-center bg-white rounded-lg shadow-lg my-8 p-6">
        <canvas id="mostSoldProducts" style="max-width: 900px; max-height: 80vh;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function renderBestSellersChart() {
            var bestSellers = @json($bestSellers);
            var soldCanvas = document.getElementById('mostSoldProducts');
            if (!soldCanvas) return;
            var soldCtx = soldCanvas.getContext('2d');
            // Destroy previous chart instance if exists
            if (window.soldChart) {
                window.soldChart.destroy();
            }
            // Convert bar chart data to pie chart data
            var pieData = {
                labels: bestSellers.labels,
                datasets: [{
                    label: bestSellers.datasets[0].label,
                    data: bestSellers.datasets[0].data,
                    backgroundColor: [
                        '#4F46E5', '#6366F1', '#818CF8', '#A5B4FC', '#C7D2FE'
                    ],
                    borderColor: '#fff',
                    borderWidth: 3
                }]
            };
            window.soldChart = new Chart(soldCtx, {
                type: 'pie',
                data: pieData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right',
                            labels: {
                                color: '#1e293b',
                                font: {
                                    size: 18,
                                    weight: 'bold',
                                    family: 'Montserrat, sans-serif'
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Top 5 Produtos Mais Vendidos',
                            color: '#1e293b',
                            font: {
                                size: 28,
                                weight: 'bold',
                                family: 'Montserrat, sans-serif'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#6366F1',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#818CF8',
                            borderWidth: 2,
                            padding: 16,
                            caretSize: 10,
                            cornerRadius: 10,
                            bodyFont: {
                                size: 18,
                                family: 'Montserrat, sans-serif'
                            },
                            titleFont: {
                                size: 20,
                                weight: 'bold',
                                family: 'Montserrat, sans-serif'
                            }
                        }
                    },
                    layout: {
                        padding: 40
                    },
                    animation: {
                        duration: 1400,
                        easing: 'easeOutBounce'
                    }
                }
            });
        }

        document.addEventListener('livewire:navigated', renderBestSellersChart);
        document.addEventListener('DOMContentLoaded', renderBestSellersChart);
    </script>
</div>
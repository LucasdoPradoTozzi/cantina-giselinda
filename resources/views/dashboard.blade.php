<x-layout>

    <div class="w-96 h-96">
        <canvas id="mostSoldProducts"></canvas>
    </div>

    <script>
        $(document).ready(function() {
            const mostSoldProducts = $('#mostSoldProducts');

            $.ajax({
                url: '/dashboard/best-sellers',
                type: 'GET',
                success: function(data) {
                    new Chart(mostSoldProducts, {
                        type: 'bar',
                        data: data,
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Top 5 produtos mais vendidos'
                                }
                            }
                        },
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
</x-layout>
<div class="w-full md:w-1/2 mx-auto">
    <canvas id="pieChart" width="20" height="60"></canvas>
</div>

@section('end-scripts-2')
    <script>
        Chart.defaults.font.size = 20;
        Chart.defaults.font.family = 'vazir';
        const ctx_pie_chart = document.getElementById('pieChart').getContext('2d');

        let data_pie = {
            labels: [
                @foreach ($labels as $label)
                    "{{ $label }}",
                @endforeach
            ],
            datasets: [{
                label: 'Chart',
                data: [
                    @foreach ($data as $item)
                        "{{ $item }}",
                    @endforeach
                ],
                backgroundColor: [
                    'rgb(0,200,255, 0.7)',
                    'rgb(107,205,77, 0.7)',
                    'rgb(58,23,47, 0.7)',
                    'rgb(241,200,51, 0.7)',
                    'rgb(0,69,165, 0.7)',
                    'rgb(213,86,12, 0.7)',
                    'rgb(70,27,45, 0.7)',
                    'rgb(6,64,21, 0.7)',
                    'rgb(0,97,26, 0.7)',
                    'rgb(43,23,57, 0.7)',
                    'rgb(27,10,41, 0.7)',
                    'rgb(56,11,90, 0.7)',
                    'rgb(78,227,230, 0.7)',
                    'rgb(6,132,37, 0.7)',
                    'rgb(53,21,78, 0.7)',
                    'rgb(94,37,37, 0.7)',
                    'rgb(0,116,220, 0.7)',
                    'rgb(153,51,14, 0.7)',
                    'rgb(121,41,23, 0.7)',
                    'rgb(6,48,37, 0.7)',
                    'rgb(21,27,117, 0.7)',
                    'rgb(6,170,37, 0.7)',
                    'rgb(100,65,227, 0.7)',
                    'rgb(64,17,134, 0.7)',
                    'rgb(76,36,178, 0.7)',
                ],
                borderColor: [
                    'rgb(0,200,255, 1)',
                    'rgb(107,205,77, 1)',
                    'rgb(58,23,47, 1)',
                    'rgb(241,200,51, 1)',
                    'rgb(0,69,165, 1)',
                    'rgb(213,86,12, 1)',
                    'rgb(70,27,45, 1)',
                    'rgb(6,64,21, 1)',
                    'rgb(0,97,26, 1)',
                    'rgb(43,23,57, 1)',
                    'rgb(27,10,41, 1)',
                    'rgb(56,11,90, 1)',
                    'rgb(78,227,230, 1)',
                    'rgb(6,132,37, 1)',
                    'rgb(53,21,78, 1)',
                    'rgb(94,37,37, 1)',
                    'rgb(0,116,220, 1)',
                    'rgb(153,51,14, 1)',
                    'rgb(121,41,23, 1)',
                    'rgb(6,48,37, 1)',
                    'rgb(21,27,117, 1)',
                    'rgb(6,170,37, 1)',
                    'rgb(100,65,227, 1)',
                    'rgb(64,17,134, 1)',
                    'rgb(76,36,178, 1)',
                ],
                borderWidth: 1
            }]
        };

        let options_pie = {
            tooltips: {
                enabled: false
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 20,
                            family: 'vazir',
                        }
                    }
                },
                datalabels: {
                    formatter: (value, ctx_pie_chart) => {
                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value * 100 / sum).toFixed(2) + "%";
                        return percentage;
                    },
                    color: '#fff',
                }
            }
        };
        const pieChart = new Chart(ctx_pie_chart, {
            type: 'pie',
            data: data_pie,
            options: options_pie,
        });
    </script>
@endsection

<div class="mb-12">
    <canvas id="myChart" width="200" height="60"></canvas>
</div>

@section('end-scripts')
    <script>
        Chart.defaults.font.size = 20;
        Chart.defaults.font.family = 'vazir';
        
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($labels as $label)
                        "{{ $label }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'نمودار ساعتی',
                    data: [
                        @foreach ($data as $item)
                            "{{ $item }}",
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgb(1,36,89, 0.7)',
                        'rgb(0,57,114, 0.7)',
                        'rgb(0,57,114, 0.7)',
                        'rgb(0,67,114, 0.7)',
                        'rgb(0,67,114, 0.7)',
                        'rgb(1,103,146, 0.7)',
                        'rgb(7,114,159, 0.7)',
                        'rgb(18,161,192, 0.7)',
                        'rgb(116,212,204, 0.7)',
                        'rgb(239,238,188, 0.7)',
                        'rgb(254,225,84, 0.7)',
                        'rgb(253,195,82, 0.7)',
                        'rgb(255,172,111, 0.7)',
                        'rgb(253,166,90, 0.7)',
                        'rgb(253,158,88, 0.7)',
                        'rgb(241,132,72, 0.7)',
                        'rgb(240,107,126, 0.7)',
                        'rgb(202,90,146, 0.7)',
                        'rgb(91,44,131, 0.7)',
                        'rgb(55,26,121, 0.7)',
                        'rgb(40,22,107, 0.7)',
                        'rgb(25,40,97, 0.7)',
                        'rgb(4,11,60, 0.7)',
                        'rgb(4,11,60, 0.7)'
                    ],
                    borderColor: [
                        'rgb(1,36,89, 1)',
                        'rgb(0,57,114, 1)',
                        'rgb(0,57,114, 1)',
                        'rgb(0,67,114, 1)',
                        'rgb(0,67,114, 1)',
                        'rgb(1,103,146, 1)',
                        'rgb(7,114,159, 1)',
                        'rgb(18,161,192, 1)',
                        'rgb(116,212,204, 1)',
                        'rgb(239,238,188, 1)',
                        'rgb(254,225,84, 1)',
                        'rgb(253,195,82, 1)',
                        'rgb(255,172,111, 1)',
                        'rgb(253,166,90, 1)',
                        'rgb(253,158,88, 1)',
                        'rgb(241,132,72, 1)',
                        'rgb(240,107,126, 1)',
                        'rgb(202,90,146, 1)',
                        'rgb(91,44,131, 1)',
                        'rgb(55,26,121, 1)',
                        'rgb(40,22,107, 1)',
                        'rgb(25,40,97, 1)',
                        'rgb(4,11,60, 1)',
                        'rgb(4,11,60, 1)'
                    ],
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
    </script>
@endsection

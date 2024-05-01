<div class="mb-12">
    <canvas id="barChart2" width="200" height="60"></canvas>
</div>
<div class="mb-12">
    <canvas id="lineChart2" width="200" height="60"></canvas>
</div>

@section('end-scripts')
    <script>
        let borderColor = {
            1: 'rgb(255, 0, 0, 1)',
            2: 'rgb(0, 255, 255, 1)',
            3: 'rgb(0, 0, 255, 1)',
            4: 'rgb(255, 128, 0, 1)',
            5: 'rgb(255, 0, 255, 1)',
            6: 'rgb(0, 255, 128, 1)',
            7: 'rgb(128, 255, 0, 1)',
            8: 'rgb(0, 128, 255, 1)',
            9: 'rgb(255, 255, 0, 1)',
            10: 'rgb(128, 0, 255, 1)',
            11: 'rgb(0, 255, 0, 1)',
            12: 'rgb(255, 0, 128, 1)'
        };

        let backgroundColor = {
            1: 'rgb(255, 0, 0, 1)',
            2: 'rgb(0, 255, 255, 1)',
            3: 'rgb(0, 0, 255, 1)',
            4: 'rgb(255, 128, 0, 1)',
            5: 'rgb(255, 0, 255, 1)',
            6: 'rgb(0, 255, 128, 1)',
            7: 'rgb(128, 255, 0, 1)',
            8: 'rgb(0, 128, 255, 1)',
            9: 'rgb(255, 255, 0, 1)',
            10: 'rgb(128, 0, 255, 1)',
            11: 'rgb(0, 255, 0, 1)',
            12: 'rgb(255, 0, 128, 1)'
        };

        let datasets = [
            @foreach ($report->result as $dataset)
                {
                    label: "{{ $dataset['index'] }}",
                    data: [
                        @foreach ($dataset['data'] as $item)
                            "{{ $item }}",
                        @endforeach
                    ],
                    backgroundColor: backgroundColor[{{ $dataset['month'] }}],
                    borderColor: borderColor[{{ $dataset['month'] }}],
                    borderWidth: 1
                },
            @endforeach
        ];

        let labels = [
            @if (!blank($report->result))
                @foreach ($report->result[0]['labels'] as $label)
                    "{{ $label }}",
                @endforeach
            @endif
        ];

        let options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        const ctx_1 = document.getElementById('barChart2').getContext('2d');
        const barChart2 = new Chart(ctx_1, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: options
        });

        const ctx_2 = document.getElementById('lineChart2').getContext('2d');
        const lineChart2 = new Chart(ctx_2, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: options
        });
    </script>
@endsection

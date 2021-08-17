<script>
    var xValues = [];
    var yValues = [];
    var barColors = [];

    @if(!empty($data_jenis_rekap))
        @foreach($data_jenis_rekap as $key=> $data_items)
            xValues[{{ $key }}] = '{{ $data_items['jenis_tbk'] }}';
            yValues[{{ $key }}] = '{{ $data_items['total'] }}';
            barColors[{{ $key }}] = '#5cefde';
        @endforeach
    @endif


    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {display: false},
            title: {
                display: true,
                text: "Rekap persediaan per jenis barang"
            }
        }
    });
</script>


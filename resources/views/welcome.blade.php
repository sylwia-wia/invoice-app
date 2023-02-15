<x-layout>

    <div class="chart-container">
        <div class="bar-chart-container">
            <canvas id="bar-chart"></canvas>
        </div>
    </div>

    <!-- javascript -->

    <script>

        (async function() {
            let cData = JSON.parse(`<?php echo $chart_data; ?>`);
            // let ctx = $("#bar-chart");
            let ctx = document.getElementById('bar-chart');
            console.log(cData.data);

            //bar chart data
            let data = {
                labels: cData.label,
                datasets: [
                    {
                        label: "miesięczny przychód",
                        data: cData.data,
                        backgroundColor: [
                            "#DEB887",
                            "#A9A9A9",
                            "#DC143C",
                            "#F4A460",
                            "#2E8B57",
                            "#1D7A46",
                            "#CDA776",
                        ],
                        borderColor: [
                            "#CDA776",
                            "#989898",
                            "#CB252B",
                            "#E39371",
                            "#1D7A46",
                            "#F4A460",
                            "#CDA776",
                        ],
                        borderWidth: [1, 1, 1, 1, 1,1,1]
                    }
                ]
            };

            //options
            let options = {
                responsive: true,
                title: {
                    display: true,
                    position: "top",
                    text: "Przychód z ostatnich 12 miesięcy",
                    fontSize: 18,
                    fontColor: "#111"
                },
                legend: {
                    display: true,
                    position: "bottom",
                    labels: {
                        fontColor: "#333",
                        fontSize: 16
                    }
                }
            };

            //create Bar Chart class object
            let chart = new Chart(ctx, {
                type: "bar",
                data: data,
                options: options
            });
        })();

    </script>

</x-layout>

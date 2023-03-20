<?php if (!empty($this->records)) { ?>
    <div id="chart"></div>
<?php } else { ?>
    <div class="alert alert-info" role="alert">
        <i class="mdi mdi-alert-circle-outline mr-2"></i> No Data
    </div>
<?php } ?>

<?php if (!empty($this->records)) { ?>
    <script>
        $(window).ready(function() {
            const options = {
                chart: {
                    height: 380,
                    width: "100%",
                    type: "line"
                },
                series: [{
                    name: "Wasserverbrauch",
                    data: [
                        <?php foreach ($this->records as $key) { ?> {
                                x: new Date("<?= $key['createdAt'] ?>"),
                                y: <?= $key['maxKw'] ?>
                            },
                        <?php } ?>
                    ]
                }],
                xaxis: {
                    type: "datetime",
                    tickAmount: 1,
                    labels: {
                        formatter: function(val, timestamp, options) {
                            return options.dateFormatter(new Date(val), "dd MMM");
                        }
                    }
                },
                grid: {
                    padding: {
                        left: 40,
                        right: 40
                    },
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();
        })
    </script>
<?php } ?>
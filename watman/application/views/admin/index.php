<div class="content-page pt-4">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <?php if (count($this->raspberries) > 1) { ?>
                <div class="card">
                    <div class="card-body d-flex align-items-end">
                        <div class="flex-grow-1 me-2">
                            <label class="form-label">Raspberries list</label>
                            <select id="raspList" class="form-control">
                                <?php foreach ($this->raspberries as $key) { ?>
                                    <option value="<?= $key['uuid'] ?>" <?= isset($this->raspbery) && $key['uuid'] === $this->raspbery['uuid'] ? 'selected' : '' ?>><?= $key['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row mb-3">
                <div class="col-md-6 mb-3 col-xl-4">
                    <div class="card h-100 mb-0">
                        <div class="card-body d-flex">
                            <div id="tachometer">
                                <div class="ii">
                                    <?php for ($i = 0; $i <= 11; $i++) { ?>
                                        <div><b><span class="num num_<?php echo $i + 1; ?>"><?php echo $i; ?>.0</span></b></div>
                                        <?php
                                        if ($i === 10) break;
                                        for ($j = 1; $j <= 4; $j++) {
                                        ?>
                                            <div><span class="number"></span></div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <!-- <div id="redline"></div> -->
                                <div class="line"></div>
                                <div class="pin"></div>
                            </div>
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->

                <div class="col-md-6 mb-3 col-xl-4">
                    <div class="card h-100 mb-0">
                        <div class="card-body">
                            <div class="thermometer">
                                <div class="thermometer__inner">
                                    <div class="thermometer__title">°C</div>
                                    <div class="thermometer__title">°F</div>
                                    <div class="thermometer__c">
                                        <div class="thermometer__label">50</div>
                                        <div class="thermometer__label">40</div>
                                        <div class="thermometer__label">30</div>
                                        <div class="thermometer__label">20</div>
                                        <div class="thermometer__label">10</div>
                                        <div class="thermometer__label">0</div>
                                    </div>
                                    <div id="temp-val" class="thermometer__tube" data-c="0" data-f="32" title="0°C, 32°F">
                                        <div id="temp-fill" class="thermometer__mercury"></div>
                                        <div class="thermometer__ring"></div>
                                        <div class="thermometer__ring"></div>
                                    </div>
                                    <div class="thermometer__f">
                                        <div class="thermometer__label">120</div>
                                        <div class="thermometer__label">100</div>
                                        <div class="thermometer__label">80</div>
                                        <div class="thermometer__label">60</div>
                                        <div class="thermometer__label">40</div>
                                    </div>
                                    <div class="thermometer__bulb"></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col -->

                <div class="col-md-12 mb-3 col-xl-4">
                    <div class="card h-100 mb-0">
                        <div class="card-body pressure"></div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="card h-100 mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <button type="button" id="manualMode" class="btn btn-soft-success waves-effect waves-light w-100 controlToggle text-nowrap" controlType="modeControl">Manual</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="autoMode" class="btn btn-success waves-effect waves-light w-100 controlToggle text-nowrap" controlType="modeControl">Auto / AI</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4  col-sm-6">
                    <div class="card h-100 mb-0">
                        <div class="card-body text-center">
                            <div class="trafficNumber"></div>
                            <b>LITERS</b>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 mt-md-0 mt-3">
                    <div class="card h-100 mb-0">
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-6">
                                    <button type="button" id="openValve" class="btn btn-soft-primary waves-effect waves-light w-100 controlToggle" controlType="valveControl">Open</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" id="closeValve" class="btn btn-primary waves-effect waves-light w-100 controlToggle" controlType="valveControl">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card h-100 mb-0">
                        <div class="card-body">
                            <h4 class="header-title mb-0">Statistics for the last 7 days</h4>

                            <div class="collapse show">
                                <div id="chart" class="mt-4" data-colors="#3283f6,#43bee1"></div>
                            </div> <!-- collapsed end -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-md-6 mt-md-0 mt-3">
                    <div class="card h-100 mb-0">
                        <div class="card-body">
                            <h4 class="header-title mb-0">Last 7 logs</h4>

                            <div id="cardCollpase5" class="collapse show">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Flow</th>
                                                <th>Temperature</th>
                                                <th>Count</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($this->logs as $key) {
                                                $bgName = $key['isOpen'] === '1' ? 'success' : 'danger';
                                                $statusName = $key['isOpen'] === '1' ? 'Opened' : 'Closed';
                                            ?>
                                                <tr>
                                                    <td><?= $key['flow'] ?></td>
                                                    <td><?= $key['temperature'] ?></td>
                                                    <td><?= $key['count'] ?></td>
                                                    <td><span class="badge bg-<?= $bgName; ?>"><?= $statusName ?></span></td>
                                                    <td><?= $key['createdAt'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div> <!-- end table responsive-->
                            </div> <!-- collapsed end -->
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->


</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.1/socket.io.slim.js"></script>
<script>
    const socket = io.connect('http://185.214.135.45:4445/', {
        query: "raspberryUUID=<?= $this->raspbery['uuid'] ?>"
    });

    socket.on("connect", () => {
        console.log(socket)
    });

    socket.on('newMessageFromRaspberry', (data) => {
        if (data.id === socket.id || data.type !== 'newRecord') return;

        $.get('<?= base_url() . $this->url . 'updateInfo/' . (isset($this->raspbery) ? $this->raspbery['uuid'] : ''); ?>', function(updateInfoData) {
            if (!updateInfoData) return;

            const newData = JSON.parse(updateInfoData);
            records = newData.records;
            flow = Number(newData.lastRecord.flow);
            tempC = Number(newData.lastRecord.temperature);
            count = Number(newData.lastRecord.count);
            isOpen = Number(newData.lastRecord.isOpen);

            updateInfo(true);
        })
    });

    $('#raspList').change(function() {
        const rasp = $(this).val();
        window.location.replace('<?= base_url() . $this->url ?>index/' + rasp);
    });


    $('.ii div').each(function(index) {
        const number = 200 + index * 6.4;
        $(this).css('transform', `rotate(${number}deg)`);
    });

    $('.controlToggle').click(function() {
        toggleControls($(this).attr('controlType'), $(this).attr('id'));
    })

    function toggleControls(type, id, firstTime) {
        $(`[controlType="${type}"]`)
            .removeClass(type === 'modeControl' ? 'btn-success' : 'btn-primary')
            .addClass(type === 'modeControl' ? 'btn-soft-success' : 'btn-soft-primary')
        $(`#${id}`)
            .removeClass(type === 'modeControl' ? 'btn-soft-success' : 'btn-soft-primary')
            .addClass(type === 'modeControl' ? 'btn-success' : 'btn-primary');

        if (type !== 'valveControl' || firstTime) return;

        socket.emit('newMessage', {
            type: 'valve',
            data: {
                isOpen: id === 'openValve'
            }
        })
    }

    function CToF(c) {
        return c * 1.8 + 32;
    }

    function FToC(f) {
        return (f - 32) * (5 / 9);
    }

    function nearest10th(n) {
        return Math.round(n * 10) / 10;
    }

    function updateTemperature(useCelcius = true) {
        const tempFill = document.getElementById("temp-fill");
        const tempVal = document.getElementById("temp-val");

        if (tempVal) {
            useCelcius ? tempF = nearest10th(CToF(tempC)) : tempC = nearest10th(FToC(tempF))
            tempVal.setAttribute("data-f", tempF);
            tempVal.setAttribute("data-c", tempC);
            // mercury
            if (tempFill) {
                let scaleY = 0,
                    scaleYMax = 0.995;

                let minTempC = -2.5,
                    maxTempC = 60;
                scaleY += (tempC - minTempC) / (Math.abs(minTempC) + maxTempC);

                if (scaleY > scaleYMax) scaleY = scaleYMax;
                else if (scaleY < 0) scaleY = 0;
                tempFill.style.transform = `scaleY(${scaleY})`;
            }
            // reading to put in title
            const tempReading = `${tempC}°C, ${tempF}°F`;
            tempVal.title = tempReading;
        }
    }


    let records = <?= json_encode($this->records); ?>;
    let flow = <?= $this->lastRecord['flow']; ?>;
    // let tempF = 80;
    let tempC = <?= $this->lastRecord['temperature']; ?>;
    let count = <?= $this->lastRecord['count']; ?>;
    let isOpen = <?= $this->lastRecord['isOpen']; ?>;

    const updateInfo = (firstTime) => {
        const options = {
            series: [{
                name: 'Wasserverbrauch',
                data: records.map(data => ({
                    x: new Date(data.createdAt),
                    y: data.maxCount
                })),
            }],
            chart: {
                height: 350,
                type: 'bar'
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '60%'
                }
            },
            xaxis: {
                type: "datetime",
                tickAmount: 1,
                labels: {
                    formatter: function(val, timestamp, options) {
                        return options.dateFormatter(new Date(val), "dd MMM");
                    }
                }
            },
            // colors: [
            //     function({
            //         value,
            //         seriesIndex,
            //         w
            //     }) {
            //         if (value < 5000) {
            //             return '#FF0000'
            //         } else {
            //             return '#02DFDE'
            //         }
            //     }
            // ]
        }
        const chart = new ApexCharts(document.querySelector('#chart'), options)
        chart.render();

        $('.line').css('transform', `rotate(${199 + 32 * flow}deg)`);

        updateTemperature();

        $('.trafficNumber').html('');
        const countSplited = count.toString().split('');

        for (let i = 0; i < 9 - countSplited.length; ++i) {
            $('.trafficNumber').append('<span class="passive">0</span>');
        }
        countSplited.forEach(x => {
            $('.trafficNumber').append(`<span class="active">${x}</span>`);
        });


        $('.pressure').html(`<img src="<?php echo base_url(); ?>assets/images/${isOpen ? 'pipe_on.png' : 'pipe_off.png'}">`);

        toggleControls('valveControl', (isOpen ? 'openValve' : 'closeValve'), firstTime);
    }

    updateInfo(true);
</script>
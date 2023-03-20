<?php
$divaceName = $this->user['user']['type'] == 1 ? 'House' : 'Device';
?>
<div class="content-page pt-4">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-label">Raspberries list</label>
                            <select id="raspList" class="form-control">
                                <?php foreach ($this->raspberries as $key) { ?>
                                    <option value="<?= $key['uuid'] ?>" <?= isset($this->currentRaspUUID) && $key['uuid'] === $this->currentRaspUUID ? 'selected' : '' ?>><?= $key['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Statistic Dates</label>
                            <input type="text" id="rangeOfStatistics" class="form-control" placeholder="2018-10-03 to 2018-10-10">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" id="updateStatistics" class="btn btn-blue waves-effect waves-light w-100">Update</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-5"></div>
                        <div class="col-md-5 d-flex">
                            <div class="form-check mr-3">
                                <input type="radio" id="byMonth" value="1" <?= $this->period == 1 ? "checked" : '' ?> name="period" class="form-check-input">
                                <label class="form-check-label" for="byMonth">By Month</label>
                            </div>
                            <div class="form-check mr-3">
                                <input type="radio" id="byDay" value="2" <?= $this->period == 2 ? "checked" : '' ?> name="period" class="form-check-input">
                                <label class="form-check-label" for="byDay">By Day</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" id="byHour" value="3" <?= $this->period == 3 ? "checked" : '' ?> name="period" class="form-check-input">
                                <label class="form-check-label" for="byHour">By Hour</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-8">
                    <div class="card h-100 mb-0">
                        <div class="card-body chartContainer">
                            <?php $this->load->view($this->url . './chart'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-100 mb-0">
                        <div class="card-header bg-white d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="29" viewBox="0 0 34 29" fill="none">
                                <path d="M17 0L0.333344 15H5.33334V28.3333H28.6667V15H33.6667L17 0ZM16.1667 25V18.3333H12L17.8333 6.66667V13.3333H22L16.1667 25Z" fill="#0162B0" />
                            </svg>
                            <h4 class="mb-0 ml-2 font-weight-bold">Houses</h4>
                        </div>
                        <div class="card-body">
                            <div id="polarChart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="29" viewBox="0 0 34 29" fill="none">
                                        <path d="M17 0L0.333344 15H5.33334V28.3333H28.6667V15H33.6667L17 0ZM16.1667 25V18.3333H12L17.8333 6.66667V13.3333H22L16.1667 25Z" fill="#0162B0" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1">$<span data-plugin="counterup">35.5</span></h3>
                                    <p class="text-muted mb-1 text-truncate"><?= $divaceName; ?> 1</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-uppercase">Expenditure <span class="float-right">12.7 Kw</span></h6>
                            <div class="progress progress-sm m-0">
                                <div class="progress-bar" role="progressbar" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100" style="width: 13%; background-color: #FF2949">
                                    <span class="sr-only">12.7 Kw</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="29" viewBox="0 0 34 29" fill="none">
                                        <path d="M17 0L0.333344 15H5.33334V28.3333H28.6667V15H33.6667L17 0ZM16.1667 25V18.3333H12L17.8333 6.66667V13.3333H22L16.1667 25Z" fill="#0162B0" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1">$<span data-plugin="counterup">40.25</span></h3>
                                    <p class="text-muted mb-1 text-truncate"><?= $divaceName; ?> 2</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-uppercase">Expenditure <span class="float-right">21.5 Kw</span></h6>
                            <div class="progress progress-sm m-0">
                                <div class="progress-bar" role="progressbar" aria-valuenow="21" aria-valuemin="0" aria-valuemax="100" style="width: 21%; background-color: #FFAB4F">
                                    <span class="sr-only">21.5 Kw</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="29" viewBox="0 0 34 29" fill="none">
                                        <path d="M17 0L0.333344 15H5.33334V28.3333H28.6667V15H33.6667L17 0ZM16.1667 25V18.3333H12L17.8333 6.66667V13.3333H22L16.1667 25Z" fill="#0162B0" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1">$<span data-plugin="counterup">20.4</span></h3>
                                    <p class="text-muted mb-1 text-truncate"><?= $divaceName; ?> 3</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-uppercase">Expenditure <span class="float-right">9.5 Kw</span></h6>
                            <div class="progress progress-sm m-0">
                                <div class="progress-bar" role="progressbar" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100" style="width: 9%; background-color: #0162B0">
                                    <span class="sr-only">9.5 Kw</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-sm rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="29" viewBox="0 0 34 29" fill="none">
                                        <path d="M17 0L0.333344 15H5.33334V28.3333H28.6667V15H33.6667L17 0ZM16.1667 25V18.3333H12L17.8333 6.66667V13.3333H22L16.1667 25Z" fill="#0162B0" />
                                    </svg>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark my-1">$<span data-plugin="counterup">32.45</span></h3>
                                    <p class="text-muted mb-1 text-truncate"><?= $divaceName; ?> 4</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <h6 class="text-uppercase">Expenditure <span class="float-right">11.6 Kw</span></h6>
                            <div class="progress progress-sm m-0">
                                <div class="progress-bar" role="progressbar" aria-valuenow="11.6" aria-valuemin="0" aria-valuemax="100" style="width: 11.6%; background-color: #13B0EB">
                                    <span class="sr-only">11.6 Kw</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(window).ready(function() {
        const sevenDaysBefore = '<?= $this->dates[0]; ?>';
        const today = '<?= $this->dates[1]; ?>';
        const flatpickr = $("#rangeOfStatistics").flatpickr({
            mode: "range",
            defaultDate: [sevenDaysBefore, today],
            dateFormat: 'Y-m-d',
            onChange(selectedDates, dateStr) {
                if (selectedDates.length === 1) return;
            }
        });

        $('#updateStatistics').click(function() {
            const rasp = $('#raspList').val();
            const period = $('[name="period"]:checked').val();
            let query = `?rasp=${rasp}&period=${period}`;

            if (flatpickr.selectedDates.length !== 2) return;
            flatpickr.selectedDates.forEach(x => {
                query += `&dates[]=${x.getFullYear()}-${x.getMonth() + 1}-${x.getDate()}`;
            });
            window.history.replaceState({}, "", query);
            $.get('<?= base_url() . $this->url ?>getStatisticsAsync' + query, function(data) {
                $('.chartContainer').html(data);
            })
        });


        const polarOptions = {
            series: [10, 60, 20, 20],
            chart: {
                type: 'pie',
                width: '100%',
                sparkline: {
                    enabled: true
                }
            },
            stroke: {
                width: 1
            },
            tooltip: {
                fixed: {
                    enabled: false
                },
            },
            colors: ['#FF2949', '#FFAB4F', '#0162B0', '#13B0EB'],
            labels: ['<?= $divaceName; ?> 1', '<?= $divaceName; ?> 2', '<?= $divaceName; ?> 3', '<?= $divaceName; ?> 4'],
        };

        const polarChart = new ApexCharts(document.querySelector("#polarChart"), polarOptions);
        polarChart.render();
    })
</script>
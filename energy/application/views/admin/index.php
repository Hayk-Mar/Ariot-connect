<div class="content-page pt-2">
    <div class="content">
        <div>
            <?php if (count($this->raspberries) > 1) { ?>
                <div class="card">
                    <div class="card-body d-flex align-items-end">
                        <div class="flex-grow-1 mr-2">
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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-0">Statistics for the last 7 days</h4>

                            <div class="collapse show">
                                <div id="chart" class="mt-4" data-colors="#3283f6,#43bee1"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-0">
                        <div class="card-body">
                            <h4 class="header-title">Last 7 logs</h4>

                            <div id="cardCollpase5" class="collapse show">
                                <div class="table-responsive">
                                    <table class="table table-hover table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Kw</th>
                                                <th>Cost</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($this->logs as $key) { ?>
                                                <tr>
                                                    <td><?= $key['kw'] ?></td>
                                                    <td>$<?= $key['cost'] ?></td>
                                                    <td><?= $key['createdAt'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-box bg-pattern">
                        <div class="row align-items-center">
                            <div class="col-8 d-flex align-items-center">
                                <div class="avatar-md bg-success rounded d-flex align-items-center justify-content-center mr-1">
                                    <svg width="20" height="30" viewBox="0 0 13 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.875 13.8V23L13 9.2H8.125V0L0 13.8H4.875Z" fill="white" />
                                    </svg>
                                </div>
                                <p class="mb-0 font-weight-bold">Power now</p>
                            </div>
                            <div class="col-4">
                                <div class="text-right">
                                    <h4 class="text-dark my-1"><span>-Kw</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box bg-pattern">
                        <div class="row align-items-center">
                            <div class="col-8 d-flex align-items-center">
                                <div class="avatar-md bg-info rounded d-flex align-items-center justify-content-center mr-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 16.5C8.3 16.5 7.70833 16.2583 7.225 15.775C6.74167 15.2917 6.5 14.7 6.5 14C6.5 13.3 6.74167 12.7083 7.225 12.225C7.70833 11.7417 8.3 11.5 9 11.5C9.7 11.5 10.2917 11.7417 10.775 12.225C11.2583 12.7083 11.5 13.3 11.5 14C11.5 14.7 11.2583 15.2917 10.775 15.775C10.2917 16.2583 9.7 16.5 9 16.5ZM5 22C4.45 22 3.979 21.8043 3.587 21.413C3.19567 21.021 3 20.55 3 20V6C3 5.45 3.19567 4.97933 3.587 4.588C3.979 4.196 4.45 4 5 4H6V2H8V4H16V2H18V4H19C19.55 4 20.021 4.196 20.413 4.588C20.8043 4.97933 21 5.45 21 6V20C21 20.55 20.8043 21.021 20.413 21.413C20.021 21.8043 19.55 22 19 22H5ZM5 20H19V10H5V20Z" fill="white" />
                                    </svg>
                                </div>
                                <p class="mb-0 font-weight-bold">Today</p>
                            </div>
                            <div class="col-4">
                                <div class="text-right">
                                    <h4 class="text-dark my-1"><span>-$</span></h4>
                                    <h4 class="text-dark my-1"><span>-Kw</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box bg-pattern">
                        <div class="row align-items-center">
                            <div class="col-8 d-flex align-items-center">
                                <div class="avatar-md bg-blue rounded d-flex align-items-center justify-content-center mr-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 14C11.7167 14 11.4793 13.904 11.288 13.712C11.096 13.5207 11 13.2833 11 13C11 12.7167 11.096 12.479 11.288 12.287C11.4793 12.0957 11.7167 12 12 12C12.2833 12 12.521 12.0957 12.713 12.287C12.9043 12.479 13 12.7167 13 13C13 13.2833 12.9043 13.5207 12.713 13.712C12.521 13.904 12.2833 14 12 14ZM8 14C7.71667 14 7.479 13.904 7.287 13.712C7.09567 13.5207 7 13.2833 7 13C7 12.7167 7.09567 12.479 7.287 12.287C7.479 12.0957 7.71667 12 8 12C8.28333 12 8.521 12.0957 8.713 12.287C8.90433 12.479 9 12.7167 9 13C9 13.2833 8.90433 13.5207 8.713 13.712C8.521 13.904 8.28333 14 8 14ZM16 14C15.7167 14 15.4793 13.904 15.288 13.712C15.096 13.5207 15 13.2833 15 13C15 12.7167 15.096 12.479 15.288 12.287C15.4793 12.0957 15.7167 12 16 12C16.2833 12 16.5207 12.0957 16.712 12.287C16.904 12.479 17 12.7167 17 13C17 13.2833 16.904 13.5207 16.712 13.712C16.5207 13.904 16.2833 14 16 14ZM12 18C11.7167 18 11.4793 17.904 11.288 17.712C11.096 17.5207 11 17.2833 11 17C11 16.7167 11.096 16.4793 11.288 16.288C11.4793 16.096 11.7167 16 12 16C12.2833 16 12.521 16.096 12.713 16.288C12.9043 16.4793 13 16.7167 13 17C13 17.2833 12.9043 17.5207 12.713 17.712C12.521 17.904 12.2833 18 12 18ZM8 18C7.71667 18 7.479 17.904 7.287 17.712C7.09567 17.5207 7 17.2833 7 17C7 16.7167 7.09567 16.4793 7.287 16.288C7.479 16.096 7.71667 16 8 16C8.28333 16 8.521 16.096 8.713 16.288C8.90433 16.4793 9 16.7167 9 17C9 17.2833 8.90433 17.5207 8.713 17.712C8.521 17.904 8.28333 18 8 18ZM16 18C15.7167 18 15.4793 17.904 15.288 17.712C15.096 17.5207 15 17.2833 15 17C15 16.7167 15.096 16.4793 15.288 16.288C15.4793 16.096 15.7167 16 16 16C16.2833 16 16.5207 16.096 16.712 16.288C16.904 16.4793 17 16.7167 17 17C17 17.2833 16.904 17.5207 16.712 17.712C16.5207 17.904 16.2833 18 16 18ZM5 22C4.45 22 3.979 21.8043 3.587 21.413C3.19567 21.021 3 20.55 3 20V6C3 5.45 3.19567 4.97933 3.587 4.588C3.979 4.196 4.45 4 5 4H6V2H8V4H16V2H18V4H19C19.55 4 20.021 4.196 20.413 4.588C20.8043 4.97933 21 5.45 21 6V20C21 20.55 20.8043 21.021 20.413 21.413C20.021 21.8043 19.55 22 19 22H5ZM5 20H19V10H5V20Z" fill="white" />
                                    </svg>

                                </div>
                                <p class="mb-0 font-weight-bold">This month</p>
                            </div>
                            <div class="col-4">
                                <div class="text-right">
                                    <h4 class="text-dark my-1"><span>-$</span></h4>
                                    <h4 class="text-dark my-1"><span>-Kw</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box bg-pattern">
                        <div class="row align-items-center">
                            <div class="col-8 d-flex align-items-center">
                                <div class="avatar-md bg-primary rounded d-flex align-items-center justify-content-center mr-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.8601 4.39V19.39C15.8601 21.06 17.0001 22 18.2501 22C19.3901 22 20.6401 21.21 20.6401 19.39V4.5C20.6401 2.96 19.5001 2 18.2501 2C17.0001 2 15.8601 3.06 15.8601 4.39ZM9.61011 12V19.39C9.61011 21.07 10.7701 22 12.0001 22C13.1401 22 14.3901 21.21 14.3901 19.39V12.11C14.3901 10.57 13.2501 9.61 12.0001 9.61C10.7501 9.61 9.61011 10.67 9.61011 12ZM5.75011 17.23C7.07011 17.23 8.14011 18.3 8.14011 19.61C8.14011 20.2439 7.88831 20.8518 7.44009 21.3C6.99188 21.7482 6.38398 22 5.75011 22C5.11624 22 4.50833 21.7482 4.06012 21.3C3.61191 20.8518 3.36011 20.2439 3.36011 19.61C3.36011 18.3 4.43011 17.23 5.75011 17.23Z" fill="white" />
                                    </svg>
                                </div>
                                <p class="mb-0 font-weight-bold">Total usage</p>
                            </div>
                            <div class="col-4">
                                <div class="text-right">
                                    <h4 class="text-dark my-1"><span>-$</span></h4>
                                    <h4 class="text-dark my-1"><span>-Kw</span></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-box bg-pattern">
                        <div class="d-flex align-items-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_290_15310" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                    <path d="M13.1983 21.6C13.5166 21.6 13.8218 21.7264 14.0469 21.9515C14.2719 22.1765 14.3984 22.4817 14.3984 22.8C14.3984 23.1183 14.2719 23.4235 14.0469 23.6485C13.8218 23.8736 13.5166 24 13.1983 24C12.88 24 12.5748 23.8736 12.3497 23.6485C12.1247 23.4235 11.9982 23.1183 11.9982 22.8C11.9982 22.4817 12.1247 22.1765 12.3497 21.9515C12.5748 21.7264 12.88 21.6 13.1983 21.6ZM8.99811 20.4C9.31639 20.4 9.62162 20.5264 9.84668 20.7515C10.0717 20.9765 10.1982 21.2818 10.1982 21.6C10.1982 21.9183 10.0717 22.2235 9.84668 22.4485C9.62162 22.6736 9.31639 22.8 8.99811 22.8C8.67984 22.8 8.3746 22.6736 8.14954 22.4485C7.92449 22.2235 7.79806 21.9183 7.79806 21.6C7.79806 21.2818 7.92449 20.9765 8.14954 20.7515C8.3746 20.5264 8.67984 20.4 8.99811 20.4ZM17.3985 20.4C17.7168 20.4 18.022 20.5264 18.2471 20.7515C18.4721 20.9765 18.5986 21.2818 18.5986 21.6C18.5986 21.9183 18.4721 22.2235 18.2471 22.4485C18.022 22.6736 17.7168 22.8 17.3985 22.8C17.0802 22.8 16.775 22.6736 16.5499 22.4485C16.3249 22.2235 16.1984 21.9183 16.1984 21.6C16.1984 21.2818 16.3249 20.9765 16.5499 20.7515C16.775 20.5264 17.0802 20.4 17.3985 20.4ZM13.2007 4.8109C17.0025 4.8109 19.1602 7.32729 19.4734 10.3669H19.5694C20.1505 10.3661 20.7262 10.4798 21.2634 10.7015C21.8006 10.9232 22.2888 11.2485 22.7002 11.6589C23.1117 12.0693 23.4382 12.5568 23.6612 13.0934C23.8843 13.63 23.9994 14.2053 24 14.7864C23.9992 15.3675 23.884 15.9426 23.6609 16.4791C23.4378 17.0156 23.1112 17.5029 22.6998 17.9132C22.2884 18.3235 21.8002 18.6487 21.2631 18.8703C20.726 19.092 20.1504 19.2056 19.5694 19.2048H6.83081C6.24976 19.2056 5.67425 19.092 5.13713 18.8703C4.60001 18.6487 4.11181 18.3235 3.70039 17.9132C3.28897 17.5029 2.96239 17.0156 2.73931 16.4791C2.51622 15.9426 2.401 15.3675 2.40021 14.7864C2.40084 14.2053 2.51595 13.63 2.73896 13.0934C2.96198 12.5568 3.28853 12.0693 3.69996 11.6589C4.1114 11.2485 4.59966 10.9232 5.13686 10.7015C5.67405 10.4798 6.24966 10.3661 6.83081 10.3669H6.92682C7.24243 7.30689 9.39893 4.8109 13.2007 4.8109ZM2.83823 9.79687C2.92168 9.99784 2.92949 10.2222 2.86021 10.4285C2.79093 10.6348 2.64925 10.809 2.46141 10.9189L2.35101 10.9729L1.23975 11.4337C1.02932 11.5194 0.794226 11.5224 0.581673 11.442C0.36912 11.3617 0.19484 11.2039 0.093821 11.0003C-0.0071979 10.7968 -0.0274781 10.5626 0.0370515 10.3447C0.101581 10.1268 0.246143 9.94139 0.441718 9.82567L0.550923 9.77047L1.66217 9.30968C1.77139 9.26444 1.88844 9.24115 2.00665 9.24115C2.12486 9.24115 2.24191 9.26444 2.35112 9.30968C2.46033 9.35492 2.55956 9.42124 2.64314 9.50483C2.72672 9.58842 2.79301 9.68766 2.83823 9.79687ZM10.623 3.9973L10.4178 4.0669C8.27568 4.8229 6.74201 6.47289 6.07958 8.65448L5.99437 8.95448L5.92477 9.24008L5.67756 9.28688C4.95959 9.43761 4.2785 9.72879 3.67347 10.1437C3.12344 9.19835 2.91799 8.09165 3.09208 7.01192C3.26616 5.93219 3.80902 4.94613 4.62828 4.22155C5.44754 3.49697 6.49257 3.07865 7.58554 3.03776C8.67851 2.99688 9.75188 3.33596 10.623 3.9973ZM1.12695 4.0345L1.25296 4.0765L2.36421 4.5373C2.57261 4.62515 2.7403 4.78823 2.83392 4.99411C2.92753 5.19998 2.9402 5.43354 2.8694 5.64833C2.79861 5.86312 2.64954 6.04339 2.45186 6.15326C2.25418 6.26314 2.02238 6.29456 1.80258 6.24129L1.67537 6.20049L0.564124 5.73969C0.355165 5.65211 0.18693 5.48893 0.0930073 5.28275C-0.000915408 5.07657 -0.0136154 4.84255 0.0574429 4.62742C0.128501 4.41229 0.278089 4.23187 0.476342 4.12218C0.674595 4.01249 0.906926 3.98041 1.12695 4.0345ZM5.70516 0.451321L5.75916 0.56052L6.21998 1.67171C6.307 1.88233 6.31088 2.1181 6.23084 2.33146C6.1508 2.54482 5.9928 2.71988 5.78872 2.8213C5.58465 2.92272 5.3497 2.94296 5.13128 2.87793C4.91287 2.8129 4.72726 2.66744 4.61191 2.47091L4.55671 2.36051L4.09589 1.24932C4.01011 1.03889 4.00712 0.803811 4.0875 0.591269C4.16788 0.378726 4.3257 0.204456 4.52925 0.103442C4.73281 0.00242797 4.96704 -0.0178512 5.18493 0.0466751C5.40282 0.111201 5.58944 0.255756 5.70516 0.451321ZM10.929 0.0685229C11.1282 0.151216 11.2912 0.302717 11.3881 0.495437C11.485 0.688156 11.5095 0.909273 11.457 1.11852L11.4162 1.24452L10.9554 2.35571C10.8675 2.56411 10.7045 2.73179 10.4986 2.8254C10.2927 2.919 10.0591 2.93167 9.84431 2.86088C9.62951 2.79009 9.44924 2.64103 9.33936 2.44336C9.22948 2.24569 9.19805 2.0139 9.25132 1.79411L9.29333 1.66691L9.75294 0.555721C9.79816 0.446506 9.86446 0.347268 9.94803 0.263675C10.0316 0.180082 10.1308 0.113771 10.2401 0.0685292C10.3493 0.0232874 10.4663 1.08037e-06 10.5845 0C10.7027 -1.0803e-06 10.8198 0.0232831 10.929 0.0685229Z" fill="black" />
                                </mask>
                                <g mask="url(#mask0_290_15310)">
                                    <path d="M6.60034 9.59994L-1.80005 13.1999L0.600062 -1.20001L13.8007 -3L11.4006 3.59997L7.20037 6.59995L6.60034 9.59994Z" fill="#FADA3D" />
                                    <path d="M7.80036 24.0003L0 23.4003L1.80008 12.0003L6.6003 9.60035L7.80036 6.00037L15.6007 2.40039L25.8012 11.4003L24.0011 18.0003L19.2009 23.4003L13.2006 25.8003L7.80036 24.0003Z" fill="#13B0EB" />
                                </g>
                            </svg>
                            <h4 class="ml-2 font-weight-bold">Weather</h4>
                        </div>
                        <div class="mt-4 d-flex align-items-center flex-column">
                            <h4 class="font-weight-bold mb-2">Yerevan</h4>
                            <div class="avatar-lg rounded-circle d-flex align-items-center justify-content-center" style="background-color: #FADA3D"></div>
                        </div>
                        <div class="mt-4 d-flex align-items-center flex-column">
                            <h2 class="font-weight-bold mb-2">24°</h2>
                            <h5 class="text-muted">Areas Of Fog</h5>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>


<div id="chartModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Chart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div><!-- /.modal -->

<script>
    $('#raspList').change(function() {
        const rasp = $(this).val();
        window.location.replace('<?= base_url() . $this->url ?>index/' + rasp);
    });

    let records = <?= json_encode($this->records); ?>;
    const options = {
        series: [{
            name: 'Wasserverbrauch',
            data: records.map(data => ({
                x: new Date(data.createdAt),
                y: data.maxKw
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
    }
    const chart = new ApexCharts(document.querySelector('#chart'), options)
    chart.render();

</script>
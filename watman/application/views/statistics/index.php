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
                            <button type="button" id="updateStatistics" class="btn btn-soft-primary waves-effect waves-light w-100">Update</button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-5"></div>
                        <div class="col-md-5 d-flex gap-3">
                            <div class="form-check">
                                <input type="radio" id="byMonth" value="1" <?= $this->period == 1 ? "checked" : '' ?> name="period" class="form-check-input">
                                <label class="form-check-label" for="byMonth">By Month</label>
                            </div>
                            <div class="form-check">
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
            <div class="card">
                <div class="card-body chartContainer">
                    <?php $this->load->view($this->url . './chart'); ?>
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
    })
</script>
<div class="content-page pt-4">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body d-flex align-items-end">
                    <div class="flex-grow-1 me-2">
                        <label class="form-label">Raspberries list</label>
                        <select id="raspList" class="form-control">
                            <?php foreach ($this->raspberries as $key) { ?>
                                <option value="<?= $key['uuid'] ?>" <?= isset($this->currentRaspUUID) && $key['uuid'] === $this->currentRaspUUID ? 'selected' : '' ?>><?= $key['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="flex-grow-1 me-2">
                        <label class="form-label">Statistic Dates</label>
                        <input type="text" id="rangeOfLogs" class="form-control" placeholder="2018-10-03 to 2018-10-10">
                    </div>
                    <button type="button" id="updateLogs" class="btn btn-soft-primary waves-effect waves-light">Update</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body logsCOntainer">
                            <?php $this->load->view($this->url . 'logs'); ?>
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
        const flatpickr = $("#rangeOfLogs").flatpickr({
            mode: "range",
            defaultDate: [sevenDaysBefore, today],
            dateFormat: 'Y-m-d',
            onChange(selectedDates, dateStr) {
                if (selectedDates.length === 1) return;
            }
        });

        $('#updateLogs').click(function() {
            const rasp = $('#raspList').val();
            let query = `?rasp=${rasp}`;

            if (flatpickr.selectedDates.length !== 2) return;
            flatpickr.selectedDates.forEach(x => {
                query += `&dates[]=${x.getFullYear()}-${x.getMonth() + 1}-${x.getDate()}`;
            });
            window.history.replaceState({}, "", query);
            $.get('<?= base_url() . $this->url ?>getLogsAsync' + query, function(data) {
                $('.logsCOntainer').html(data);
            })
        });
    })
</script>
<div class="content-page pt-4">
    <div class="content">
        <form class="container-fluid" method="post" action="<?= base_url() . $this->url; ?>changeSettings" id="settingsForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="card h-100 mb-0 d-flex">
                        <div class="card-body">
                            <h4 class="card-title"><b>Tariff Settings</b></h4>
                            <div class="form-group mb-3">
                                <label for="simpleinput">Day Tariff</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white border-0" id="basic-addon1">$</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Day Tariff" aria-label="Day Tariff" name="dayTariff" value="<?= $this->userSettings['dayTariff']; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">Night Tariff</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white border-0" id="basic-addon1">$</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Night Tariff" aria-label="Night Tariff" name="nightTariff" value="<?= $this->userSettings['nightTariff']; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">Time Zone</label>
                                <input type="text" class="form-control" placeholder="Time Zone" aria-label="Time Zone" name="timeZone" value="<?= $this->userSettings['timeZone']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 mb-0 d-flex">
                        <div class="card-body">
                            <h4 class="card-title"><b>Alarm Settings</b></h4>
                            <div class="form-group mb-3">
                                <label for="simpleinput">High Voltage</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white border-0" id="basic-addon1">Kw</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="High Voltage" aria-label="High Voltage" name="highVoltage" value="<?= $this->userSettings['highVoltage']; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">Low Voltage</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white border-0" id="basic-addon1">Kw</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Low Voltage" aria-label="Low Voltage" name="lowVoltage" value="<?= $this->userSettings['lowVoltage']; ?>">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="simpleinput">High Consumption</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-info text-white border-0" id="basic-addon1">Kw</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="High Consumption" aria-label="High Consumption" name="highConsumption" value="<?= $this->userSettings['highConsumption']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2 text-center">
                <button class="btn btn-md btn-blue waves-effect waves-light mb-2 mx-3 px-4"><b>Update</b></button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.1/socket.io.slim.js"></script>
<script>
    const raspberies = <?= json_encode($this->raspberries) ?>;
    const socketsArr = raspberies.map(({
        uuid
    }) => io.connect('http://185.214.135.45:4445', {
        query: `raspberryUUID=${uuid}`
    }));

    $('#settingsForm').submit(function(e) {
        const turnOfWaterTime = Number($('[name="turnOfWaterTime"]').val());
        const closeValveTempEx = Number($('[name="closeValveTempEx"]').val());
        const closeValveTempDropsBelow = Number($('[name="closeValveTempDropsBelow"]').val());
        const mode = Number($('[name="mode"]:checked').val());

        socketsArr.forEach(socket => socket.emit('newMessage', {
            type: 'settings',
            data: {
                turnOfWaterTime,
                closeValveTempEx,
                closeValveTempDropsBelow,
                mode
            }
        }));
    });
</script>
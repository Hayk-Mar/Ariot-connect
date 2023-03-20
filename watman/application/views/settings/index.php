<div class="content-page pt-4">
    <div class="content">
        <form class="container-fluid" method="post" action="<?= base_url() . $this->url; ?>changeSettings" id="settingsForm">
            <div class="row mb-3">
                <div class="col-md-6 h-100">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><b>Manual Mode</b></h4>
                            <div class="mb-3 settingSection">
                                <p class="card-text">Send warning after <input type="text" class="form-control smallInput" name="warningTime" value="<?= $this->userSettings['warningTime']; ?>"> minutes of continuous flow</p>
                                <p class="card-text">Shut off water after <input type="text" class="form-control smallInput" name="turnOfWaterTime" value="<?= $this->userSettings['turnOfWaterTime']; ?>"> minutes of continuous flow</p>
                            </div>

                            <div class="mb-3 settingSection">
                                <p class="card-text">Close valve if temperature exceeds <input type="text" class="form-control smallInput" name="closeValveTempEx" value="<?= $this->userSettings['closeValveTempEx']; ?>"> degrees</p>
                                <p class="card-text">Close valve if temperature drops below <input type="text" class="form-control smallInput" name="closeValveTempDropsBelow" value="<?= $this->userSettings['closeValveTempDropsBelow']; ?>"> degrees</p>
                            </div>

                            <div class="settingSection">
                                <p class="card-text">Close valve if pressure exceeds <input type="text" class="form-control smallInput" name="closeValvePressEx" value="<?= $this->userSettings['closeValvePressEx']; ?>"> Pa</p>
                                <p class="card-text">Close valve if pressure drops below <input type="text" class="form-control smallInput" name="closeValvePressDropsBelow" value="<?= $this->userSettings['closeValvePressDropsBelow']; ?>"> Pa</p>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-0">
                        <div class="card-body">
                            <h4 class="card-title"><b>Automat / AI Mode</b></h4>
                            <div>
                                <div class="form-check">
                                    <input type="radio" id="mode1" name="mode" <?= $this->userSettings['mode'] == 1 ? 'checked' : ''; ?> value="1" class="form-check-input">
                                    <label class="form-check-label" for="mode1">Sensitive mode</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="mode2" name="mode" <?= $this->userSettings['mode'] == 2 ? 'checked' : ''; ?> value="2" class="form-check-input">
                                    <label class="form-check-label" for="mode2">Normal mode</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100 mb-0 d-flex">
                        <div class="card-body">
                            <h4 class="card-title"><b>Notifications</b></h4>
                            <div class="mb-2">
                                <h5>Email</h5>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="emailWarningOff" name="emailWarningOff" <?= $this->userSettings['emailWarningOff'] == 1 ? 'checked' : ''; ?> value="1">
                                    <label class="form-check-label" for="emailWarningOff">Shut off Warning</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="emailTempAlertOn" name="emailTempAlertOn" <?= $this->userSettings['emailTempAlertOn'] == 1 ? 'checked' : ''; ?> value="1">
                                    <label class="form-check-label" for="emailTempAlertOn">Temperature Alert</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" id="emailPressAlertOn" name="emailPressAlertOn" <?= $this->userSettings['emailPressAlertOn'] == 1 ? 'checked' : ''; ?> value="1">
                                    <label class="form-check-label" for="emailPressAlertOn">Pressure Alert</label>
                                </div>
                            </div>
                            <h5>Text Message (SMS)</h5>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="smsWarningOff" name="smsWarningOff" <?= $this->userSettings['smsWarningOff'] == 1 ? 'checked' : ''; ?> value="1">
                                <label class="form-check-label" for="smsWarningOff">Shut off Warning</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="smsTempAlertOn" name="smsTempAlertOn" <?= $this->userSettings['smsTempAlertOn'] == 1 ? 'checked' : ''; ?> value="1">
                                <label class="form-check-label" for="smsTempAlertOn">Temperature Alert</label>
                            </div>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" id="smsPressAlertOn" name="smsPressAlertOn" <?= $this->userSettings['smsPressAlertOn'] == 1 ? 'checked' : ''; ?> value="1">
                                <label class="form-check-label" for="smsPressAlertOn">Pressure Alert</label>
                            </div>
                        </div>
                        <button class="btn btn--md btn-primary waves-effect waves-light mb-2 mx-3"><b>Update</b></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.1/socket.io.slim.js"></script>
<script>
    const raspberies = <?= json_encode($this->raspberries) ?>;
    const socketsArr = raspberies.map(({uuid}) => io.connect('http://185.214.135.45:4445', {
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
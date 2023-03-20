<form action="<?= base_url() . $this->url . 'addRasbperryRecord/' . $this->raspberry['uuid']; ?>" method="post">
    <div class="row">
        <div class="mb-3 col-6">
            <label for="count" class="form-label">Count</label>
            <input type="text" class="form-control" required name="count" id="count" placeholder="Count">
        </div>
        <div class="mb-3 col-6">
            <label for="flow" class="form-label">Flow</label>
            <input type="text" class="form-control" required name="flow" id="flow" placeholder="Flow">
        </div>
    </div>
    <div class="row align-items-end">
        <div class="mb-3 col-6">
            <label for="temperature" class="form-label">Temperature</label>
            <input type="text" class="form-control" required name="temperature" id="temperature" placeholder="Temperature">
        </div>
        <div class="mb-3 col-6">
            <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input" id="isOpen" name="isOpen" value="1">
                <label class="form-check-label" for="isOpen">Is Open</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="datetime-datepicker" class="form-label">Created At</label>
        <input type="text" id="datetime-datepicker" class="form-control flatpickr-input active" required name="createdAt" placeholder="Created At" readonly="readonly">
    </div>
    <div class="text-end">
        <button class="btn btn-blue waves-effect waves-light">Save</button>
    </div>
</form>

<script>
    $(window).ready(function() {
        $("#datetime-datepicker").flatpickr({
            enableTime: !0,
            dateFormat: "Y-m-d H:i"
        })
    });
</script>
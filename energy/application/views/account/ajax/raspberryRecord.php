<form action="<?= base_url() . $this->url . 'addRasbperryRecord/' . $this->raspberry['uuid']; ?>" method="post">
    <div class="mb-3">
        <label for="kw" class="form-label">Kw</label>
        <input type="text" class="form-control" required name="kw" id="kw" placeholder="Kw">
    </div>
    <div class="mb-3">
        <label for="cost" class="form-label">Cost</label>
        <input type="text" class="form-control" required name="cost" id="cost" placeholder="Cost">
    </div>
    <div class="mb-3">
        <label for="datetime-datepicker" class="form-label">Created At</label>
        <input type="text" id="datetime-datepicker" class="form-control flatpickr-input active" required name="createdAt" placeholder="Created At" readonly="readonly">
    </div>
    <div class="text-right">
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
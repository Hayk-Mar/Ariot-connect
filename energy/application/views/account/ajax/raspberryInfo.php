<form action="<?= base_url() . $this->url . (isset($this->raspberry) ? 'editRasbperry/' . $this->raspberry['id'] : 'addRaspberry'); ?>" method="post">
    <div class="mb-3">
        <label for="raspberryName" class="form-label">Name</label>
        <input type="text" class="form-control" required name="name" id="raspberryName" value="<?= $this->raspberry['name']; ?>" placeholder="Name">
    </div>
    <div class="mb-3">
        <label for="raspberryUUID" class="form-label">UUID</label>
        <input type="text" class="form-control" required name="uuid" id="raspberryUUID" value="<?= $this->raspberry['uuid']; ?>" placeholder="UUID">
    </div>
    <div class="text-right">
        <button class="btn btn-blue waves-effect waves-light">Save</button>
    </div>
</form>
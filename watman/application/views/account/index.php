<div class="content-page pt-4">
    <div class="content">
        <div class="container-fluid">
            <?php if (empty($this->raspberries)) { ?>
                <div class="alert alert-warning" role="alert">
                    <i class="mdi mdi-alert-outline me-2"></i> <strong>Warning</strong> - You haven't added any raspberries yet!
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="text-lg rounded-circle avatar-lg img-thumbnail d-inline-flex justify-content-center align-items-center" alt="profile-image">
                                <b><?= explode(' ', $this->user['user']['fullName'])[0][0] . explode(' ', $this->user['user']['fullName'])[1][0] ?></b>
                            </h3>

                            <h4><?= $this->user['user']['fullName'] ?></h4>

                            <div class="text-start mt-3">
                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ms-2"><?= $this->user['user']['fullName'] ?></span></p>

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong><span class="ms-2"><?= $this->user['user']['email'] ?></span></p>
                            </div>
                        </div>
                    </div> <!-- end card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4><b>Raspberries</b></h4>
                                <button type="button" class="btn btn-xs btn-primary waves-effect waves-light raspberryAction">
                                    <i class="mdi mdi-plus"></i>
                                </button>
                            </div>
                            <?php if (!empty($this->raspberries)) { ?>
                                <div id="cardCollpase5" class="collapse show">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-centered mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>UUID</th>
                                                    <th class="text-center" width="10%"><i class="mdi mdi-settings"></i></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($this->raspberries as $key) { ?>
                                                    <tr>
                                                        <td><?= $key['name']; ?></td>
                                                        <td><?= $key['uuid']; ?></td>
                                                        <td class="text-center text-nowrap" width="10%">
                                                            <button type="button" class="btn btn-xs btn-primary waves-effect waves-light raspberryAction" rId="<?= $key['id'] ?>">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-xs btn-success waves-effect waves-light addRaspberryRecord" rId="<?= $key['id'] ?>">
                                                                <i class="mdi mdi-plus"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-xs btn-danger waves-effect waves-light deleteRaspberry" rId="<?= $key['id'] ?>">
                                                                <i class="fe-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div> <!-- end table responsive-->
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div> <!-- end col-->

                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url() . $this->url; ?>changeUserInfo" method="post">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input class="form-control" type="text" id="fullname" name="fullName" value="<?= $this->user['user']['fullName']; ?>" placeholder="Enter your name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="email" id="email" name="email" value="<?= $this->user['user']['email']; ?>" required placeholder="Enter your email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password <small class="text-muted">(For confirm)</small></label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" required placeholder="Enter your password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Change </button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>

<div id="raspberriesModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Content is Responsive</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
        </div>
    </div>
</div><!-- /.modal -->

<script>
    let raspberyAjax;

    $(window).ready(function() {
        $('.deleteRaspberry').click(function() {
            if (confirm('Are you sure ?')) {
                window.location.replace(`<?php echo base_url() . $this->url; ?>deleteRasbperry/${$(this).attr('rId')}`);
            }
        })
        $('.raspberryAction').click(function() {
            let self = this;
            if (raspberyAjax) raspberyAjax.abort();
            const buttonHtml = $(this).html();
            $(this).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');
            raspberyAjax = $.get(`<?php echo base_url() . $this->url; ?>getRaspberryInfo/${$(this).attr('rId') || 0}`)
                .done(function(data) {
                    $(self).html(buttonHtml);
                    $('#raspberriesModal .modal-body').html(data);
                    $('#raspberriesModal').modal('show');
                });
        });

        $('.addRaspberryRecord').click(function() {
            let self = this;
            if (raspberyAjax) raspberyAjax.abort();

            const buttonHtml = $(this).html();
            $(this).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>');
            raspberyAjax = $.get(`<?= base_url() . $this->url; ?>getRaspberryRecord/${$(this).attr('rId') || 0}`)
                .done(function(data) {
                    $(self).html(buttonHtml);
                    $('#raspberriesModal .modal-body').html(data);
                    $('#raspberriesModal').modal('show');
                });
        })
    });
</script>
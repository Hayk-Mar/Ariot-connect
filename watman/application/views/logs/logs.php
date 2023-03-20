<?php if (!empty($this->logs)) { ?>
    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>#</th>
                <th>Flow</th>
                <th>Temperature</th>
                <th>Count</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $num = 0;
            foreach ($this->logs as $key) {
                ++$num;
                $bgName = $key['isOpen'] === '1' ? 'success' : 'danger';
                $statusName = $key['isOpen'] === '1' ? 'Opened' : 'Closed';
            ?>
                <tr>
                    <td><?= $num; ?></td>
                    <td><?= $key['flow'] ?></td>
                    <td><?= $key['temperature'] ?></td>
                    <td><?= $key['count'] ?></td>
                    <td><span class="badge bg-<?= $bgName; ?>"><?= $statusName ?></span></td>
                    <td><?= $key['createdAt'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="alert alert-info" role="alert">
        <i class="mdi mdi-alert-circle-outline me-2"></i> No Data
    </div>
<?php } ?>

<?php if (!empty($this->logs)) { ?>
    <script>
        $(window).ready(function() {
            let logsDatatable = $("#datatable-buttons").DataTable({
                lengthChange: !1,
                buttons: [{
                    extend: "csv",
                    className: "btn-light"
                }, {
                    extend: "excel",
                    className: "btn-light"
                }, {
                    extend: "print",
                    className: "btn-light"
                }, {
                    extend: "pdf",
                    className: "btn-light"
                }],
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            });

            logsDatatable.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
        })
    </script>
<?php } ?>
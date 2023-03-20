<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> &copy; 
                Created By 
                <img src="<?= base_url(); ?>assets/images/logo-dark.png" class="ms-1" alt="" height="40">
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

<!-- Plugins js-->
<script src="<?= base_url(); ?>assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>

<!-- App js-->
<script src="<?= base_url(); ?>assets/js/app.min.js"></script>

<script>
    $(window).ready(function() {
        $('form').each(function() {
            $(this).submit(function() {
                $(this).find('button[type="submit"]').addClass('btn-loading').attr('type', 'button');
            });
        });
    });

    // function delete_alert(href) {
    //     Swal.fire({
    //         icon: 'warning',
    //         title: 'Համոզված եք ?',
    //         confirmButtonText: 'Հաստատել',
    //         confirmButtonColor: '#242424',
    //         focusCancel: true,
    //         showCancelButton: true,
    //         cancelButtonText: 'Չեղարկել',
    //         cancelButtonColor: '#EE2D41',
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             window.location.replace(href);
    //         }
    //     });
    // }

    // function swal_alert(params) {
    //     Swal.fire({
    //         icon: params['icon'],
    //         title: params['title'],
    //         text: params['text'],
    //         confirmButtonText: params['button_text'],
    //         confirmButtonColor: '#242424',
    //     })
    // }

    // function lightOrDark(color) {

    //     if (color.match(/^rgb/)) {
    //         color = color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);

    //         r = color[1];
    //         g = color[2];
    //         b = color[3];
    //     } else {
    //         color = +("0x" + color.slice(1).replace(
    //             color.length < 5 && /./g, '$&$&'
    //         ));

    //         r = color >> 16;
    //         g = color >> 8 & 255;
    //         b = color & 255;
    //     }

    //     hsp = Math.sqrt(
    //         0.299 * (r * r) +
    //         0.587 * (g * g) +
    //         0.114 * (b * b)
    //     );

    //     // Using the HSP value, determine whether the color is light or dark
    //     if (hsp > 127.5) {
    //         return true;
    //     } else {

    //         return false;
    //     }
    // }
    
    $(window).ready(function() {
        const err = '<?= $_GET['err'] ?>';
        const type = '<?= $_GET['type'] ?>';
        let raspberyAjax = null;

        if (err || type) {
            alert(err || type)
            window.history.replaceState({}, "", '<?= base_url() . $this->url; ?>');
        }
    })
</script>
</body>

</html>
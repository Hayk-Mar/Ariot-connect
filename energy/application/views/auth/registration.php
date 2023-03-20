<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/ubold/layouts/creative/auth-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Sep 2022 22:35:17 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Register & Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">

    <!-- Bootstrap css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <!-- icons -->
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="<?= base_url(); ?>assets/js/head.js"></script>
    <!-- Vendor js -->
    <script src="<?= base_url(); ?>assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="<?= base_url(); ?>assets/js/app.min.js"></script>

</head>

<body class="authentication-bg authentication-bg-pattern registration pb-0">

    <div class="account-pages mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">
                        <div class="card-body p-4">

                            <div class="text-center w-75 mx-auto mb-3">
                                <span><img src="<?= base_url(); ?>/assets/images/Ariot-Logos.png" alt="" height="60"></span>
                            </div>

                            <form class="auth-form" action="<?= base_url(); ?>auth/registrationRun" method="post">

                                <div class="mb-3">
                                    <input class="form-control" type="text" id="fullname" name="fullName" placeholder="Enter your name" required>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="email" id="email" name="email" required placeholder="Enter your email">
                                </div>
                                <div class="mb-3">
                                    <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password">
                                </div>
                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="type" value="1" id="user-type">
                                        <label class="custom-control-label" for="user-type">Building</label>
                                    </div>
                                </div>
                                <div class="text-center d-grid">
                                    <button class="btn btn-blue mt-2 w-50" type="submit"> Sign Up </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Already have account?
                                <a href="<?= base_url(); ?>auth/login" class="text-white ms-1">
                                    <b>Sign In</b>
                                </a>
                            </p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt text-white">
        <script>
            document.write(new Date().getFullYear())
        </script> &copy;
        <b>Created By</b>
        <img src="<?= base_url(); ?>assets/images/logo-light.png" class="ms-1" alt="" height="40">
    </footer>

    <script>
        $(window).ready(function() {
            const err = '<?= $_GET['err'] ?>';
            if (err) {
                alert(err)
                window.history.replaceState({}, "", '<?= base_url() . $this->url; ?>registration');
            }
        });
    </script>

</body>

<!-- Mirrored from coderthemes.com/ubold/layouts/creative/auth-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Sep 2022 22:35:17 GMT -->

</html>
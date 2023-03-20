<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico">
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

<body class="authentication-bg authentication-bg-pattern">

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">

                            <div class="text-center w-75 mx-auto mb-3">
                                <span><img src="<?php echo base_url(); ?>/assets/images/Watman-Logo.png" alt="" height="60"></span>
                            </div>

                            <form method="post" action="<?php echo base_url() . $this->url; ?>loginRun">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email" id="email" required placeholder="Enter your email">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" name="password" type="password" required id="password" placeholder="Enter your password">
                                </div>

                                <div class="text-center d-grid">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Not registered yet ?
                                <a href="<?php echo base_url(); ?>auth/registration" class="text-white ms-1">
                                    <b>Sign Up</b>
                                </a>
                            </p>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer footer-alt text-white">
        <script>
            document.write(new Date().getFullYear())
        </script> &copy;
        <b>Created By</b>
        <img src="<?php echo base_url(); ?>assets/images/logo-light.png" class="ms-1" alt="" height="40">
    </footer>
    <script src="<?php echo base_url(); ?>/assets/js/vendor.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/js/app.min.js"></script>
</body>

</html>
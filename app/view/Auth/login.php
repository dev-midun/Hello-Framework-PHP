<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 | Log in</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?= ADMIN_LTE. 'plugins/fontawesome-free/css/all.min.css'; ?>">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?= ADMIN_LTE. 'plugins/icheck-bootstrap/icheck-bootstrap.min.css'; ?>">
        <link rel="stylesheet" href="<?= ADMIN_LTE. 'dist/css/adminlte.min.css'; ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
        <link rel="stylesheet" href="<?= ADMIN_LTE. 'plugins/toastr/toastr.min.css'; ?>">
        <link rel="stylesheet" href="<?= ADMIN_LTE. 'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css'; ?>">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="<?= SITE_URL ?>"><b>Admin</b>LTE</a>
            </div>
            <!-- /.login-logo -->
            
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>

                    <form id="form-login">
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control" placeholder="Email or Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">Remember Me</label>
                                </div>
                            </div> -->
                            <!-- /.col -->
                            
                            <!-- <div class="col-4"> -->
                            <div class="col-12">
                                <button id="login-button" type="button" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <!-- <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                    </div> -->
                    <!-- /.social-auth-links -->

                    <hr>
                    <p class="mb-1">
                        <a id="forgot-password" href="javascript:void(0)" role="button">I forgot my password</a>
                    </p>
                    <!-- <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p> -->
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <script src="<?= ADMIN_LTE. 'plugins/jquery/jquery.min.js'; ?>"></script>
        <script src="<?= ADMIN_LTE. 'plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
        <script src="<?= ADMIN_LTE. 'plugins/sweetalert2/sweetalert2.min.js'; ?>"></script>
        <script src="<?= ADMIN_LTE. 'plugins/toastr/toastr.min.js'; ?>"></script>
        <script src="<?= ADMIN_LTE. 'dist/js/adminlte.min.js'; ?>"></script>
        
        <!-- Global Variable -->
        <script>
            const BASE_URL = <?php echo json_encode(BASE_URL); ?>;
            const SITE_URL = <?php echo json_encode(SITE_URL); ?>;
            const PUSHER_APP_ID = <?php echo json_encode(PUSHER_APP_ID); ?>;
            const PUSHER_KEY = <?php echo json_encode(PUSHER_KEY); ?>;
            const PUSHER_SECRET = <?php echo json_encode(PUSHER_SECRET); ?>;
            const PUSHER_CLUSTER = <?php echo json_encode(PUSHER_CLUSTER); ?>;
        </script>
        <script type="module" src="<?= BASE_URL. 'app/view/Auth/js/auth.js'; ?>"></script>
        <!-- <script src="<?= BASE_URL. 'app/view/Auth/js/login.js'; ?>"></script> -->
    </body>
</html>

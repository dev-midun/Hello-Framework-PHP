<?php
Defined('BASE_PATH') or die(ACCESS_DENIED);
$textColor = $error < 500 ? 'text-warning' : 'text-danger';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 | <?= $error ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="<?= ADMIN_LTE. 'plugins/fontawesome-free/css/all.min.css'; ?>">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?= ADMIN_LTE. 'plugins/icheck-bootstrap/icheck-bootstrap.min.css'; ?>">
        <link rel="stylesheet" href="<?= ADMIN_LTE. 'dist/css/adminlte.min.css'; ?>">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    </head>
    <body class="hold-transition login-page">
        
        <section class="content">
            <div class="error-page">
                <h2 class="headline <?= $textColor; ?>"> <?= $error ?></h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle <?= $textColor; ?>"></i> Oops! Something wrong happen.</h3>
                    <h2><?= $message; ?></h2>
                    <hr>
                    <p>Meanwhile, you may <a href="<?= SITE_URL ?>">return to home</a></p>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>

        <script src="<?= ADMIN_LTE. 'plugins/jquery/jquery.min.js'; ?>"></script>
        <script src="<?= ADMIN_LTE. 'plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
        <script src="<?= ADMIN_LTE. 'dist/js/adminlte.min.js'; ?>"></script>
    </body>
</html>

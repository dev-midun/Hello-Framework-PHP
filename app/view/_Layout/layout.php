<?php 
Defined('BASE_PATH') or die(ACCESS_DENIED); 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 3 | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS -->
        <?php require_once 'css/initCSS.php'; ?>
        
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <?php 
                echo $__header;
                echo $__sidebar;
                echo $__content;
                echo $__footer;
            ?>

            <!-- Control Sidebar -->
            <!-- <aside class="control-sidebar control-sidebar-dark"> -->
                <!-- Control sidebar content goes here -->
            <!-- </aside> -->
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- JavaScript -->
        <?php require_once 'js/initJS.php'; ?>

    </body>
</html>
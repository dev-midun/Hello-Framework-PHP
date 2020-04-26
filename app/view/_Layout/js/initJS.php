<?php 
Defined('BASE_PATH') or die(ACCESS_DENIED); 
?>

<script src="<?= ADMIN_LTE. 'plugins/jquery/jquery.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/jquery-ui/jquery-ui.min.js'; ?>"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?= ADMIN_LTE. 'plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/chart.js/Chart.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/sparklines/sparkline.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/jqvmap/jquery.vmap.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/jqvmap/maps/jquery.vmap.usa.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/jquery-knob/jquery.knob.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/moment/moment.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/daterangepicker/daterangepicker.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/summernote/summernote-bs4.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'; ?>"></script>
<script src="<?= ADMIN_LTE. 'dist/js/adminlte.js'; ?>"></script>

<!-- Global Variable -->
<script>
    const BASE_URL = <?php echo json_encode(BASE_URL); ?>;
    const SITE_URL = <?php echo json_encode(SITE_URL); ?>;
    const QUERY_STRING_AUTH = <?php echo json_encode(QUERY_STRING_AUTH); ?>;
    const PUSHER_APP_ID = <?php echo json_encode(PUSHER_APP_ID); ?>;
    const PUSHER_KEY = <?php echo json_encode(PUSHER_KEY); ?>;
    const PUSHER_SECRET = <?php echo json_encode(PUSHER_SECRET); ?>;
    const PUSHER_CLUSTER = <?php echo json_encode(PUSHER_CLUSTER); ?>;
</script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $(document).ready(function() {
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "2000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  });
</script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="<?= PATH_ASSETS ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Alert-->
<script src="<?= PATH_ASSETS ?>plugins/toastr/toastr.min.js"></script>
<script src="<?= PATH_ASSETS ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Summernote -->
<script src="<?= PATH_ASSETS ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= PATH_ASSETS ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= PATH_ASSETS ?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= PATH_ASSETS ?>dist/js/demo.js"></script>
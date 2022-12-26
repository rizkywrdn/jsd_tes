<!DOCTYPE html>
<html>

<head>

<?php include viewPath('layouts/_partials/head'); ?>
<?php include viewPath('layouts/_partials/css'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">


  <div class="wrapper">

    <?php include viewPath('layouts/_partials/navbar'); ?>
    <?php include viewPath('layouts/_partials/sidebar'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">    
              <?= $page->title; ?>
              </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <?php include viewPath('layouts/_partials/breadcrumb'); ?>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <section class="content">
        <?php
          $error_message = $this->session->flashdata("error_message");
          $success_message = $this->session->flashdata("success_message");
          if(isset($error)) {
            echo '
              <div class="alert alert-danger">
                <p>'.$this->session->flashdata('message').'</p>
              </div>
            ';
          }
          if (isset($error_message)) {
            echo '
            <div class="alert alert-danger">
              <p>'.$error_message.'</p>
            </div>
          ';
          }
          if (isset($success_message)) {
            echo '
            <div class="alert alert-success">
              <p>'.$success_message.'</p>
            </div>
          ';
          }
          if (isset($view) && $view != "") {
              $this->load->view($view);
          }
        ?>
      </section>
    </div>
    <!-- /.content-wrapper -->
    <?php include viewPath('layouts/_partials/footer'); ?>
  </div>
  <!-- ./wrapper -->
  <?php include viewPath('layouts/_partials/js'); ?>
</body>

</html>
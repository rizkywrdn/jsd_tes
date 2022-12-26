<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo url('/') ?>"><?= APP_NAME; ?></a>
  </div>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>

      <?php echo form_open(url('auth/login'), ['method' => 'POST', 'autocomplete' => 'off']); ?> 
      <div class="input-group mb-3">
          <input type="text" name="username" required class="form-control" placeholder="Username" value="<?php echo post('username') ?>" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <?php echo form_error('username', '<span style="display:block" class="error invalid-feedback">', '</span>'); ?>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" required class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?php echo form_error('password', '<span style="display:block" class="error invalid-feedback">', '</span>'); ?>
        </div>

      <div class="row">
        <div class="col-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" <?php echo post('remember_me')?'checked':'' ?> name="remember_me" /> Ingatkan saya
            </label>
          </div>
        </div>
        <!-- /.col -->

        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close(); ?>

      <p class="mb-0">
        <a href="<?= url("auth/register");?>" class="text-center">Register</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
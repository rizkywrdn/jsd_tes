<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3"><?= $page->title; ?></h3>
          <div class="ml-auto p-2">
              <a href="<?= url('users/form');?>" class="btn btn-primary btn-sm"><span class="pr-1"><i class="fa fa-plus"></i></span> Tambah</a>
          </div>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <?php echo form_open(url('users/form'.$page->view_data->id), ['method' => 'POST', 'autocomplete' => 'off']); ?> 
            <div class="input-group mb-3">
                <input type="text" name="username" required class="form-control" placeholder="Username" value="<?php echo post('username') ?>" autofocus>
              </div>

              <div class="input-group mb-3">
                <input type="password" name="password" required class="form-control" placeholder="Password">
              </div>

              <div class="input-group mb-3">
                <input type="text" name="fullname" required class="form-control" placeholder="fullname" value="<?php echo post('fullname') ?>" autofocus>
              </div>

              <div class="input-group mb-3">
                <input type="email" name="email" required class="form-control" placeholder="email" value="<?php echo post('email') ?>" autofocus>
              </div>

              <div class="input-group mb-3">
                <select name="group" class="form-control">
                  <option value="admin">admin</option>
                  <option value="operator">operator</option>
                  <option value="calon">calon</option>
                  </select>
              </div>
              

              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
              </div>
              <!-- /.col -->
            </div>
          <?php echo form_close(); ?>
        </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
</div>
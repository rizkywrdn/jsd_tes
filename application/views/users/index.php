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
                <table class="table table-bordered table-hover table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($page->user as $key => $r): ?>
                  <tr>
                      <td><?= $r->id; ?></td>
                      <td><?= $r->username; ?></td>
                      <td><?= $r->email; ?></td>
                      <td><a href="<?= url("users/form/".$r->id);?>" class="btn btn-primary">Edit</a></td>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
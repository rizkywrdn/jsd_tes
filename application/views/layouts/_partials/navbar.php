<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-fw fa-user"></i>
                <?= $users->fullname; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <a href="<?= url('users/logout') ?>" class="dropdown-item">
                    <i class="fas fa-fw fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
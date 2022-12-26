<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= PATH_ASSETS ?>img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">KURSUS ONLINE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="menu">
            <?php 
                $menu = [
                    ["name" => "Dashboard", "url" => "dashboard", "icon" => "fas fa-tachometer-alt", "access" => ["admin","operator","calon"]],
                    ["name" => "Pengguna", "url" => "users", "icon" => "fas fa-user", "access" => ["admin"]],
                    ["name" => "Kursus", "url" => "courses", "icon" => "fas fa-book", "access" => ["admin","operator"]],
                    ["name" => "Siswa", "url" => "students", "icon" => "fas fa-users", "access" => ["admin","operator"]],
                ];
            ?>
            
            <?php 
                foreach ($menu as $m): 
                if(!array_search($users->group, $m['access'])){
                    continue;
                }
            ?>
                <li class="nav-item">
                    <a href="<?= url($m['url']) ?>" class="nav-link<?= ($page->menu == $m['url'])?' active':'' ?>">
                        <i class="nav-icon <?= $m['icon']; ?>"></i>
                        <p><?= $m['name']; ?></p>
                    </a>
                </li> 
                <?php endforeach; ?>   
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
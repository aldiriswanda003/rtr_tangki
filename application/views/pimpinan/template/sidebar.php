<aside class="main-sidebar sidebar-dark-primary elevation-4" style="position:fixed ;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url(); ?>assets/style/logo/logo.png" width="100px" height="100px" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>PT. RTR</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex"> -->
        <div class="image">
            <!-- <?php foreach ($avatar as $a) { ?>
                    <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class=" img-responsive img-circle" alt="User Image">
                <?php } ?> -->
        </div>
        <!-- <div class="info">
                <a href="#" class="d-block">user <strong><?= $this->session->userdata('name') ?></strong></a>
            </div> -->
        <!-- </div> -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <!-- <li class="nav-header">MAIN NAVIGATION</li> -->
                <li class="nav-item">
                    <a href="<?= base_url('admin') ?>" class="nav-link">
                        <i class="nav-icon fa fa-home"></i> <span>Dashboard</span>
                    </a>

                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!-- <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/profile" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/users" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/tabel_supir" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Supir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/tabel_tangki" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Tangki</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/tabel_bengkel" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Bengkel</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-edit"></i> <span>Surat Tangki</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-edit"></i> <span>Exp Surat</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-edit"></i> <span>Seri Ban</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-edit"></i> <span>Supir Tangki</span>
                    </a>

                </li>

                <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-edit"></i> <span>Service Masuk</span>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-edit"></i> <span>Perbaikan</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-edit"></i> <span>Pengeluaran</span>
                    </a>

                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i> <span>Laporan</span>
                    </a>

                </li>
                <!-- <li class="nav-header">PENGATURAN</li> -->
                <!-- <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Menu User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/profile" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>admin/users" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                </li>
                    </ul> -->
                <li class="nav-item">
                    <a href="<?= base_url(''); ?>admin/signout" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
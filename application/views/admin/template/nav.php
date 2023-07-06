<nav class="main-header navbar navbar-expand  navbar-blue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: antiquewhite;"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li> -->

    </ul>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <li class="nav nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell" style="color: white"></i>
                    <?php if (empty($numOut)) { ?>
                        <span></span>
                    <?php } else { ?>
                        <span class="badge badge-warning"><?= $numOut; ?></span>
                    <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg">
                    <span class="dropdown-item dropdown-header" style="background-color: #a9e3e5;color: white;"><?= $numOut; ?> Notifikasi</span>
                    <div class="dropdown-divider"></div>
                    <?php foreach ($notifOut as $c) : ?>
                        <div class="card-footer">
                            <a href="#" style="text-decoration: none; color: black;"><strong><?= $c->id_surat; ?><br><?= $c->id_tangki; ?><br><?= $c->jenis_surat; ?></strong><br>
                                <small style="color: red;">Mati Tanggal <strong><?= date('d/m/Y', strtotime($c->tanggal_expired)); ?></strong></small></a>
                            <!-- <a href="#" class="dropdown-item">
                  </a> -->
                        </div>
                    <?php endforeach ?>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer"></a>
                </div>
            </li>

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php foreach ($avatar as $a) { ?>
                        <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class="user-image" alt="User Image">
                    <?php } ?>-->
                <i class="far fa-user"></i>&nbsp;
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span style="color:aliceblue" class="hidden-xs"><?= $this->session->userdata('name') ?></span>
                </a>





                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="card-body">
                        <!-- <?php foreach ($avatar as $a) { ?>
                            <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class="profile-user-img img-responsive img-circle" alt="User Image">
                        <?php } ?> -->
                        <p>
                            <strong><?= $this->session->userdata('name') ?></strong> sebagai Administrator <br>
                            <!-- <small>Last Login : <?= $this->session->userdata('last_login') ?></small><br> -->
                        </p>
                    </li>
                    <!-- Menu Body -->

                    <!-- Menu Footer-->
                    <li class="card-footer">
                        <span class="fa-pull-left">
                            <button class="btn btn-default btn-flat btn-sm" onclick="window.location.href='<?= base_url('admin/profile'); ?>'"><i class="fa fa-cog"></i>&nbsp;Profile</button>
                        </span>
                        <span class="fa-pull-right">
                            <button class="btn btn-default btn-flat btn-sm" onclick="window.location.href='<?= base_url('admin/signout'); ?>'"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
                        </span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<nav class="main-header navbar navbar-expand " style="background-color: #8d1616;">
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

            

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php foreach ($avatar as $a) { ?>
                        <img src="<?= base_url('assets/upload/user/' . $a->nama_file); ?>" class="user-image" alt="User Image">
                    <?php } ?>-->
                <i class="far fa-user" style="color: aliceblue;"></i>&nbsp;
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
                            <strong><?= $this->session->userdata('name') ?></strong> sebagai Koordinator <br>
                            <!-- <small>Last Login : <?= $this->session->userdata('last_login') ?></small><br> -->
                        </p>
                    </li>
                    <!-- Menu Body -->

                    <!-- Menu Footer-->
                    <li class="card-footer">
                        <span class="fa-pull-left">
                            <button class="btn btn-default btn-flat btn-sm" onclick="window.location.href='<?= base_url('koor/profile'); ?>'"><i class="fa fa-cog"></i>&nbsp;Profile</button>
                        </span>
                        <span class="fa-pull-right">
                            <button class="btn btn-default btn-flat btn-sm" onclick="window.location.href='<?= base_url('koor/signout'); ?>'"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</button>
                        </span>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<?php $this->load->view('login/template/head'); ?>

<body class="hold-transition login-page auth-bg">

    <div class="wrapper">
        <table style="background-color: blue;">
            <tr><marquee><h3 style="color:white; font-family:'arial'; font-size:15pt; position: relative;">
            <strong>APLIKASI MANAJEMEN PERBAIKAN DAN PENDATAAN TRUK TANGKI DI PT.RAHMAT TAUFIK RAMADAN BERBASIS WEB</strong></marquee></h3>
        </tr>
        </table>

        <!-- <div class="row">
            <h3 style="color:white; font-family:'arial'; font-size:15pt; position: relative;"><strong>APLIKASI MANAJEMEN PERBAIKAN DAN PENDATAAN TRUK TANGKI DI PT.RAHMAT TAUFIK RAMADAN BERBASIS WEB</strong></h3>
            </div> -->

        <div class="login-box">
            <div class="login-logo">
                <img class="img" src="<?= base_url(); ?>assets/style/logo/LOGO RTR  border putih .png" alt="Logo" height="120px">
                <p style="color:white; font-family:'bebas neue'; font-size:30pt;"><strong>SELAMAT DATANG</strong></p>
            </div>
            <!-- /.login-logo -->

           

            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Login Untuk Memulai Sesi</p>

                    <form action="<?= base_url('login/proses_login'); ?>" class="login" method="post">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-warning alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Peringatan!</strong><br> <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <?php if (isset($token_generate)) { ?>
                                <input type="hidden" name="token" value="<?php echo $token_generate ?>">
                            <?php } else {
                                        redirect(base_url());
                                    } ?> -->
                            <div class="col-8">
                                <!-- <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div> -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-warning btn-block"><i class="fas fa-sign-in-alt"></i>&nbsp;Log In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.login-card-body -->
            </div>
            <div class="footer">
                </div>
                
                <!-- /.login-box -->
            </div>
            <center><small style="color: antiquewhite;"> &copy; ARPRO 2023-<script type="text/javascript">
                        document.write(new Date().getFullYear());
                    </script></small>
                    <br>
                    <text style="color: black;">admin | admin</text><br>
                    <text style="color: black;">bayunug | bayunug</text><br>
                    <text style="color: black;">devinabos | 123</text>
            </center>
        </div>
        

    <?php $this->load->view('login/template/script'); ?>

</body>

</html>
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   <h1 class="m-0"><ins>Dashboard</ins></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <h2 align="center">Selamat Datang <strong><?= $this->session->userdata('name') ?></strong> ! di :</h2>
            <h3 align="center">APLIKASI MANAJEMEN PERBAIKAN DAN PENDATAAN TRUK TANGKI DI PT.RAHMAT TAUFIK RAMADAN BERBASIS WEB</h3>
            <div class="row">


                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php if (!empty($dataSupir)) { ?>
                                <h3><?= $dataSupir ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Supir</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php if (!empty($dataTruk)) { ?>
                                <h3><?= $dataTruk ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Truk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php if (!empty($dataPerbaikan)) { ?>
                                <h3><?= $dataPerbaikan ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Perbaikan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wrench"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <?php if (!empty($dataPengeluaran)) { ?>
                                <h3><?= $dataPengeluaran ?></h3>
                            <?php } else { ?>
                                <h3>Rp 0</h3>
                            <?php } ?>
                            <p>Pengeluaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope-open"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php if (!empty($dataSrtExp)) { ?>
                                <h3><?= $dataSrtExp ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Surat Expired</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- <div class="card">
                    <div class="card-body">
                        <?php if (is_array($count)) { ?>
                            <?php foreach ($count as $c) : ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <a href="<?= base_url(); ?>admin/tabel_sparepart" style="text-decoration: none; color: black;"><strong> <?= $c->nama_sparepart; ?></strong><span> sisa <strong><?= $c->stok; ?></strong></span><br>
                                        <small style="color: red;">Segera lakukan pembelian untuk menambah stok</small></a>
                                </div>
                            <?php endforeach ?>
                        <?php } ?>
                    </div>
                </div> -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('admin/template/script') ?>
<script>
    //* Script untuk menampilkan loading
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loading").style.visibility = "visible";
        } else {
            document.querySelector(
                "#loading").style.display = "none";
            document.querySelector(
                "body").style.visibility = "visible";
        }
    };
</script>
</body>

</html>
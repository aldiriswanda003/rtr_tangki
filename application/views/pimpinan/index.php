<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   <h1 class="m-0"><ins>Dashboard - Pimpinan</ins></h1>
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
            <!-- <h3 align="center">APLIKASI MANAJEMEN PERBAIKAN DAN PENDATAAN TRUK TANGKI DI PT.RAHMAT TAUFIK RAMADAN BERBASIS WEB</h3> -->
            <div class="row">


            <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-black" style="background-color: #5C5427;">
                        <div class="inner">
                            <?php if (!empty($dataSupir)) { ?>
                                <h3><?= $dataSupir ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Supir</p>
                        </div>
                        <div class="icon">
                            <i class="fas"> <img src="assets/upload/supir/MUHAMMAD ISMAIL - FOTO 2.png" alt="" width="80px"></i>

                        </div>
                        <a href="<?= base_url(); ?>report_pimpinan/tabel_supir" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-black" style="background-color: #5C5427;">
                        <div class="inner">
                            <?php if (!empty($tangki)) { ?>
                                <h3><?= $tangki ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Truk Tangki</p>
                        </div>
                        <div class="icon">
                            <!-- <i class="fas fa-truck"></i> -->
                            <i class="fas"> <img src="assets/upload/foto_tangki/W 9981 UC - DEPAN SAMPING KIRI copy.png" alt="" width="120px"></i>
                        </div>
                        <a href="report_pimpinan/tabel_tangki" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-black" style="background-color: #5C5427;">
                        <div class="inner">
                            <?php if (!empty($dataServMasuk)) { ?>
                                <h3><?= $dataServMasuk ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Perbaikan Masuk</p>
                        </div>
                        <div class="icon">
                            <!-- <i class="fas fa-wrench"></i> -->
                            <i class="fas"> <img src="assets/upload/perbaikan_masuk.png" alt="" width="100px"></i>

                        </div>
                        <a href="admin/tabel_service_masuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div style="background-color: #5C5427;" class="small-box bg-black" style="background-color: #5C5427;">
                        <div class="inner">
                            <?php if (!empty($dataPerbaikan)) { ?>
                                <h3><?= $dataPerbaikan ?></h3>
                            <?php } else { ?>
                                <h3>0</h3>
                            <?php } ?>
                            <p>Perbaikan Disetujui</p>
                        </div>
                        <div class="icon">
                            <!-- <i class="fas fa-wrench"></i> -->
                            <i class="fas"> <img src="assets/upload/perbaikan_disetujui.png" alt="" width="100px"></i>

                        </div>
                        <a href="admin/tabel_perbaikan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
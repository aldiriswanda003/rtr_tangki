<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Tujuan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_tangki'); ?>">Data Tujuan</a></li>
                        <li class="breadcrumb-item active">Edit Data Tujuan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="width: 30%; margin-left: 35%;">
                        <div class="card-header">
                            Edit Data Tujuan
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-warning alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Perhatian!</strong><br> <?php echo validation_errors(); ?>
                                </div>
                            <?php } ?>

                            <form action="<?= base_url('admin/proses_edit_tujuan'); ?>" method="post" role="form">
                                <?php foreach ($tujuan as $t) { ?>

                                    <div class="form-group">
                                        <input type="hidden" name="id_tujuan" value="<?= $t->id_tujuan; ?>">
                                        <label for="nama_tujuan" class="form-label">Nama - Tempat Tujuan</label>
                                        <input type="text" name="nama_tujuan" class="form-control" id="nama_tujuan" placeholder="contoh : PT. BSS - Kandangan" required value="<?= $t->nama_tujuan; ?>">
                                    </div>

                                    <div class="form-group">
                                        <input type="hidden" name="id_tujuan" value="<?= $t->id_tujuan; ?>">
                                        <label for="kilometer_pp" class="form-label">Jarak Pulang Pergi</label>
                                        <input type="text" name="kilometer_pp" class="form-control" id="kilometer_pp" placeholder="Masukkan Jarak Pulang Pergi" required value="<?= $t->kilometer_pp; ?>">
                                    </div>
                                
                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/tabel_tujuan'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
                                    <!-- <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-eraser mr-2"></i>Reset</button> -->
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('admin/template/script') ?>

</body>

</html>
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Tangki</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_tangki'); ?>">Data Tangki</a></li>
                        <li class="breadcrumb-item active">Edit Data Tangki</li>
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
                            Edit Data Tangki
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

                            <form action="<?= base_url('admin/proses_edit_tangki'); ?>" method="post" role="form" enctype="multipart/form-data">
                                <?php foreach ($tangki as $t) { ?>

                                    <div class="form-group">
                                        <input type="hidden" name="id_tangki" value="<?= $t->id_tangki; ?>">
                                        <label for="nopol" class="form-label">Nopol</label>
                                        <input type="text" name="nopol" class="form-control" id="nama" placeholder="Masukkan Nopol Mobil" required value="<?= $t->nopol; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="no_hp" class="form-label">Tahun Dibuat</label>
                                        <input type="text" maxlength="8" name="tahun_dibuat" class="form-control" id="tahun_dibuat" placeholder="Masukkan Tahun Dibuat" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $t->tahun_dibuat; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp" class="form-label">Volume Tangki</label>
                                        <div class="input-group">
                                            <input type="text" maxlength="15" name="volume_tangki" class="form-control" id="volume_tangki" placeholder="Masukkan Volume Tangki" required onkeypress='return (event.charCode > 47 && event.charCode < 58)' value="<?= $t->volume_tangki; ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Liter</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="foto_depan" class="form-label">Foto dari depan</label>
                                        <input type="file" name="foto_depan" class="form-control" id="foto_depan" placeholder="Masukkan Foto Truk Tangki" >
                                        <input type="hidden" name="foto_depan_old" value="<?= $t->foto_depan; ?>">
                                        
                                        <span><small style="color:red"><strong>*UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="foto_belakang" class="form-label">Foto dari belakang</label>
                                        <input type="file" name="foto_belakang" class="form-control" id="foto_belakang" placeholder="Masukkan Foto Truk Tangki" >
                                        <input type="hidden" name="foto_belakang_old" value="<?= $t->foto_belakang; ?>">
                                        <span><small style="color:red"><strong>*UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="foto_kanan" class="form-label">Foto dari kanan</label>
                                        <input type="file" name="foto_kanan" class="form-control" id="foto_kanan" placeholder="Masukkan Foto Truk Tangki" >
                                        <input type="hidden" name="foto_kanan_old" value="<?= $t->foto_kanan; ?>">
                                        <span><small style="color:red"><strong>*UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="foto_kiri" class="form-label">Foto dari kiri</label>
                                        <input type="file" name="foto_kiri" class="form-control" id="foto_kiri" placeholder="Masukkan Foto Truk Tangki" >
                                        <input type="hidden" name="foto_kiri_old" value="<?= $t->foto_kiri; ?>">
                                        <span><small style="color:red"><strong>*UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                    </div>

                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/tabel_tangki'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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
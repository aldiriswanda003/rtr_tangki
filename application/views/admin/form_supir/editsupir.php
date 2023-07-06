<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Supir</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_supir'); ?>">Data Supir</a></li>
                        <li class="breadcrumb-item active">Edit Data Supir</li>
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
                            Edit Data Supir
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

                            <form action="<?= base_url('admin/proses_edit_supir'); ?>" method="post" role="form" enctype="multipart/form-data">
                                <?php foreach ($supir as $s) { ?>
                                    <div class="form-group">
                                        <input type="hidden" name="id_supir" value="<?= $s->id_supir; ?>">
                                        <label for="nama" class="form-label">Nama Supir</label>
                                        <input type="text" name="nama_supir" class="form-control" id="nama" placeholder="Masukkan Nama" required value="<?= $s->nama_supir; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp" class="form-label">No. Telp</label>
                                         <input type="text" maxlength="25" name="no_telp" class="form-control" id="no_hp" placeholder="Masukkan No. Telp" required   value="<?= $s->no_telp; ?>"> 
                                         <!-- onkeypress='return (event.charCode > 47 && event.charCode < 58)' -->
                                         <!-- taruh didalam input -->
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Foto Supir</label>
                                        <input type="file" name="foto_supir" class="form-control" id="foto_supir" placeholder="Masukkan Foto Supir">
                                        <input type="hidden" name="foto_supir_old" value="<?= $s->foto_supir; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Foto SIM</label>
                                        <input type="file" name="foto_sim" class="form-control" id="foto_supir" placeholder="Masukkan Foto SIM">
                                        <input type="hidden" name="foto_sim_old" value="<?= $s->foto_sim; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="form-label">Foto KTP</label>
                                        <input type="file" name="foto_ktp" class="form-control" id="foto_supir" placeholder="Masukkan Foto KTP">
                                        <input type="hidden" name="foto_ktp_old" value="<?= $s->foto_ktp; ?>">
                                    </div>
                                    <hr>
                                    <div class="form-group" align="center">
                                        <a href="<?= base_url('admin/tabel_supir'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
                                        <!-- <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-eraser mr-2"></i>Reset</button> -->
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Simpan</button>
                                    </div>
                                <?php } ?>
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
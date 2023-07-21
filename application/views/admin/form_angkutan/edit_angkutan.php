<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">EDIT ANGKUTAN</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_surat_tangki'); ?>">Data Angkutan</a></li>
                        <li class="breadcrumb-item active">Edit Data Angkutan</li>
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
                            Edit Data Angkutan
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

                            <form action="<?= base_url('admin/proses_edit_angkutan'); ?>" method="post" role="form" enctype="multipart/form-data">
                                <?php foreach ($angkutan as $s) { ?>

                                    <div class="form-group">
                                        <label for="id_angkutan" class="form-label">Data Supir Tangki</label>

                                        <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->


                                        <input type="hidden" name="id_angkutan" value="<?= $s->id_angkutan; ?>">

                                        <select name="id_supir_tangki" class="form-control" id="id_supir_tangki">
                                            <option value="" disabled>-- Pilih Data Supir Tangki --</option>
                                            <?php foreach ($list_supirtangki as $t) { ?>
                                                <?php if ($s->id_supir_tangki == $t->id_supir_tangki) { ?>
                                                    <option value="<?= $t->id_supir_tangki; ?>"><?= $t->nopol; ?> - <?= $t->volume_tangki; ?> Liter - <?= $t->nama_supir; ?>

                                                    <?php } else { ?>
                                                    <option value="<?= $t->id_supir_tangki; ?>"><?= $t->nopol; ?> - <?= $t->volume_tangki; ?> Liter - <?= $t->nama_supir; ?>

                                                    <?php } ?>
                                                <?php } ?>
                                        </select>
                                    </div>




                                    <div class="form-group">
                                        <label for="date" class="form-label">Tanggal Berangkat</label>
                                        <input type="date" name="tgl_berangkat" class="form-control" id="tgl_berangkat" placeholder="Masukkan Berangkat" required value="<?= $s->tgl_berangkat; ?>">

<br>
                                        <div class="form-group">
                                            <label for="id_tujuan" class="form-label">Tujuan dan Jarak PP</label>

                                            <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->



                                            <select name="id_tujuan" class="form-control" id="id_tujuan">
                                                <option value="" disabled>-- Pilih Tujuan dan Jarak PP --</option>
                                                <?php foreach ($tujuan as $t) { ?>
                                                    <?php if ($s->id_tujuan == $t->id_tujuan) { ?>
                                                        <option value="<?= $s->id_tujuan; ?>"> <?= $t->nama_tujuan; ?> - <?= $t->kilometer_pp; ?> KM (Pulang Pergi)


                                                        <?php } else { ?>
                                                            <option value="<?= $s->id_tujuan; ?>"> <?= $t->nama_tujuan; ?> - <?= $t->kilometer_pp; ?> KM (Pulang Pergi)

                                                        <?php } ?>
                                                    <?php } ?>
                                            </select>
                                        </div>


                                        <hr>
                                        <div class="form-group " align="center">
                                            <a href="<?= base_url('admin/tabel_bengkel'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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
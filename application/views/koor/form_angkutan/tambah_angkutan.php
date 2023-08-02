<?php $this->load->view('template/head'); ?>
<?php $this->load->view('koor/template/nav'); ?>
<?php $this->load->view('koor/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah data angkutan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('koor'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('koor/tabel_surat_tangki'); ?>">Data angkutan</a></li>
                        <li class="breadcrumb-item active">Tambah Data Angkutan</li>
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
                    <div class="card" style="width: 100%; margin-left: 0%;">
                        <div class="card-header">
                            Tambah Data Angkutan
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

                            <form action="<?= base_url('koor/proses_tambah_angkutan'); ?>" method="post" role="form" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="id_supir_tangki" class="form-label">Ambil Data Supir</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_supir_tangki" class="form-control" id="id_supir_tangki">
                                        <option value="" selected>-- Pilih Tangki dan Supir --</option>
                                        <?php foreach ($list_supirtangki as $s) : ?>
                                            <option value="<?= $s->id_supir_tangki; ?>"><?= $s->nopol; ?> - <?= $s->volume_tangki; ?> Liter - <?= $s->nama_supir; ?>

                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="date" class="form-label">Tanggal Berangkat</label>
                                    <input type="date" name="tgl_berangkat" class="form-control" id="tgl_berangkat" placeholder="Masukkan Tanggal Berangkat" required>
                                </div>
                                    <div class="form-group">
                                        <label for="nopol" class="form-label">Tujuan dan Jarak PP</label>
                                        <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                        <select name="id_tujuan" class="form-control" id="id_tujuan">
                                            <option value="" selected>-- Pilih Tujuan dan Jarak PP --</option>
                                            <?php foreach ($tujuan as $s) : ?>
                                                <option value="<?= $s->id_tujuan; ?>"> <?= $s->nama_tujuan; ?> - <?= $s->kilometer_pp; ?> KM (Pulang Pergi)

                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <!-- <div class="form-group">
                                    <label for="no_hp" class="form-label">Jenis Surat</label>
                                    <input type="text" name="jenis_surat" class="form-control" id="jenis_surat" placeholder="Masukkan Jenis Surat" required>
                                </div> -->





                                    <hr>
                                    <div class="form-group" align="center">
                                        <a href="<?= base_url('koor/tabel_exp_surat'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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

<?php $this->load->view('koor/template/script') ?>

</body>

</html>
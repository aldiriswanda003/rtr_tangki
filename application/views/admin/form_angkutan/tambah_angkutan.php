<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_surat_tangki'); ?>">Data angkutan</a></li>
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
                            Tambah Data Surat - surat Tangki yang akan diajukan perpanjangan
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

                            <form action="<?= base_url('admin/proses_tambah_exp_surat'); ?>" method="post" role="form" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="nopol" class="form-label">Ambil Data Surat-surat tangki</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_surat" class="form-control" id="id_surat">
                                        <option value="" selected>-- Pilih Surat --</option>
                                        <?php foreach ($list_surat_tangki as $s) : ?>
                                            <option value="<?= $s->id_surat; ?>"><?= $s->nopol; ?> - <?= $s->jenis_surat; ?> - <?= $s->tanggal_expired; ?> - <?php if($s->status == 0){
                                        echo "SUDAH MATI";
                                    } else {
                                        echo "BELUM MATI";
                                    } ?> 
                                        </option>
                                        <?php endforeach ?>
                                    </select>

                                </div>
                                <!-- <div class="form-group">
                                    <label for="no_hp" class="form-label">Jenis Surat</label>
                                    <input type="text" name="jenis_surat" class="form-control" id="jenis_surat" placeholder="Masukkan Jenis Surat" required>
                                </div> -->

                                    <!-- <div class="form-group">
                                    <label for="date" class="form-label">Tanggal Masa Berlaku</label>
                                    <input type="date" name="tanggal_expired" class="form-control" id="tanggal_expired" placeholder="Masukkan Tanggal Masa berlaku" required> -->
                            
                                    

                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/tabel_exp_surat'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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
<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data 1</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_supir'); ?>">Data 1</a></li>
                        <li class="breadcrumb-item active">edit Data 1</li>

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
                            edit Data
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
                            <?php foreach ($data1 as $b) { ?>
                            
                                <form action="<?= base_url('admin/proses_edit_data1'); ?>" method="post" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="id_buku" value="<?= $b->id_buku; ?>">
                            
                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama Karyawan</label>
                                    <input type="text" name="nomor_buku" class="form-control" id="nomor_buku" placeholder="Masukkan Nama" required value="<?= $b->nomor_buku; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="no_hp" class="form-label">Tanggal Lahir</label>
                                    <input type="text" name="judul" class="form-control" id="judul" placeholder="Masukkan Data" required value="<?= $b->judul; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="no_hp" class="form-label">Tanggal Lahir</label>
                                    <input type="text" name="penerbit" class="form-control" id="penerbit" placeholder="Masukkan Data" required value="<?= $b->penerbit; ?>">
                                </div>
                             
                                <div class="form-group">
                                    <label for="no_hp" class="form-label">Tanggal Lahir</label>
                                    <input type="text" name="tahun" class="form-control" id="tahun" placeholder="Masukkan Data" required value="<?= $b->tahun; ?>">
                                </div>
                                
                                </div>
                                <?php } ?>
                                <!-- penutup foreach -->
                                <!-- <div class="form-group">
                                    <label for="alamat" class="form-label">Foto Supir</label>
                                    <input type="file" name="foto_supir" class="form-control" id="foto_supir" placeholder="Masukkan Foto Supir" required>
                                    <span><small style="color:red"><strong>UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                </div>
                                
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Foto SIM</label>
                                    <input type="file" name="foto_sim" class="form-control" id="foto_supir" placeholder="Masukkan Foto SIM" required>
                                    <span><small style="color:red"><strong>UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class="form-label">Foto KTP</label>
                                    <input type="file" name="foto_ktp" class="form-control" id="foto_supir" placeholder="Masukkan Foto KTP" required>
                                    <span><small style="color:red"><strong>UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                </div> -->
                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/tabel_data1'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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
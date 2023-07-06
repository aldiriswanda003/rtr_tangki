<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">EDIT SUPIR TANGKI</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_surat_tangki'); ?>">Data Seri Ban</a></li>
                        <li class="breadcrumb-item active">Edit Data SUPIR TANGKI</li>
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
                            Edit Data Supir Tangki
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

                            <form action="<?= base_url('admin/proses_edit_supir_tangki'); ?>" method="post" role="form" enctype="multipart/form-data">
                                <?php foreach ($list_supir_tangki as $st) { ?>
                                    <input type="hidden" name="id_supir_tangki" value="<?= $st->id_supir_tangki; ?>">

                                    <div class="form-group">
                                    <label for="nama_supir" class="form-label">Nama Supir</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_supir" class="form-control" id="id_supir">
                                            <option value="" disabled>-- Pilih Supir --</option>
                                            <?php foreach ($list_supir as $ls) { ?>
                                                <?php if ($st->id_supir == $ls->id_supir) { ?>
                                                    <option value="<?= $st->id_supir; ?>" selected><?= $ls->nama_supir; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $ls->id_supir; ?>"><?= $ls->nama_supir; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                </div>

                                    <div class="form-group">
                                    <label for="nama_tangki" class="form-label">Nama Tangki</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_tangki" class="form-control" id="id_tangki">
                                            <option value="" disabled>-- Pilih Tangki --</option>
                                            <?php foreach ($list_tangki as $t) { ?>
                                                <?php if ($st->id_tangki == $st->id_tangki) { ?>
                                                    <option value="<?= $t->id_tangki; ?>" selected><?= $t->nopol; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $t->id_tangki; ?>"><?= $t->nopol; ?></option>
                                                    <!-- meambil di foreach -->

                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                </div>


                                <div class="form-group">
                                    <label for="tanggal_update" class="form-label">Tanggal Update</label>
                                    <input type="date" name="tanggal_update" class="form-control" id="tanggal_update" placeholder="Masukkan Tanggal Update" required  value="<?= $st->tanggal_update; ?>" >
                
                                
                               
                                    


                                   
                            
                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/tabel_seri_ban'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
                                    <!-- <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-eraser mr-2"></i>Reset</button> -->
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>Simpan</button>
                                </div>
                                <?php }?>
                        
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
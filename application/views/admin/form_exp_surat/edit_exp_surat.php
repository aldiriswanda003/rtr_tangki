<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">EDIT EXP SURAT TANGKI</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_exp_surat'); ?>">Data Exp Surat</a></li>
                        <li class="breadcrumb-item active">Edit Exp Surat Tangki</li>
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
                            Edit Data Surat - surat Tangki yang akan diajukan perpanjangan

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

                            <form action="<?= base_url('admin/proses_edit_exp_surat'); ?>" method="post" role="form" enctype="multipart/form-data">
                                <?php foreach ($list_exp_surat as $st) { ?>
                                    <input type="hidden" name="id_exp_surat" value="<?= $st->id_exp_surat; ?>">

                                    <div class="form-group">
                                        <label for="nopol" class="form-label">Ambil Data Surat-surat tangki</label>
                                        <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                        <select name="id_surat" class="form-control" id="id_surat">
                                            <option value="" selected>-- Pilih Surat --</option>
                                            <?php foreach ($list_surat_tangki as $s) : ?>
                                                <?php if ($st->id_surat == $s->id_surat) { ?>

                                                    <option value="<?= $s->id_surat; ?>" selected><?= $s->nopol; ?> - <?= $s->jenis_surat; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?= $s->id_surat; ?>"><?= $s->nopol; ?> - <?= $s->jenis_surat; ?></option>
                                                <?php } ?>
                                            <?php endforeach ?>
                                        </select>

                                    </div>
                                    <!-- <div class="form-group">
    <label for="perkiraan_biaya" class="form-label">Nopol</label>
    <input type="int" disabled name="nopol" class="form-control" id="nopol" placeholder="Nopol">
</div> -->

                                    <!-- <div class="form-group">
    <label for="perkiraan_biaya" class="form-label">Jenis Surat</label>
    <input type="int" disabled name="jenis_surat" class="form-control" id="jenis_surat" placeholder="Jenis Surat">
</div> -->

                                    <div class="form-group">
                                        <label for="perkiraan_biaya" class="form-label">Tanggal Expired</label>
                                        <input type="int" disabled name="tanggal_expired" class="form-control" id="tanggal_expired" placeholder="Tanggal Masa Berlaku">
                                    </div>
                                    <div class="form-group">
                                        <label for="perkiraan_biaya" class="form-label">Status</label>
                                        <input type="int" disabled name="status" class="form-control" id="status" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="perkiraan_biaya" class="form-label">Perkiraan Biaya</label>
                                        <input type="int" name="perkiraan_biaya" class="form-control" id="perkiraan_biaya" placeholder="Masukkan Nominal Perkiraan Biaya" required value="<?= $st->perkiraan_biaya; ?>">
                                    </div>

                                    <!-- <div class="form-group">
    <label for="date" class="form-label">Tanggal Masa Berlaku</label>
    <input type="date" name="tanggal_expired" class="form-control" id="tanggal_expired" placeholder="Masukkan Tanggal Masa berlaku" required> -->



                                    <hr>
                                    <div class="form-group" align="center">
                                        <a href="<?= base_url('admin/tabel_exp_surat'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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
<script>
    $("#id_surat").change(function() {
        let id_surat = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($list_surat_tangki as $s) { ?>
            if (id_surat == "<?php echo $s->id_surat ?>") {

                $("#tanggal_expired").val("<?php echo date('d-m-Y', strtotime($s->tanggal_expired)) ?>");
                // $("#nopol").val("<?php echo $s->nopol ?>");
                $("#jenis_surat").val("<?php echo $s->jenis_surat ?>");
                <?php if ($s->status == 0) { ?>
                    $("#status").val("Belum Mati");
                <?php } else { ?>
                    $("#status").val("Belum Mati");
                <?php } ?>
            }
        <?php } ?>
    })
</script>


<script>
    $("#id_surat").show(function() {
        let id_surat = $(this).val();
        // let stok_gd = document.getElementById("stok_gd");

        <?php foreach ($list_surat_tangki as $s) { ?>
            if (id_surat == "<?php echo $s->id_surat ?>") {

                $("#tanggal_expired").val("<?php echo date('d-m-Y', strtotime($s->tanggal_expired)) ?>");
                // $("#nopol").val("<?php echo $s->nopol ?>");
                $("#jenis_surat").val("<?php echo $s->jenis_surat ?>");
                <?php if ($s->status == 0) { ?>
                    $("#status").val("Belum Mati");
                <?php } else { ?>
                    $("#status").val("Belum Mati");
                <?php } ?>
            }
        <?php } ?>
    })
</script>


</body>

</html>
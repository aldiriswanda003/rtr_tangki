<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Perbaikan Masuk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_service_masuk'); ?>">Data Surat Tangki</a></li>
                        <li class="breadcrumb-item active">Tambah Perbaikan masuk</li>
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
                    <div class="card" style="width: 70%; margin-left: 20%;">
                        <div class="card-header">
                            Tambah Data Perbaikan Masuk dibawah ini
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

                            <form action="<?= base_url('admin/proses_tambah_service_masuk'); ?>" method="post" role="form" enctype="multipart/form-data">

                           


                             

                                    
                                <div class="form-group">
                                    <label for="supir_tangki" class="form-label">Nopol</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_supir_tangki" class="form-control" id="id_supir_tangki">
                                        <option value="" selected>-- Nopol --</option>
                                        <?php foreach ($list_supir_tangki as $s) { ?>
                                            <option value="<?= $s->id_supir_tangki; ?>"><?= $s->nopol; ?> - <?= $s->nama_supir; ?>
                                        </option>
                                        <?php } ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="nama_bengkel" class="form-label">Bengkel</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_bengkel" class="form-control" id="id_bengkel">
                                        <option value="" selected>-- Pilih Bengkel --</option>
                                        <?php foreach ($list_bengkel as $s) { ?>
                                            <option value="<?= $s->id_bengkel; ?>"><?= $s->nama_bengkel; ?></option>
                                        <?php } ?>
                                    </select>
                                      
                                </div>

                                <div class="form-group">
                                    <label for="date" class="form-label">Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" placeholder="Masukkan Tanggal Masuk Perbaikan" required>
                                </div>                    

                                <!-- <div class="form-group">
                                    <label for="alamat" class="form-label">Foto Surat</label>
                                    <input type="file" name="foto_surat" class="form-control" id="foto_surat" placeholder="Masukkan Foto Surat">
                                    <span><small style="color:red"><strong>UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                </div> -->

                                    <div class="form-group">
                                    <label for="text" class="form-label">keluhan</label>
                                    <input type="text" name="keluhan" class="form-control" id="keluhan" placeholder="Masukkan Keluhan perbaikan" required>
                                    </div>

                                    <div class="form-group">
                                    <label for="text" class="form-label">Biaya</label>
                                    <input type="text" name="biaya" class="form-control" id="#" placeholder="Masukkan Perkiraan biaya" required>
                                    </div>

                                    <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="status" class="form-control" id="status">
                                        
                                        <option value="" selected="" disabled>-- Pilih Status --</option>
                                        <option value="0">PROSES</option>
                                        <option value="1">SUDAH SELESAI</option>
                                        
                                    </select>
                                      
                                </div>

                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/tabel_service_masuk'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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

<script>
var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

</script>
</body>

</html>
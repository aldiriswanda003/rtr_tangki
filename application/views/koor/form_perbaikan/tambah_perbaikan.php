<?php $this->load->view('template/head'); ?>
<?php $this->load->view('koor/template/nav'); ?>
<?php $this->load->view('koor/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah data perbaikan disetujui</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('koor'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('koor/tabel_perbaikan'); ?>">Data Surat Tangki</a></li>
                        <li class="breadcrumb-item active">Tambah Perbaikan disetujui</li>
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
                            Tambahkan Data Perbaikan yang disetujui
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

                            <form action="<?= base_url('koor/proses_tambah_perbaikan'); ?>" method="post" role="form" enctype="multipart/form-data">

                           


                             

                                    
                                <div class="form-group">
                                    <label for="supir_tangki" class="form-label">Nopol </label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_service_masuk" class="form-control" id="id_service_masuk">
                                        <option value="" selected>Perbaikan yang selesai</option>
                                        <?php foreach ($list_service_masuk as $s) : ?>
                                            <option value="<?= $s->id_service_masuk;?>"><?= $s->nopol; ?> - <?= $s->nama_bengkel; ?> - <?= $s->keluhan; ?> - <?php if($s->status == 0){
                                               echo "PROSES";
                                            } else {
                                                echo "SUDAH SELESAI";
                                            } ?> 
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>

                                

                                <div class="form-group">
                                    <label for="date" class="form-label">Tanggal Masuk</label>
                                    <input type="date" name="tgl_perbaikan" class="form-control" id="tgl_perbaikan" placeholder="Masukkan Tanggal Masuk Perbaikan" required>
                                </div>                    

                                <!-- <div class="form-group">
                                    <label for="alamat" class="form-label">Foto Surat</label>
                                    <input type="file" name="foto_surat" class="form-control" id="foto_surat" placeholder="Masukkan Foto Surat">
                                    <span><small style="color:red"><strong>UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                </div> -->

                                    <div class="form-group">
                                    <label for="text" class="form-label">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan Keluhan perbaikan" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="foto_nota" class="form-label">Foto Nota</label>
                                        <input type="file" name="foto_nota" class="form-control" id="foto_nota" placeholder="Masukkan Foto Nota">
                                        <span><small style="color:red"><strong>UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                    </div>

                                    <div class="form-group">
                                    <label for="text" class="form-label">Biaya</label>
                                    <input type="text" name="biaya_perbaikan" class="form-control" id="" placeholder="Masukkan Perkiraan biaya" required>
                                    </div>

                                   
            
                                      
                                </div>

                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('koor/tabel_perbaikan'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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
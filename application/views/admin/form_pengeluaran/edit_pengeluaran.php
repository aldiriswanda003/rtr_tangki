<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Pengeluaran</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tabel_bengkel'); ?>">Data Bengkel</a></li>
                        <li class="breadcrumb-item active">Edit Data Pemgeluaran lain lain</li>
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
                            Edit Data Pengeluaran
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

                            <form action="<?= base_url('admin/proses_edit_pengeluaran'); ?>" method="post" role="form">
                                <?php foreach ($pengeluaran as $b) { ?>

                                    <div class="form-group">
                                        <input type="hidden" name="id_pengeluaran" value="<?= $b->id_pengeluaran; ?>">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" id="nama" placeholder="Masukkan Tanggal" required value="<?= $b->tanggal; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_pengeluaran" class="form-label">Keterangan Pengeluaran</label>
                                        <input type="text" name="nama_pengeluaran" class="form-control" id="nama_pengeluaran" placeholder="Masukkan Keterangan" required value="<?= $b->nama_pengeluaran; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya_pengeluaran" class="form-label">Biaya</label>
                                        <input type="text"  name="biaya_pengeluaran" class="form-control" id="" placeholder="Masukkan Biaya" required value="<?= $b->biaya_pengeluaran; ?>">
                                        <!-- <input type="text"  name="biaya_pengeluaran" class="form-control" id="dengan-rupiah" placeholder="Masukkan Biaya" required value="<?= $b->biaya_pengeluaran; ?>"> -->
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/tabel_pengeluaran'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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
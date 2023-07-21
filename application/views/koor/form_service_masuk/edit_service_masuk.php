<?php $this->load->view('template/head'); ?>
<?php $this->load->view('koor/template/nav'); ?>
<?php $this->load->view('koor/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">EDIT PERBAIKAN MASUK</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('koor'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('koor/tabel_surat_tangki'); ?>">Data Seri Ban</a></li>
                        <li class="breadcrumb-item active">Edit Perbaikan Masuk</li>
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
                            Ubah Data Perbaikan Yang masuk 
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

                            <form action="<?= base_url('koor/proses_edit_service_masuk'); ?>" method="post" role="form" enctype="multipart/form-data">
                                <?php foreach ($list_service_masuk as $sm) { ?>
                                    <input type="hidden" name="id_service_masuk" value="<?= $sm->id_service_masuk; ?>">
                                

                                
                                <div class="form-group">
                                    <label for="supir_tangki" class="form-label">Nopol</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_supir_tangki" class="form-control" id="id_supir_tangki">
                                        <option value="" selected>-- Nopol --</option>

                                        <?php foreach ($list_supir_tangki as $t) { ?>
                                                <?php if ($sm->id_supir_tangki == $t->id_supir_tangki) { ?>
                                                    <option value="<?= $sm->id_supir_tangki; ?>" selected><?= $t->nopol; ?> - <?= $t->nama_supir; ?> </option>
                                                <?php } else { ?>
                                                    <option value="<?= $t->id_supir_tangki; ?>"><?= $t->nopol; ?> - <?= $t->nama_supir; ?></option>
                                    


                                        <?php } ?>
                                        <?php } ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="nama_bengkel" class="form-label">Bengkel</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="id_bengkel" class="form-control" id="id_bengkel">
                                        <option value="" selected>-- Pilih Bengkel --</option>

                                        <?php foreach ($list_bengkel as $s) { ?>
                                            <?php if ($sm->id_bengkel == $s->id_bengkel) { ?>
                                            <option value="<?= $sm->id_bengkel; ?>" selected> <?= $s->nama_bengkel; ?></option>
                                        <?php }else { ?>
                                            <option value="<?= $s -> id_bengkel; ?>"><?= $s->nama_bengkel; ?></option>
                                            
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                      
                                </div>

                                <div class="form-group">
                                    <label for="date" class="form-label">Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" class="form-control" id="tgl_masuk" placeholder="Masukkan Tanggal Masuk Perbaikan" required value="<?= $sm->tgl_masuk; ?>">
                                </div>                    

                                <!-- <div class="form-group">
                                    <label for="alamat" class="form-label">Foto Surat</label>
                                    <input type="file" name="foto_surat" class="form-control" id="foto_surat" placeholder="Masukkan Foto Surat">
                                    <span><small style="color:red"><strong>UPLOAD MINIMAL SIZE 2MB</strong></small></span>
                                </div> -->

                                    <div class="form-group">
                                    <label for="text" class="form-label">keluhan</label>
                                    <input type="text" name="keluhan" class="form-control" id="keluhan" placeholder="Masukkan Keluhan perbaikan" required value="<?= $sm->keluhan; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label for="text" class="form-label">Biaya</label>
                                    <input type="text" name="biaya" class="form-control" id="#" placeholder="Masukkan Perkiraan biaya" required value="<?= $sm->biaya; ?>">
                                    </div>

                                    <div class="form-group">
                                    <label for="status" class="form-label">Status</label>
                                    <!-- <input type="text" name="nopol" class="form-control" id="nopol" placeholder="Masukkan Nopol" required> -->
                                    <select name="status" class="form-control" id="status">
                                        
                                    <?php if ($sm->level == 0) { ?>
                                                <option value="0" selected="">PROSES</option>
                                                <option value="1">SELESAI</option>
                                                
                                    <?php } elseif ($sm->level == 1) { ?>
                                                <option value="1" selected="">SELESAI</option>
                                                <option value="0">PROSES</option>
                                            
                                                <?php } ?>
                                    </select> 
                                     </div>  

                                </div>   


                                
                                
                               
                                    


                                   
                            
                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('koor/tabel_service_masuk'); ?>" type="button" class="btn btn-sm btn-danger" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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
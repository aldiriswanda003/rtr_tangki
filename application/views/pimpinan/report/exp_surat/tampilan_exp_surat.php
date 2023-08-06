<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">REPORT DATA PENGAJUAN PERPANJANGAN MASA BERLAKU SURAT KENDARAAN TRUK TANGKI</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Exp Surat Tangki</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div id="loading">
            <img src="<?= base_url(); ?>assets/style/loading.gif" alt="loading" width="50%">
        </div>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Surat - Surat Tangki Yang akan diajukan
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <a href="<?= base_url('pimpinan/tambah_exp_surat'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah</a> -->
                            <a href="<?= base_url('report_pimpinan/cetak_exp_surat'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-success" name="tambah_data"><i class="fa fa-print mr-2" aria-hidden="true"></i>Cetak</a>


                            <table id="example1" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <?php foreach ($total_data as $td) : ?>
                                            <th colspan="6" style="text-align: center;">Total Biaya : <span style="color: red;">Rp&nbsp;<?= number_format($td->perkiraan_biaya); ?></span></th>
                                        <?php endforeach; ?>
                                    </tr>

                                    <tr align="center">
                                        <th style="width :10px">No.</th>
                                        <th>Nopol</th>
                                        <th>Jenis</th>
                                        <th>Tanggal Exp</th>
                                        <th>Status</th>
                                        <th>Perkiraan Biaya</th>
                                        <!-- <th style="width:58px">Aksi</th> -->

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($exp_surat)) { ?>
                                        <?php foreach ($exp_surat as $st) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $st->nopol ?></td>
                                                <td><?= $st->jenis_surat ?></td>
                                                <!-- <td><img src="<?= base_url('assets/upload/surat_tangki/' . $st->foto_surat); ?>" class="img img-box" width="100" height="100" alt="<?= $st->foto_surat; ?>"></td> -->
                                                <td><?= $st->tanggal_expired ?></td>

                                                <?php if ($st->status == 0) { ?>
                                                    <td>BELUM MATI</td>
                                                <?php } elseif ($st->status == 1) { ?>
                                                    <td>SUDAH MATI</td>
                                                <?php } ?>
                                                <td>Rp <?= number_format($st->perkiraan_biaya) ?></td>


                                                <!-- <td><a href="<?= base_url('pimpinan/edit_exp_surat/' . $st->id_exp_surat); ?>" type="button" class="btn btn-sm btn-success" name="btn_edit"><i class="fa fa-edit" title="EDIT"></i></a>
                                                <a href="<?= base_url('pimpinan/hapus_exp_surat/' . $st->id_exp_surat); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash" title="HAPUS"></i></a></td> -->
                                                <!-- ulah function tombol hapus nya di pimpinan controller -->
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <thead>
                                        <!-- <th></th>
                                        <th style="width: 200px;"><input type="text" name="filter_nama" class="form-control" id="filter_nama" placeholder="Filter Nama Supir"></th>
                                        <th style="width: 200px;"><input type="text" name="filter_no_telp" class="form-control" id="filter_no_telp" placeholder="Filter No. Telp Supir"></th>
                                        <th colspan="5"></th> -->
                                    </thead>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<?php $this->load->view('template/footer'); ?>

<?php $this->load->view('pimpinan/template/script') ?>
<script>
    //* Script untuk menampilkan loading
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loading").style.visibility = "visible";
        } else {
            document.querySelector(
                "#loading").style.display = "none";
            document.querySelector(
                "body").style.visibility = "visible";
        }
    };
</script>
<script type="text/javascript">
    $(function() {
        $('#example1').DataTable({
            // 'paging': true,
            // 'lengthChange': false,
            // 'searching': faslse,
            // 'ordering': false,
            // 'info': true,
            'autoWidth': false
        })
    }); //* Script untuk memuat datatable
</script>
<script type="text/javascript">
    $('.btn-delete').on('click', function() {
        var getLink = $(this).attr('href');
        Swal.fire({
            title: 'Hapus Data',
            text: 'Yakin ingin menghapus data?',
            type: 'warning',
            confirmButtonColor: '#d9534f',
            showCancelButton: true,
        }).then(result => {
            //jika klik ya maka arahkan ke proses.php
            if (result.isConfirmed) {
                window.location.href = getLink
            }
        })
        return false;
    }); //* Script untuk memuat sweetalert hapus data
</script>
</body>

</html>
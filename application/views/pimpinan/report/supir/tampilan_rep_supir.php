<?php $this->load->view('template/head'); ?>
<?php $this->load->view('pimpinan/template/nav'); ?>
<?php $this->load->view('pimpinan/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">REPORT DATA SUPIR</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Supir</li>
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
                            Data Supir
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <a href="<?= base_url('pimpinan/tambah_supir'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah</a> -->
                            <a href="<?= base_url('report_pimpinan/cetak_rep_supir'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-success" name="tambah_data"><i class="fa fa-print mr-2" aria-hidden="true"></i>Cetak</a>

                            <table id="example1" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nama</th>
                                        <th>No. Telp</th>
                                        <th>Email</th>
                                        <th>Foto Supir</th>
                                        <th>Foto SIM</th>
                                        <th>Foto KTP</th>
                                        <th style="width:58px">Aksi</th>
                                        <!-- <th style="width:58px">Hapus</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($supir)) { ?>
                                        <?php foreach ($supir as $sp) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $sp->nama_supir ?></td>
                                                <td><?= $sp->no_telp ?></td>
                                                <td><?= $sp->email_supir ?></td>
                                                <td><img src="<?= base_url('assets/upload/supir/foto_supir/' . $sp->foto_supir); ?>" class="img img-box" width="100" height="100" alt="<?= $sp->nama_supir; ?>"></td>
                                                <td><img src="<?= base_url('assets/upload/supir/foto_sim/' . $sp->foto_sim); ?>" class="img img-box" width="100" height="100" alt="<?= $sp->nama_supir; ?>"></td>
                                                <td><img src="<?= base_url('assets/upload/supir/foto_ktp/' . $sp->foto_ktp); ?>" class="img img-box" width="100" height="100" alt="<?= $sp->nama_supir; ?>"></td>
                                                <td><a href="<?= base_url('report_pimpinan/info_rep_supir/' . $sp->id_supir); ?>" type="button" class="btn btn-xs btn-warning " name=""><i class="fa fa-circle-info"></i>&nbsp;DETAIL</a></td>


                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <thead>
                                        <th></th>
                                        <!-- <th style="width: 200px;"><input type="text" name="filter_nama" class="form-control" id="filter_nama" placeholder="Filter Nama Supir"></th> -->
                                        <!-- <th style="width: 200px;"><input type="text" name="filter_no_telp" class="form-control" id="filter_no_telp" placeholder="Filter No. Telp Supir"></th> -->
                                        <th colspan="5"></th>
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
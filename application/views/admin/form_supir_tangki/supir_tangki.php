<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">SUPIR TANGKI</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Supir Tangki</li>
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
                            Data Supir dan Truk Tangki yang dipegang
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <a href="<?= base_url('admin/tambah_supir_tangki'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_supir_tangki"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah</a>

                            <table id="example1" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Supir</th>
                                        <th>Truk Tangki</th>
                                        <th>Tanggal Update</th>
                                <th style="width:58px">Edit</th>
                                        <th style="width:58px">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($supir_tangki)) { ?>
                                        <?php foreach ($supir_tangki as $st) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $st->nama_supir ?></td>
                                                <td><?= $st->nopol ?></td>
                                                <td><?= $st->tanggal_update ?></td>
                                               

                                                <!-- <td><img src="<?= base_url('assets/upload/surat_tangki/' . $st->foto_surat); ?>" class="img img-box" width="100" height="100" alt="<?= $st->foto_surat; ?>"></td> -->
                                                


                                                <td><a href="<?= base_url('admin/edit_supir_tangki/' . $st->id_supir_tangki); ?>" type="button" class="btn btn-sm btn-success" name="btn_edit"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>
                                                <td><a href="<?= base_url('admin/hapus_supir_tangki/' . $st->id_supir_tangki); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i>&nbsp;Hapus</a></td>
                                                <!-- ulah function tombol hapus nya di admin controller -->
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <thead>
                                        <th></th>
                                        <th style="width: 200px;"><input type="text" name="filter_nama" class="form-control" id="filter_nama" placeholder="Filter Nama Supir"></th>
                                        <th style="width: 200px;"><input type="text" name="filter_no_telp" class="form-control" id="filter_no_telp" placeholder="Filter No. Telp Supir"></th>
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

<?php $this->load->view('admin/template/script') ?>
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
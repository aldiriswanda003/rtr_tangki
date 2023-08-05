<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">REPORT SURAT-SURAT KENDARAAN TRUK TANGKI</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Surat Tangki</li>
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
                            Surat - Surat Tangki
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <tr>
                            <!-- <a href="<?= base_url('report/cetak_rep_surat_tangki'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-success" name="cetak_data"><i class="fa fa-print mr-2" aria-hidden="true"></i>Cetak</a> -->

                            
                                    <!-- <th style="vertical-align: middle;">Filter per Nopol<br><small style="color: red;">*Berdasarkan Periode</small></th> -->
                                    <td style="vertical-align: middle;">
                                        <!-- <button data-toggle="modal" data-target="#staticRepPendapatanBulanan" class="btn btn-info btn-sm"><i class="fa fa-table"></i>&nbsp;Pilih Periode</button> -->
                                        <button data-toggle="modal" data-target="#staticRepPerNopol" class="btn btn-info btn-sm"><i class="fa fa-table"></i>&nbsp;Nopol</button>
                                    </td>
                                </tr>

                            <table id="example1" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nopol</th>
                                        <th>Jenis</th>
                                        <th>Foto Surat</th>
                                        <th>Tanggal Exp</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($surat_tangki)) { ?>
                                        <?php foreach ($surat_tangki as $st) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $st->nopol ?></td>
                                                <td><?= $st->jenis_surat ?></td>
                                                <td><img src="<?= base_url('assets/upload/surat_tangki/' . $st->foto_surat); ?>" class="img img-box" width="100" height="100" alt="<?= $st->foto_surat; ?>"></td>
                                                <td><?= $st->tanggal_expired ?></td>
                                               
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


                            <!-- TOMBOL MODAL -->
                            <div class="modal fade" id="staticRepPerNopol" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">SURAT TANGKI PER NOPOL</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('report/cetak_nopol_surat_tangki'); ?>" method="post" role="form" target="_blank">
                                        <div class="form-group row">
                                            <label for="nopol" class="col-sm-3 col-form-label">Nopol</label>
                                            <div class="col-sm-6">
                                            <select name="nopol" class="form-control" id="id_tangki">
                                        <option value="" selected>-- Pilih Nopol --</option>
                                        <?php foreach ($list_tangki as $s) { ?>
                                            <option value="<?= $s->nopol; ?>"><?= $s->nopol; ?></option>
                                        <?php } ?>
                                    </select>
                                            </div>
                                        </div>
                             
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-print mr-2"></i> Cetak</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

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
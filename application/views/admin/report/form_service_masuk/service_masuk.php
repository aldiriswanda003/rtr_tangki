<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">REPORT PERBAIKAN MASUK</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">REPORT Perbaikan Masuk</li>
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
                        Data Perbaikan atau service yang masuk. <br>
                        *KLIK <a type="button" class="btn btn-sm btn-warning" >DETAIL</a> pada Aksi untuk mencetak MEMO PENGAJUAN
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                            <!-- <a href="<?= base_url('admin/tambah_service_masuk'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah</a> -->

                            <table id="example1" class="table table-bordered table-striped table-hover" >
                                <thead>
                                    <tr align="center">
                                        <th style="width :10px;">No.</th>
                                        
                                        <th style="width: 50px;" >NOPOL</th>
                                        <th>Nama Bengkel</th>
                                        <th style="width: 60px;" >Tanggal Masuk</th>
                                        <th style="width: 200px;">Keluhan</th>
                                        <th>Perkiraan Biaya</th>
                                        <th>Status</th>


                                        <th >Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($service_masuk)) { ?>
                                        <?php foreach ($service_masuk as $sm) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                
                                                <td><?= $sm->nopol ?></td>
                                                <td><?= $sm->nama_bengkel ?></td>
                                                <td><?= $sm->tgl_masuk ?></td>
                                                <td><?= $sm->keluhan ?></td>
                                                <td>Rp<?= number_format($sm->biaya) ?></td>
                                            
                                                <?php if ($sm->status == 0) { ?>
                                                    <td>PROSES</td>
                                                <?php } elseif ($sm->status == 1) { ?>
                                                    <td>SUDAH SELESAI</td>
                                                <?php } ?>
                                                    


                                                
                                                <!-- <td><img src="<?= base_url('assets/upload/surat_tangki/' . $st->foto_surat); ?>" class="img img-box" width="100" height="100" alt="<?= $st->foto_surat; ?>"></td> -->
                                                

                                                <!-- <td><a href="<?= base_url('admin/edit_service_masuk/' . $sm->id_service_masuk); ?>" type="button" class="btn btn-xs btn-success" name="btn_edit"><i class="fa fa-edit"></i>&nbsp;Edit</a></td> -->
                                                <!-- <td><a href="<?= base_url('admin/hapus_service_masuk/' . $sm->id_service_masuk); ?>" type="button" class="btn btn-xs btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i>&nbsp;Hapus</a></td> -->
                                                <td><a href="<?= base_url('admin/info_service_unit/' . $sm->id_service_masuk); ?>" type="button" class="btn btn-sm btn-warning " name=""><i class="fa fa-circle-info"></i>&nbsp;DETAIL</a></td>
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
                                        <th colspan="6"></th>
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
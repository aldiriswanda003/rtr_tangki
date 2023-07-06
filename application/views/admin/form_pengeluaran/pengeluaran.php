<?php $this->load->view('template/head'); ?>
<?php $this->load->view('admin/template/nav'); ?>
<?php $this->load->view('admin/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">PENGELUARAN LAIN-LAIN</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pengeluaran lain-lain</li>
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
                            Data Pengeluaran
                        </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses') ; ?>
                                </div>
                            <?php } ?>
                            <a href="<?= base_url('admin/tambah_pengeluaran'); ?>" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-primary" name="tambah_data"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Tambah</a>
                            <button data-toggle="modal" data-target="#staticKeluarBulanan" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-success" name="KeluarBulanan"><i class="fa fa-table"></i>&nbsp;Pilih Periode</button>

                            <table id="example1" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        
                                        <?php foreach ($total_data as $td) : ?>
                                            <th colspan="6" style="text-align: center;">Total Pengeluaran <?php echo $label ?> : <span style="color: red;">Rp&nbsp;<?= number_format($td->biaya_pengeluaran); ?></span></th>
                                        <?php endforeach; ?>

                                        
                                    </tr>
                                    <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan Pengeluaran</th>
                                        <th>Biaya Pengeluaran</th>
                                        <th style="width:58px">Edit</th>
                                        <th style="width:58px">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($pengeluaran)) { ?>
                                        <?php foreach ($pengeluaran as $p) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $p->tanggal?></td>
                                                <td><?= $p->nama_pengeluaran ?></td>
                                                <td>Rp <?= number_format($p->biaya_pengeluaran) ?></td>
                                                <td><a href="<?= base_url('admin/edit_pengeluaran/' . $p->id_pengeluaran); ?>" type="button" class="btn btn-sm btn-success" name="btn_edit"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>
                                                <td><a href="<?= base_url('admin/hapus_data_pengeluaran/' . $p->id_pengeluaran); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i>&nbsp;Hapus</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <!-- <thead>
                                        <th></th>
                                        <th style="width: 200px;"><input type="text" name="filter_nama_bengkel" class="form-control" id="filter_nama_bengkel" placeholder="Filter Tanggal"></th>
                                        <th style="width: 200px;"><input type="text" name="filter_alamat" class="form-control" id="filter_alamat" placeholder="Filter Pengeluaran"></th>
                                        <th style="width: 200px;"><input type="text" name="filter_no_telp" class="form-control" id="filter_no_telp" placeholder="Filter Biaya"></th>
                                        <th colspan="2"></th>
                                    </thead> -->
                                </tr>
                            </table>
                        </div>
                    </div>

                            <!-- Modal -->
                            <div class="modal fade" id="staticKeluarBulanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Tampilkan Bulanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?= site_url('admin/tabel_pengeluaran'); ?>" method="get" role="form">

                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-3 col-form-label">Bulan</label>
                                            <div class="col-sm-6">
                                                <select name="bulan" id="bulan" class="form-control">
                                                    <option value="" selected="">--Pilih Bulan--</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                                            <div class="col-sm-6">
                                                <input type="text" name="tahun" class="form-control" id="tahun" value="<?= date('Y'); ?>">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm">Tampilkan</button>
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                </div>
                                </form>
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
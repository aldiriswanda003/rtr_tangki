<?php $this->load->view('template/head'); ?>
<?php $this->load->view('koor/template/nav'); ?>
<?php $this->load->view('koor/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">DAFTAR ANGKUTAN </h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('koor/index/'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">tujuan</li>
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
                            angkutan </div>
                        <div class="card-body">
                            <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Berhasil!</strong><br> <?= $this->session->flashdata('msg_sukses'); ?>
                                </div>
                            <?php } ?>
                         
                            <button data-toggle="modal" data-target="#static_angkutan_bulanan" style="margin-bottom:10px;" type="button" class="btn btn-sm btn-warning" name="static_angkutan_bulanan"><i class="fa fa-filter   "></i>&nbsp; FILTER NOPOL & TANGGAL</button>


                            <table id="example1" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead>

                                    <tr>
                                        <?php foreach ($total_data as $td) : ?>
                                            <th colspan="8" style="text-align: center;"><?php echo $label ?>
                                                <br>
                                                Total Kilometer yang ditempuh :<span style="color: red;">&nbsp;<?= $td->kilometer_pp; ?> KM </span>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>





                                    <tr align="center">
                                        <th style="width :10px">No.</th>
                                        <th>Nopol</th>
                                        <th>Volume</th>
                                        <th>Supir</th>
                                        <th>Tgl Berangkat</th>
                                        <th>Tujuan</th>
                                        <th style="width :20px">Jarak PP</th>


                                     

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    <?php foreach ($angkutan as $st) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $st->nopol ?></td>
                                            <td><?= $st->volume_tangki ?></td>
                                            <td><?= $st->nama_supir ?></td>
                                            <td><?= $st->tgl_berangkat ?></td>
                                            <td><?= $st->nama_tujuan ?></td>
                                            <td><?= $st->kilometer_pp ?> KM</td>



                                          
                                        </tr>
                                    <?php endforeach; ?>

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

                    <!-- Modal -->
                    <div class="modal fade" id="static_angkutan_bulanan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">FILTER PERTANGGAL</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="<?= site_url('koor/tabel_angkutan'); ?>" method="get" role="form">

                                        <div class="form-group row">
                                            <label for="bulan" class="col-sm-3 col-form-label">NOPOL</label>
                                            <div class="col-sm-6">


                                                <select name="nopol" class="form-control" id="nopol">
                                                    <option value="" selected>NOPOL</option>
                                                    <?php foreach ($tangki as $s) : ?>
                                                        <option value="<?= $s->nopol; ?>"><?= $s->nopol; ?> - <?= $s->volume_tangki; ?> Liter
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_awal" class="col-sm-3 col-form-label">dari Tanggal</label>
                                            <div class="col-sm-6">
                                                <input type="date" name="tgl_awal" class="form-control" id="tgl_berangkat" required value="<?= date('Y-m-d'); ?>">
                                            </div>
                                        </div>

                                        <div class="fomm-group row">
                                            <label for="bulan2" class="col-sm-3 col-form-label">ke Tanggal</label>
                                            <div class="col-sm-6">
                                                <input type="date" name="tgl_akhir" class="form-control" id="tgl_berangkat" value="<?= date('Y-m-d'); ?>">
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

<?php $this->load->view('koor/template/script') ?>
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
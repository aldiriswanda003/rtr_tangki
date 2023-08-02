<?php $this->load->view('template/head'); ?>
<?php $this->load->view('koor/template/nav'); ?>
<?php $this->load->view('koor/template/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('koor'); ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('koor/users'); ?>">Data User</a></li>
                        <li class="breadcrumb-item active">Edit Data User</li>
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
                            Edit Data User
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('koor/proses_edituser'); ?>" method="post" level="form">
                                <?php if ($this->session->flashdata('msg_sukses')) { ?>
                                    <div class="alert alert-success alert-dismissible">
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
                                <?php foreach ($list_data as $d) { ?>
                                    <input type="hidden" name="id" value="<?= $d->id; ?>">
                                    <div class="form-group">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" required="" value="<?= $d->nama; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required="" value="<?= $d->username; ?>">
                                    </div>
                                    <div class="form-group ">
                                        <label for="level" class="form-label">Level</label>
                                        <select name="level" id="" style="width: 50%;" class="form-control">
                                            <?php if ($d->level == 0) { ?>
                                                <option value="0" selected="">User koor</option>
                                                <option value="1">User Pimpinan</option>
                                                <option value="2">User Koordinator Perbaikan</option>
                                                <option value="3">User PERCOBAAN</option>
                                            <?php } elseif ($d->level == 1) { ?>
                                                <option value="1" selected="">User Pimpinan</option>
                                                <option value="0">User Admin</option>
                                                <option value="2">User Koordinator Perbaikan</option>
                                                <option value="3">User PERCOBAAN</option>
                                            <?php } elseif ($d->level == 2){ ?>
                                                <option value="2" selected>User Koordinator Perbaikan</option>
                                                <option value="3">User PERCOBAAN</option>
                                                <option value="0">User Admin</option>
                                                <option value="1">User Pimpinan</option>
                                            <?php } else{ ?>
                                                <option value="3" selected >User PERCOBAAN</option>
                                                <option value="0">User Admin</option>
                                                <option value="1">User Pimpinan</option>
                                                <option value="2">User Koordinator Perbaikan</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <hr>
                                <div class="form-group" align="center">
                                    <a href="<?= base_url('admin/users'); ?>" type="button" class="btn btn-sm btn-danger" onclick="" name="btn_kembali"><i class="fa fa-arrow-left mr-2"></i>Batal</a>
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

</body>

</html>
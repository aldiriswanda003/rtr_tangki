<?php $this->load->view('template/head_report') ?>

<body class="A4">
    <section class="sheet padding-10mm">
        <table>
            <tr>
                <img src="<?= base_url(); ?>assets/style/KOP RTR REPORT APK.png" width="100%" alt="">
            </tr>
        </table>
        <h4 style="margin-bottom: 5px;">DATA DETAIL TANGKI RTR</h4>


        <?php foreach ($tangki as $d) : ?>
            <table class="table" style="width:100%">
                <tr>
                    <th style="vertical-align: middle">NOPOL</th>
                    <td style="vertical-align: middle;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    :&nbsp;<?= $d->nopol; ?>

                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th style="vertical-align: middle">Tahun Dibuat</th>
                    <td style="vertical-align: middle;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    :&nbsp;<?= $d->tahun_dibuat; ?> </div>

                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th style="vertical-align: middle">Volume Tangki</th>
                    <td style="vertical-align: middle;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    :&nbsp;<?= number_format( $d->volume_tangki) ?> Liter</div>

                            </div>
                        </div>
                    </td>
                </tr>
        </table>


        <table class="table">
                <tr>
                    <th style="vertical-align: middle">Foto Depan</th>
                    
                    <th style="vertical-align: middle">Foto Belakang</th>
                <tr>
                    <td align="center" style="vertical-align: middle;" >
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <img src="<?= base_url('assets/upload/foto_tangki/' . $d->foto_depan); ?>" class="img img-box" width="200px" alt="<?= $d->foto_depan; ?>">

                                </div>

                            </div>
                        </div>
                    </td>
                    <td align="center" style="vertical-align: middle;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <img src="<?= base_url('assets/upload/foto_tangki/' . $d->foto_belakang); ?>" class="img img-box" width="200px" alt="<?= $d->foto_belakang; ?>"> </div>

                            </div>
                        </div>
                    </td>

                    </tr>
                </tr>

                <tr>
                    <th style="vertical-align: middle">Foto Kanan</th>
                    <th style="vertical-align: middle">Foto Kiri</th>
                </tr>
                <tr>
                    <td align="center" style="vertical-align: middle;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <img src="<?= base_url('assets/upload/foto_tangki/' . $d->foto_kanan); ?>" class="img img-box" width="270px" alt="<?= $d->foto_kanan; ?>"> </div>

                            </div>
                        </div>
                    </td>

                           
                    <td align="center" style="vertical-align: middle;">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    :&nbsp;<img src="<?= base_url('assets/upload/foto_tangki/' . $d->foto_kiri); ?>" class="img img-box" width="270px" alt="<?= $d->foto_kiri; ?>"> </div>

                            </div>
                        </div>
                    </td>

                </tr>

                <tr>
             
                </tr>


            <?php endforeach; ?>
            </table>



            <table>
                <tr>

                    <br>
                    <br>
                    <td>Banjarmasin, <?php echo date('d - M - Y'); ?></td>
                </tr>

                <tr>

                    <td><?= $this->session->userdata('name') ?></td>
                    <!-- <td >Bengkel</td> -->
                    <!-- <td>Supir</td> -->
                </tr>
                <tr>
                    <td>
                        <br>
                        <br>
                        <p>..................................</p>
                    </td>
                    <td>
                        <br><br>
                        <!-- <p>..................................</p> -->
                    </td>

                    <td>
                        <br><br>
                        <!-- <p>..................................</p> -->
                    </td>
                </tr>
            </table>
    </section>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>
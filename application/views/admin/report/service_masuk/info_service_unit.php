

<?php $this->load->view('template/head_report') ?>

<body class="A4">
    <section class="sheet padding-10mm">
    <table>
        <tr>
            <img src="<?= base_url(); ?>assets/style/KOP RTR REPORT APK.png" width="100%" alt="">
        </tr>
    </table>
    
    
    
    <table>
        
        
    </table>
    
    

        <h4 style="margin-bottom: 5px;">Laporan Surat-Surat Truk Tangki</h4>
        <?php foreach ($list_service_masuk as $d) : ?>
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
                                        <th style="vertical-align: middle">Nama Bengkel</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->nama_bengkel; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Tanggal Masuk</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->tgl_masuk; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Keterangan</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->keluhan; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

<tr>
                                        <th style="vertical-align: middle">Biaya</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp; Rp <?= number_format( $d->biaya); ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <th style="vertical-align: middle">Status</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;
                                                        <?php if ($d->status == 0) { ?>
                                                    PROSES
                                                <?php } elseif ($d->status == 1) { ?>
                                                    SUDAH SELESAI
                                                <?php } ?>
                                                    
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
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
                
                <td ><?= $this->session->userdata('name') ?></td>
                <td >Bengkel</td>
                <td>Supir</td>
            </tr>
            <tr>
                <td >
                <br>
                <br>
                <p  >..................................</p>
                </td>
                <td>
                    <br><br>
                <p>..................................</p>
                </td>

                <td>
                    <br><br>
                <p>..................................</p>
                </td>
            </tr>
        </table>
    </section>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>
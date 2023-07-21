

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
    
    

        <h4 style="margin-bottom: 5px;">SUPIR RTR</h4>
        
        
        <?php foreach ($supir as $d) : ?>
        <table class="table" style="width:100%">
                                    <tr>
                                        <th style="vertical-align: middle">Nama Supir</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->nama_supir; ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Nomor Telepon</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<?= $d->no_telp; ?> </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">Foto supir</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        :&nbsp;<img src="<?= base_url('assets/upload/supir/foto_supir/' . $d->foto_supir); ?>" class="img img-box" width="20%"  alt="<?= $d->nama_supir; ?>">
                                                         
                                                    </div>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="vertical-align: middle">KTP</th>
                                        <td style="vertical-align: middle;">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                    :&nbsp;<img src="<?= base_url('assets/upload/supir/foto_ktp/' . $d->foto_ktp); ?>" class="img img-box" width="40%"  alt="<?= $d->nama_supir; ?>"> </div>

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
                <!-- <td >Bengkel</td> -->
                <!-- <td>Supir</td> -->
            </tr>
            <tr>
                <td >
                <br>
                <br>
                <p  >..................................</p>
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
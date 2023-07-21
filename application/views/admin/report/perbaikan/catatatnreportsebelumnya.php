

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
    
    

        <h4 style="margin-bottom: 5px;">Perbaikan Truk Tangki</h4>
        
        

            <table id="example1" class="table table-bordered table-striped table-hover" >
                                <thead>
                                <tr>
                                        <?php foreach ($total_data as $td) : ?>
                                            <th colspan="8" style="text-align: center;">Total Perbaikan <?php echo $label ?> : <span style="color: red;">Rp&nbsp;<?= number_format($td->biaya_perbaikan); ?></span></th>
                                        <?php endforeach; ?>
                                        </tr>

                                    <tr align="center">
                                        <th style="width :10px;">No.</th>
                                        
                                        <th style="width :15%;" >NOPOL</th>
                                        <th style="width :12%;">Nama Bengkel</th>
                                        <th style="width :13%;" >Tanggal</th>
                                        <th style="width :45%;">Keterangan</th>
                                        <th >Biaya</th>
                                        


                                        
                                        <!-- <th style="width:58px">Hapus</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($perbaikan)) { ?>
                                        <?php foreach ($perbaikan as $sm) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                
                                                <td><?= $sm->nopol ?></td>
                                                <td><?= $sm->nama_bengkel ?></td>
                                                <td><?= $sm->tgl_perbaikan ?></td>
                                                <td><?= $sm->keterangan ?></td>
                                                <td>Rp <?= number_format($sm->biaya_perbaikan) ?></td>
                                            
                                              
                                                    


                                                
                                                <!-- <td><img src="<?= base_url('assets/upload/surat_tangki/' . $st->foto_surat); ?>" class="img img-box" width="100" height="100" alt="<?= $st->foto_surat; ?>"></td> -->
                                                

                                                <!-- ulah function tombol hapus nya di admin controller -->
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                                <tr>
                                    <thead>
                                        
                                    </thead>
                                </tr>
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
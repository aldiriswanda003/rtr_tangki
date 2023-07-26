

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
    
    

        <h4 style="margin-bottom: 5px;">SUPIR TANGKI RTR</h4>
        
        

            <table id="example1" class="table table-bordered table-striped table-hover" >
                                <thead >
                                

                                    <tr style="background-color:lightsteelblue;">
                                        <th style="width:1%">No.</th>
                                        
                                        <th  style="width :15%;" >Nama Supir</th>
                                        <th style="width :12%;">Truk Tangki</th>
                                        <th style="width :12%;">Volume Tangki</th>
                                        <th style="width :13%;" >Tanggal Update</th>
                                        
                                        
                                        


                                        
                                        <!-- <th style="width:58px">Hapus</th> -->
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
                                                <td><?= number_format($st->volume_tangki)  ?> Liter</td>
                                                <td><?= $st->tanggal_update ?></td>
                                               

                                                <!-- <td><img src="<?= base_url('assets/upload/surat_tangki/' . $st->foto_surat); ?>" class="img img-box" width="100" height="100" alt="<?= $st->foto_surat; ?>"></td> -->
                                                


                                                <!-- <td><a href="<?= base_url('admin/edit_supir_tangki/' . $st->id_supir_tangki); ?>" type="button" class="btn btn-sm btn-success" name="btn_edit"><i class="fa fa-edit"></i>&nbsp;Edit</a></td> -->
                                                <!-- <td><a href="<?= base_url('admin/hapus_supir_tangki/' . $st->id_supir_tangki); ?>" type="button" class="btn btn-sm btn-danger btn-delete" name="btn_delete"><i class="fa fa-trash"></i>&nbsp;Hapus</a></td> -->
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
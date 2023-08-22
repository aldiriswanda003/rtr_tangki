

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
    
    

        <h4 style="margin-bottom: 5px;">REPORT DATA 1</h4>
        
        

            <table id="example1" class="table table-bordered table-striped table-hover" >
                                <thead >
                                

                                    <tr style="background-color:lightsteelblue;">
                                        
                                        
                                        <th style="width :4px">No.</th>
                                        <th style="width :10px">Nomor Buku</th>
                                        <th>Judul</th>
                                        <th style="width :10px" >Penerbit</th>
                                        <th style="width :10px">Tahun</th>
                                        
                                        


                                        
                                        <!-- <th style="width:58px">Hapus</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $no = 1;
                                    if (is_array($data1)) { ?>
                                        <?php foreach ($data1 as $sp) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $sp->nomor_buku ?></td>
                                                <td><?= $sp->judul ?></td>
                                                <td><?= $sp->penerbit ?></td>
                                                <td><?= $sp->tahun ?></td>
                                              
                                                
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
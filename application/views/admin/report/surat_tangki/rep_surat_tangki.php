<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/style/paper.css">

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        .table th {
            padding: 8px 8px;
            border: 1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 3px 3px;
            border: 1px solid #000000;
        }


        @page {
            size: A4
        }

        h4 {
            font-weight: bold;
            font-size: 13pt;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .horizontal_center {
            border-top: 3px solid black;
            height: 2px;
            line-height: 30px;
        }

        .kanan {
            float: right;
        }
    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
    
    
    
    
    <table>
        <tr>
            <th>
            <img src="<?= base_url() ?>assets/style/logo/LOGO RTR  border putih .png" alt="" width="50px">
            </th>
            <th >
            <p align="center" style="font-family:Arial; font-size:15pt"  > PT. RAHMAT TAUFIK RAMADAN </p>
            </th>
            <th>
            <?= $this->session->userdata('name') ?>
            ,
            <?php echo date('d - M - Y'); ?>
            </th>
        </tr>
        <tr>
            <td colspan="3"> <p align="center" style="font-size:8pt">Jl.Pramuka Gg. Srikaya, Komp. Rahmat Residence NO 29 RT.30 RW.02  Kel. Pemurus Luar, Kec.Banjarmasin Timur Kota Banjarmasin, Kalimantan Selatan | Email : pt.rahmattaufikramadan@gmail.com | No.Telp : (0511) 679 5475</p></td>
        </tr>
    </table>
    <hr>
    

        <h4 style="margin-bottom: 5px;">Laporan Surat-Surat Truk Tangki</h4>
        
        <table class="table" width="100%">
        <thead>
        <tr>
                                        <th style="width :10px">No.</th>
                                        <th>Nopol</th>
                                        <th>Jenis</th>
                                        <th>Foto Surat</th>
                                        <th>Tanggal Exp</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    if (is_array($surat_tangki)) { ?>
                                        <?php foreach ($surat_tangki as $st) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $st->nopol ?></td>
                                                <td><?= $st->jenis_surat ?></td>
                                                <td><img src="<?= base_url('assets/upload/surat_tangki/' . $st->foto_surat); ?>" class="img img-box" width="100" height="100" alt="<?= $st->foto_surat; ?>"></td>
                                                <td><?= $st->tanggal_expired ?></td>
                                               
                                                
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php } ?>
                                </tbody>
                                
            
            
        </table>
        <table  align="center">
        <tr>
            <tr>
                <td></td>
                <td></td>
                <td>Banjarmasin, <?php echo date('d - M - Y'); ?></td>
            </tr>
        </tr>    
        <tr>
                <td></td>
                <td height="80%" width="65%"></td>
                
                <td ><?= $this->session->userdata('name') ?></td>
            </tr>
        </table>
    </section>

</body>

</html>
<script type="text/javascript">
    window.print();
</script>
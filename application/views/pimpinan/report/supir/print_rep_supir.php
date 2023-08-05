<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document informasi
$pdf->SetCreator('SIMRENT Genset Web');
$pdf->SetTitle('Laporan Supir');
$pdf->SetSubject('Pimpinan');

$PDF_HEADER_STRING = "";

$pdf->SetHeaderData('KOP RTR REPORT APK V2.jpg', 180, '', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, 'I', 9));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margin
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER, 5);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
$pdf->SetDisplayMode('fullpage', 'Fit');

//SET Scaling ImagickPixel
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//FONT Subsetting
$pdf->setFontSubsetting(true);

$pdf->SetFont('helvetica', '', 10, '', true);

$pdf->AddPage('p');

// $tanggal = format_indo(date('Y-m-d'));

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$html =
    '<div>
       <h1 align="center">Data Laporan Supir</h1>
       
       <table cellspacing="1" cellpadding="2"  border="1" >
         <tr bgcolor=" #d1d1d1 ">
         <th width="50px" align="center">No.</th>
         <th width="200px" align="center">Nama Supir</th>
         <th align="center"> Nomor Telepon </th>
         <th width="210px" align="center"> Email </th>
    
         </tr>';

$no = 1;

foreach ($supir as $d) :
    $html .= '<tr>
    <td align="center">' . $no . '</td>
    <td >' . $d->nama_supir . '</td>
    <td >' . $d->no_telp . '</td>
    <td >' . $d->email_supir . '</td>';
    $html .= '</tr>';
    $no++;
endforeach;


$html .= '
</table><br><br>


<table>
<tr>
    <td><br></td>
    < align="right">Banjarmasin, ' . date('Y-m-d') . '<br>Mengetahui,<br> Pimpinan <br><br><br><br>.........................................................</td>
</tr>
</table>
       </div>';

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

$pdf->Output('laporan_operator.pdf', 'I');
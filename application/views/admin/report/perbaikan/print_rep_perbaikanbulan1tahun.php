<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document informasi
$pdf->SetCreator('SIMRENT Genset Web');
$pdf->SetTitle('Admin - Laporan Perbaikan Disetujui ');
$pdf->SetSubject('Operator');

$PDF_HEADER_STRING = "";

$pdf->SetHeaderData('KOP RTR REPORT APK V2.jpg', 180    , '', $PDF_HEADER_STRING, array(0, 0, 0), array(0, 0, 0));

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
       <h1 align="center">Perbaikan Truk Tangki</h1>
       
       <table cellspacing="1" cellpadding="2"  border="1" >

<tr>
    <th colspan="6" width="658px"> Bulan : </th>
</tr>

        <tr bgcolor=" #d1d1d1 ">
         <th width="30px" align="center">No.</th>
         <th width="100px" align="center">NOPOL</th>
         <th align="center"> Nama Bengkel </th>
         <th align="center">Tanggal</th>
         <th  width="200px" align="center"> Keterangan</th>
         <th  align="center"> Biaya</th>
         </tr>';

$no = 1;

foreach ($perbaikan as $d) :
    $html .= '<tr>
    <td align="center">' . $no . '</td>
    <td >' . $d->nopol . '</td>
    <td >' . $d->nama_bengkel . '</td>
    <td align="center">' . $d->tgl_perbaikan . '</td>
    <td >' . $d->keterangan . '</td>
    <td>Rp' . number_format($d->biaya_perbaikan) . '</td>';

    $html .= '</tr>';
    $no++;
endforeach;

foreach ($total_data as $td) :
    $html .=
        '<tr>
                                            <th colspan="5" align="center"><b>Total </b> </th>
                                            <th ><b><span style="color: red;">Rp&nbsp;' . number_format($td->biaya_perbaikan) . '</span></b></th>
                                            </tr>';
endforeach;



$html .= '
         </table><br><br><br><br>
         <table>
         <tr>
             <td><br><br><br><br><br></td>
             <td align="right">Banjarmasin, ' . date('d-M-Y') . '</td>
         </tr>
         <tr>
             <td colspan="2" align="right">' .
    $this->session->userdata('nama') . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             </td>
         </tr>
     </table>
       </div>';

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);

$pdf->Output('laporan_operator.pdf', 'I');

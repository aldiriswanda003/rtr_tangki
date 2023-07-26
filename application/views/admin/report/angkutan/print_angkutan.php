<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document informasi
$pdf->SetCreator('SIMRENT Genset Web');
$pdf->SetTitle('Laporan Data Angkutan');
$pdf->SetSubject('Operator');

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
       <h1 align="center">Data Angkutan</h1>
       
       <table cellspacing="1" cellpadding="2"  border="1" >


        <tr bgcolor=" #d1d1d1 ">
         <th width="30px" align="center">No.</th>
         <th align="center">NOPOL</th>
         <th width="70px" align="center"> Volume </th>
         <th align="center">Supir</th>
         <th align="center"> Tanggal Berangkat</th>
         <th width="180px" align="center"> Tujuan</th>
         <th align="center"> Kilometer PP</th>
         
         </tr>';

$no = 1;

foreach ($angkutan as $d) :
    $html .= '<tr>
    <td align="center">' . $no . '</td>
    <td >' . $d->nopol . '</td>
    <td align="center">' . number_format($d->volume_tangki) . ' L</td>
    <td align="center">' . $d->nama_supir . '</td>
    <td align="center">' . $d->tgl_berangkat . '</td>
    <td >' . $d->nama_tujuan . '</td>
    <td align="right">' . number_format($d->kilometer_pp) .  ' Km</td>';

    $html .= '</tr>';
    $no++;
endforeach;

foreach ($total_data as $td) :
    $html .=
        '<tr>
                                            <th colspan="6" align="center"><b>Total </b> </th>
                                            <th align="right"><b><span style="color: red;">' . number_format($td->kilometer_pp) . 'Km</span></b></th>
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

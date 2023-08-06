<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document informasi
$pdf->SetCreator('#');
$pdf->SetTitle('Laporan Pengeluaran');
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
       <h1 align="center">Laporan Pengeluaran Lain-Lain</h1>
       
       <table cellspacing="1" cellpadding="2"  border="1" >


        <tr bgcolor=" #d1d1d1 ">
         <th width="30px" align="center">No.</th>
         <th width="100px" align="center">Tanggal</th>
         <th align="center" width="300px"> Keterangan Pengeluaran</th>
         <th  align="center"> Biaya Pengeluaran</th>
         </tr>';

$no = 1;

    foreach ($pengeluaran as $d) :
        $html .= '<tr>
    <td align="center">' . $no . '</td>
    <td >' . $d->tanggal . '</td>
    <td >' . $d->nama_pengeluaran . '</td>
    <td>Rp' . number_format($d->biaya_pengeluaran) . '</td>';

        $html .= '</tr>';
        $no++;
    endforeach;

foreach ($total_data as $td) :
    $html .=
        '<tr>
                                            <th colspan="3" align="center"><b>Total</b></th>
                                            <th ><b><span style="color: red;">Rp&nbsp;' . number_format($td->biaya_pengeluaran) . '</span></b></th>
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

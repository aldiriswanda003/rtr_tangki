<?php
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// document informasi
$pdf->SetCreator('SIMRENT Genset Web');
$pdf->SetTitle('Admin - Laporan Perbaikan Disetujui ');
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

// $bulan = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
$html =

    '<div>
       <h1 align="center">Perbaikan Truk Tangki</h1> ';

$html =  '<br><br><br><br><table cellspacing="1" cellpadding="2"  border="1" >';
$no_bulan = 1;
$total_keseluruhan = 0;
foreach ($bln as $bl) :
    $html .= '<tr>
<th colspan="6" width="658px"> Bulan : ' . bulan_to_string($bl) . '</th>
</tr>';


    $html .= '
        <tr bgcolor=" #d1d1d1 ">
         <th width="30px" align="center">No.</th>
         <th width="100px" align="center">NOPOL</th>
         <th align="center"> Nama Bengkel </th>
         <th align="center">Tanggal</th>
         <th  width="200px" align="center"> Keterangan</th>
         <th  align="center"> Biaya</th>
         </tr>';
    if ($no_bulan == $bl) {
        $no = 1;
        $total_biaya_perbaikan = 0;
        foreach ($perbaikan as $d) :
            $bulan_now = date('n', strtotime($d->tgl_perbaikan));
            if ($no_bulan == $bulan_now) {
                $html .= '<tr>
    <td align="center">' . $no . '</td>
    <td >' . $d->nopol . '</td>
    <td >' . $d->nama_bengkel . '</td>
    <td align="center">' . $d->tgl_perbaikan . '</td>
    <td >' . $d->keterangan . '</td>
    <td>Rp' . number_format($d->biaya_perbaikan) . '</td>';
                $html .= '</tr>';
                $total_biaya_perbaikan += $d->biaya_perbaikan;
            }

            $no++;
        endforeach;

        // foreach ($total_data as $td) :
        $html .=
            '<tr>
                                            <th colspan="5" align="center"><b>Total </b> </th>
                                            <th ><b><span style="color: red;">Rp&nbsp;' . number_format($total_biaya_perbaikan) . '</span></b></th>
                                            </tr>';
        // endforeach;
        $total_keseluruhan += $total_biaya_perbaikan;
    }
    $no_bulan++;
endforeach;
$html .=
    '<tr>
                                            <th colspan="5" align="center"><b>Total Keseluruhan</b> </th>
                                            <th ><b><span style="color: red;">Rp&nbsp;' . number_format($total_keseluruhan) . '</span></b></th>
                                            </tr>';

$html .= '
         </table><br><br><br><br>';
$html .= '
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
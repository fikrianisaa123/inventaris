<?php
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('Daftar Inventaris');
    $pdf->SetHeaderMargin(30);
    $pdf->SetTopMargin(20);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 8);
    $i=1;
    $html='<h3 align="center">INVENTARISASI KETERSEDIAAN PERALATAN PENANGGUALANGAN BENCANA <br> DI BPBD KABUPATEN/KOTA ............................................................</h3>
            <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                <tr bgcolor="#ffffff">
                    <th width="5%" align="center" rowspan="2">No</th>
                    <th width="7%" align="center" rowspan="2">Kode</th>
                    <th rowspan="2">Jenis Peralatan</th>
                    <th align="center" rowspan="2">JML</th>
                    <th align="center" colspan="2">KONDISI</th>
                    <th align="center" colspan="4">SUMBER DANA</th>
                    <th align="center" rowspan="2">KET</th>
                </tr>
                <tr bgcolor="#ffffff">
                    <th align="center">BAIK</th>
                    <th align="center">RUSAK</th>
                    <th align="center">APBN</th>
                    <th align="center">APBD I</th>
                    <th align="center">APBD II</th>
                    <th align="center">SWASTA</th>
                </tr>';
    foreach ($inventaris as $row) 
        {
            $html.='<tr bgcolor="#ffffff">
                    <td align="center">'.$i++.'</td>
                    <td>'.$row['kode'].'</td>
                    <td>'.$row['jenis_peralatan'].'</td>
                    <td>'.$row['jumlah'].'</td>
                    <td>'.$row['baik'].'</td>
                    <td>'.$row['rusak'].'</td>
                    <td>'.$row['apbn'].'</td>
                    <td>'.$row['apbd_satu'].'</td>
                    <td>'.$row['apbd_dua'].'</td>
                    <td>'.$row['swasta'].'</td>
                    <td>'.$row['keterangan'].'</td>
                </tr>';
        }
    $html.='</table>';
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output(''.time().'.pdf', 'I');
?>
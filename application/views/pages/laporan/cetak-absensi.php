<?php
    $month = ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body lang="ar">
        <?php foreach ($kelas as $kelas) :?>
            <table border=1>
                <tr>
                    <td colspan="26"><center><strong>ABSENSI KELAS <?= $kelas['nama_kelas']?></strong></center></td>
                </tr>
                <tr>
                    <td colspan="26"><strong>PERIODE <?= $month[date("m", strtotime($kelas['tgl_mulai']))-1] ." ".date("Y", strtotime($kelas['tgl_mulai']))?></strong></td>
                </tr>
                <tr>
                    <td rowspan=2>الرقم</td>
                    <td rowspan=2><center>الاسم</center></td>
                    <td colspan=20><center>التاريخ</center></td>
                    <td colspan=4><center>NILAI PEKAN</center></td>
                </tr>
                <tr>
                    <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    <td><center>I</center></td><td><center>II</center></td><td><center>III</center></td><td><center>IV</center></td>
                </tr>
                <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                    <tr>
                        <td><center><?= $i+1?></center></td>
                        <td><?= $peserta['nama_indo']?></td>
                        <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                        <td></td><td></td><td></td><td></td>
                    </tr>
                <?php endforeach;?>
            </table>
            <br><br>
        <?php endforeach;?>
    </body>
</html>
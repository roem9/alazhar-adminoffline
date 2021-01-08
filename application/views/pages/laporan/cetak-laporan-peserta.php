<!DOCTYPE html>
<html dir="rtl" lang="ar">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php foreach ($kelas as $kelas) :?>
            <table border=1>
                <?php if($kelas['program'] == "Full Time 1" || $kelas['program'] == "Full Time 2" || $kelas['program'] == "Full Time 3"):?>
                    <tr>
                        <td colspan="10"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2"><center>Nama</center></td>
                        <td rowspan="2"><center>Tgl Daftar</center></td>
                        <td rowspan="2"><center>TTL</center></td>
                        <td rowspan="2"><center>Alamat</center></td>
                        <td colspan="3"><center>Nilai</center></td>
                        <td rowspan="2"><center>Hasil</center></td>
                        <td rowspan="2"><center>No. Syahadah</center></td>
                    </tr>
                    <tr>
                        <td>Mufrodat</td>
                        <td>Muhadatsah</td>
                        <td>Qowaid</td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= date('d-m-Y', strtotime($peserta['tgl_daftar']))?></td>
                            <td><?= $peserta['t4_lahir_indo'] . ", " . date('d-m-Y', strtotime($peserta['tgl_lahir']))?></td>
                            <td><?= $peserta['desa_kel_indo'] . ", " . $peserta['kec_indo'] . ", " . $peserta['kota_kab_indo']?></td>
                            <td><?= $peserta['nilai_mufrodat']?></td>
                            <td><?= $peserta['nilai_muhadatsah']?></td>
                            <td><?= $peserta['nilai_qowaid']?></td>
                            <td><?= $peserta['nilai_sertifikat']?></td>
                            <td><?= $peserta['no_syahadah']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </table>
        <?php endforeach;?>
    </body>
</html>
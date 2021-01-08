<?php
    function tgl_indo($tanggal){
        $bulan = array (1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        .center {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
        .fo-16{
            font-size: 16px;
        }
        ol li {
            /* letter-spacing: 10px; */
        }
    </style>
</head><body style="text-align: justify;">
    <p class="center bold"><span class="fo-16">DAFTAR DATA LOGIN PESERTA</p>
        <?php foreach ($user as $user) :?>
            <div style="float:left">
                <table style="border:1">
                    <tr>
                        <td colspan=2>online.mrscholae.com</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $user['nama']?></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>: <?= $user['username']?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>: <?= date("dmY", strtotime($user['tgl_lahir']));?></td>
                    </tr>
                </table>
            </div>
            <!-- <div style="width: 340px; border-color: black; border:1;padding: 5px; overflow: hidden">
                online.mrscholae.com
                <p>Nama : </p>
                <p>Username : </p>
                <p>Password : </p>
                <p>Nama : <?= $user['nama'];?></p>
                <p>Username : <?= $user['username'];?></p>
                <p>Password : <?= date("dmY", strtotime($user['tgl_lahir']));?></p>
            </div> -->
            <br>
        <?php endforeach;?>
</body></html>

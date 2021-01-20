<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body lang="ar">
        <h3><?= $filename?></h3>
        <?php foreach ($kelas as $kelas) :?>
            <table border=1>
                <?php if($kelas['program'] == "Full Time 1" || $kelas['program'] == "Full Time 2" || $kelas['program'] == "Full Time 3" || $kelas['program'] == "Usbuain"):?>
                    <tr>
                        <td colspan="9"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2"><center>Nama</center></td>
                        <td rowspan="2"><center>Tgl Daftar</center></td>
                        <td rowspan="2"><center>TTL</center></td>
                        <td rowspan="2"><center>Alamat</center></td>
                        <td colspan="3"><center>Nilai</center></td>
                        <td rowspan="2"><center>Hasil</center></td>
                    </tr>
                    <tr>
                        <td><center>Mufrodat</center></td>
                        <td><center>Muhadatsah</center></td>
                        <td><center>Qowaid</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= date('d-m-Y', strtotime($peserta['tgl_daftar']))?></td>
                            <td><?= $peserta['t4_lahir_indo'] . ", " . date('d-m-Y', strtotime($peserta['tgl_lahir']))?></td>
                            <td><?= $peserta['desa_kel_indo'] . ", " . $peserta['kec_indo'] . ", " . $peserta['kota_kab_indo']?></td>
                            <td><center><?= $peserta['nilai_mufrodat']?></center></td>
                            <td><center><?= $peserta['nilai_muhadatsah']?></center></td>
                            <td><center><?= $peserta['nilai_qowaid']?></center></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                        </tr>
                    <?php endforeach;?>     
                <?php elseif($kelas['program'] == "Tamyiz 1&2") :?>
                    <tr>
                        <td colspan="9"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2"><center>Nama</center></td>
                        <td rowspan="2"><center>Tgl Daftar</center></td>
                        <td rowspan="2"><center>TTL</center></td>
                        <td rowspan="2"><center>Alamat</center></td>
                        <td colspan="3"><center>Nilai</center></td>
                        <td rowspan="2"><center>Hasil</center></td>
                    </tr>
                    <tr>
                        <td><center>Fahmul Qowaid</center></td>
                        <td><center>Tarjamah</center></td>
                        <td><center>Tathbiiqu Atta'liim</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= date('d-m-Y', strtotime($peserta['tgl_daftar']))?></td>
                            <td><?= $peserta['t4_lahir_indo'] . ", " . date('d-m-Y', strtotime($peserta['tgl_lahir']))?></td>
                            <td><?= $peserta['desa_kel_indo'] . ", " . $peserta['kec_indo'] . ", " . $peserta['kota_kab_indo']?></td>
                            <td><center><?= $peserta['nilai_fahmulqowaid']?></center></td>
                            <td><center><?= $peserta['nilai_tarjamah']?></center></td>
                            <td><center><?= $peserta['nilai_tatbiquttalim']?></center></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                        </tr>
                    <?php endforeach;?> 
                <?php elseif($kelas['program'] == "Tamyiz 3&4") :?>
                    <tr>
                        <td colspan="9"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2"><center>Nama</center></td>
                        <td rowspan="2"><center>Tgl Daftar</center></td>
                        <td rowspan="2"><center>TTL</center></td>
                        <td rowspan="2"><center>Alamat</center></td>
                        <td colspan="3"><center>Nilai</center></td>
                        <td rowspan="2"><center>Hasil</center></td>
                    </tr>
                    <tr>
                        <td><center>Tarkib</center></td>
                        <td><center>I'lal</center></td>
                        <td><center>Tarjamah</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= date('d-m-Y', strtotime($peserta['tgl_daftar']))?></td>
                            <td><?= $peserta['t4_lahir_indo'] . ", " . date('d-m-Y', strtotime($peserta['tgl_lahir']))?></td>
                            <td><?= $peserta['desa_kel_indo'] . ", " . $peserta['kec_indo'] . ", " . $peserta['kota_kab_indo']?></td>
                            <td><center><?= $peserta['nilai_tarkib']?></center></td>
                            <td><center><?= $peserta['nilai_ilal']?></center></td>
                            <td><center><?= $peserta['nilai_tarjamah']?></center></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                        </tr>
                    <?php endforeach;?> 
                <?php elseif($kelas['program'] == "AlMiftah 1") :?>
                    <tr>
                        <td colspan="8"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2"><center>Nama</center></td>
                        <td rowspan="2"><center>Tgl Daftar</center></td>
                        <td rowspan="2"><center>TTL</center></td>
                        <td rowspan="2"><center>Alamat</center></td>
                        <td colspan="2"><center>Nilai</center></td>
                        <td rowspan="2"><center>Hasil</center></td>
                    </tr>
                    <tr>
                        <td><center>Binaayatul Jumlah</center></td>
                        <td><center>Tarakib</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= date('d-m-Y', strtotime($peserta['tgl_daftar']))?></td>
                            <td><?= $peserta['t4_lahir_indo'] . ", " . date('d-m-Y', strtotime($peserta['tgl_lahir']))?></td>
                            <td><?= $peserta['desa_kel_indo'] . ", " . $peserta['kec_indo'] . ", " . $peserta['kota_kab_indo']?></td>
                            <td><center><?= $peserta['nilai_binayatuljumlah']?></center></td>
                            <td><center><?= $peserta['nilai_tarakib']?></center></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                        </tr>
                    <?php endforeach;?> 
                <?php elseif($kelas['program'] == "AlMiftah 2") :?>
                    <tr>
                        <td colspan="8"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2"><center>Nama</center></td>
                        <td rowspan="2"><center>Tgl Daftar</center></td>
                        <td rowspan="2"><center>TTL</center></td>
                        <td rowspan="2"><center>Alamat</center></td>
                        <td colspan="2"><center>Nilai</center></td>
                        <td rowspan="2"><center>Hasil</center></td>
                    </tr>
                    <tr>
                        <td><center>Tahfidzul Andzhima</center></td>
                        <td><center>Qiroah</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= date('d-m-Y', strtotime($peserta['tgl_daftar']))?></td>
                            <td><?= $peserta['t4_lahir_indo'] . ", " . date('d-m-Y', strtotime($peserta['tgl_lahir']))?></td>
                            <td><?= $peserta['desa_kel_indo'] . ", " . $peserta['kec_indo'] . ", " . $peserta['kota_kab_indo']?></td>
                            <td><center><?= $peserta['nilai_tahfidzulandzhima']?></center></td>
                            <td><center><?= $peserta['nilai_qiroah']?></center></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                        </tr>
                    <?php endforeach;?> 
                <?php elseif($kelas['program'] == "Timur Tengah 1" || $kelas['program'] == "Timur Tengah 2") :?>
                    <tr>
                        <td colspan="9"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2"><center>Nama</center></td>
                        <td rowspan="2"><center>Tgl Daftar</center></td>
                        <td rowspan="2"><center>TTL</center></td>
                        <td rowspan="2"><center>Alamat</center></td>
                        <td colspan="3"><center>Nilai</center></td>
                        <td rowspan="2"><center>Hasil</center></td>
                    </tr>
                    <tr>
                        <td><center>Qiroah</center></td>
                        <td><center>Qowaid</center></td>
                        <td><center>TOAFL</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= date('d-m-Y', strtotime($peserta['tgl_daftar']))?></td>
                            <td><?= $peserta['t4_lahir_indo'] . ", " . date('d-m-Y', strtotime($peserta['tgl_lahir']))?></td>
                            <td><?= $peserta['desa_kel_indo'] . ", " . $peserta['kec_indo'] . ", " . $peserta['kota_kab_indo']?></td>
                            <td><center><?= $peserta['nilai_qiroah']?></center></td>
                            <td><center><?= $peserta['nilai_qowaid']?></center></td>
                            <td><center><?= $peserta['nilai_toafl']?></center></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                        </tr>
                    <?php endforeach;?>
                <?php elseif($kelas['program'] == "Manhaji") :?>
                    <tr>
                        <td colspan="8"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2"><center>Nama</center></td>
                        <td rowspan="2"><center>Tgl Daftar</center></td>
                        <td rowspan="2"><center>TTL</center></td>
                        <td rowspan="2"><center>Alamat</center></td>
                        <td colspan="2"><center>Nilai</center></td>
                        <td rowspan="2"><center>Hasil</center></td>
                    </tr>
                    <tr>
                        <td><center>Fahmul Qowaid</center></td>
                        <td><center>Adad Ma'dud</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= date('d-m-Y', strtotime($peserta['tgl_daftar']))?></td>
                            <td><?= $peserta['t4_lahir_indo'] . ", " . date('d-m-Y', strtotime($peserta['tgl_lahir']))?></td>
                            <td><?= $peserta['desa_kel_indo'] . ", " . $peserta['kec_indo'] . ", " . $peserta['kota_kab_indo']?></td>
                            <td><center><?= $peserta['nilai_fahmulqowaid']?></center></td>
                            <td><center><?= $peserta['nilai_adadmadud']?></center></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                        </tr>
                    <?php endforeach;?> 
                <?php endif;?>
            </table>
            <br>
        <?php endforeach;?>
    </body>
</html>
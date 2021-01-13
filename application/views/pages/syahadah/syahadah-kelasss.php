<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body lang="ar">
    <?php foreach ($peserta as $peserta) :?>
        Nama : <?= $peserta['nama_indo']?><br>
        Tempta Tgl Lahir : <?= $peserta['t4_lahir_indo'] . ", " . $peserta['tgl_lahir']?><br>
        ALamat : <?= $peserta['desa_kel_indo'].", ".$peserta['kec_indo'].", ".$peserta['kota_kab_indo'];?><br>
        Ikut : <?= $peserta['syahadah']['program_arab'];?><br>
        Tgl : من <?= $kelas['tgl_mulai']?> - <?= $kelas['tgl_selesai']?><br>
        nilai : <?= $peserta['syahadah']['nilai']?><br>
        no: <?= $peserta['syahadah']['nomor']?><br>
        nilainya <br>
        <?php if($kelas['program'] == "Full Time 1" || $kelas['program'] == "Full Time 2" || $kelas['program'] == "Full Time 3" || $kelas['program'] == "Usbuain"):?>
            المفردات = <?= $peserta['syahadah']['nilai_mufrodat']?><br>
            المحادثة = <?= $peserta['syahadah']['nilai_muhadatsah']?><br>
            القواعد = <?= $peserta['syahadah']['nilai_qowaid']?><br>
        <?php elseif($kelas['program'] == "Tamyiz 1&2"):?>
            فهم القواعد = <?= $peserta['syahadah']['nilai_fahmulqowaid']?><br>
            الترجمة = <?= $peserta['syahadah']['nilai_tarjamah']?><br>
            تطبيق التعليم = <?= $peserta['syahadah']['nilai_tatbiquttalim']?><br>
        <?php elseif($kelas['program'] == "Tamyiz 3&4"):?>
            التركيب = <?= $peserta['syahadah']['nilai_tarkib']?><br>
            الإعلال = <?= $peserta['syahadah']['nilai_ilal']?><br>
            الترجمة = <?= $peserta['syahadah']['nilai_tarjamah']?><br>
        <?php elseif($kelas['program'] == "AlMiftah 1"):?>
            بنايات الجملة = <?= $peserta['syahadah']['nilai_binayatuljumlah']?><br>
            تراكيب = <?= $peserta['syahadah']['nilai_tarakib']?><br>
        <?php elseif($kelas['program'] == "AlMiftah 2"):?>
            تحفيظ الأنظمة = <?= $peserta['syahadah']['nilai_tahfidzulandzhima']?><br>
            قراءة = <?= $peserta['syahadah']['nilai_qiroah']?><br>
        <?php elseif($kelas['program'] == "Timur Tengah 1" || $kelas['program'] == "Timur Tengah 2"):?>
            القراءة = <?= $peserta['syahadah']['nilai_qiroah']?><br>
            القواعد = <?= $peserta['syahadah']['nilai_qowaid']?><br>
            TOAFL = <?= $peserta['syahadah']['nilai_toafl']?><br>
        <?php elseif($kelas['program'] == "Manhaji"):?>
            فهم القواعد = <?= $peserta['syahadah']['nilai_fahmulqowaid']?><br>
            العدد و المعدود = <?= $peserta['syahadah']['nilai_adadmadud']?><br>
        <?php endif;?>
        <br><br><br>
    <?php endforeach;?>
</body>
</html>






<!-- INSERT INTO `nilai_peserta` (`id`, `id_kelas`, `id_peserta`, `pelajaran`, `nilai`, `tgl_input`) VALUES (NULL, '7', '30', 'Fahmul Qowaid', '88', '2021-01-05 09:13:53'), (NULL, '7', '29', 'Fahmul Qowaid', '90', '2021-01-05 09:13:53'), (NULL, '7', '28', 'Fahmul Qowaid', '100', '2021-01-05 09:13:53'), (NULL, '7', '31', 'Fahmul Qowaid', '100', '2021-01-05 09:13:53'), (NULL, '7', '32', 'Fahmul Qowaid', '100', '2021-01-05 09:13:53');

INSERT INTO `nilai_peserta` (`id`, `id_kelas`, `id_peserta`, `pelajaran`, `nilai`, `tgl_input`) VALUES (NULL, '7', '30', "Adad Ma'dud", '88', '2021-01-05 09:13:53'), (NULL, '7', '29', "Adad Ma'dud", '90', '2021-01-05 09:13:53'), (NULL, '7', '28', "Adad Ma'dud", '100', '2021-01-05 09:13:53'), (NULL, '7', '31', "Adad Ma'dud", '100', '2021-01-05 09:13:53'), (NULL, '7', '32', "Adad Ma'dud", '100', '2021-01-05 09:13:53'); -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
			/* position: absolute;
			left: 500;
			top: 560px;
            font-size: 22px; */
            font-family: 'arab';
            direction: 'rtl';
        }
        
        .nama {
            position: absolute;
            width: 100%;
            /* top: 520px; */
            /* font-family: 'mcs'; */
            color: red;
            top: 510px;
        }

        .ttl {
            position: absolute;
            width: 100%;
            /* background: red; */
            top: 560px;
        }
        
        .alamat {
            position: absolute;
            width: 100%;
            /* background: red; */
            top: 600px;
        }
        
        .pr1 {
            position: absolute;
            width: 100%;
            /* background: red; */
            top: 680px;
            word-spacing: 10px;
        }
        
        .pr2 {
            position: absolute;
            width: 100%;
            /* background: red; */
            top: 715px;
        }

        .pr3 {
            position: absolute;
            width: 100%;
            /* background: red; */
            top: 750px;
        }

        .pr4 {
            position: absolute;
            width: 100%;
            /* background: red; */
            top: 785px;
        }

        .pr5 {
            position: absolute;
            width: 100%;
            /* background: red; */
            top: 820px;
        }

        .pr6 {
            position: absolute;
            width: 100%;
            /* background: red; */
            top: 860px;
        }

        .pr7 {
            position: absolute;
            width: 120px;
            /* background: red; */
            top: 863px;
            left: 200px;
        }

        .tgl_selesai {
            position: absolute;
            font-size: 16px;
            top: 855px;
            left: 200;
            /* background: red; */
            width: 120px;
        }
        
        .tgl_selesai2 {
            position: absolute;
            font-size: 16px;
            top: 875px;
            left: 200;
            /* background: red; */
            width: 120px;
        }

    </style>
</head>
<body lang="ar">
    <img src="<?= base_url()?>assets/img/sertifikat.jpg" alt="" srcset="">
    <div class="nama">
        <p style="text-align: center; font-size: 30px"><strong><?= $peserta['nama_arab']?></strong></p>
    </div>
    <div class="ttl">
        <p style="text-align: center; font-size: 26px"><strong><?= $peserta['t4_lahir_arab'] . "، " . $peserta['tgl_lahir']?></strong></p>
    </div>
    <div class="alamat">
        <p style="text-align: center; font-size: 24px"><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></p>
    </div>
    <div class="pr1">
        <div style="text-align: center; font-size: 24px">قد اشترك الدراسة العربية <strong>"<?= $peserta['syahadah']['program_arab'];?>"</strong> <span style="font-size: 1px">ش</span></div>
    </div>
    <div class="pr2">
        <div style="text-align: center; font-size: 22px">التي قام بها تعليم اللغة العربية الدورى <strong>"الأزهار"</strong> <span style="font-size: 1px">ش</span></div>
    </div>
    <div class="pr3">
        <div style="text-align: center; font-size: 22px"><i>من <?= $kelas['tgl_mulai']?>م - <?= $kelas['tgl_selesai']?>م.</i> و أن له حسب نتائج اختباره</div>
    </div>
    <div class="pr4">
        <div style="text-align: center; font-size: 22px">الشفوية و التحريرية نجاحا بتقدير عام : <i><u><b><?= $peserta['syahadah']['nilai']?></b></u></i></div>
    </div>
    <div class="pr5">
        <div style="text-align: center; font-size: 22px">سجلت هذه الشهادة برقم دفتر القيد : <b><?= $peserta['syahadah']['nomor']?></b></div>
    </div>
    <div class="pr6">
        <div style="margin-left: 350px; font-size: 22px">تحريرا : <span style="font-size: 1px">ش</span></div>
    </div>
    <div class="pr7">
        <hr class="garis" style="color: black">
    </div>
    <div class="tgl_selesai">
        <div style="text-align: center"><b><?= $kelas['tgl_selesai'];?>م</b></div>
    </div>
    <div class="tgl_selesai2">
        <div style="text-align: center"><b><?= $kelas['tgl_selesai_hijriah'];?></b></div>
    </div>


</body>
</html>






<!-- INSERT INTO `nilai_peserta` (`id`, `id_kelas`, `id_peserta`, `pelajaran`, `nilai`, `tgl_input`) VALUES (NULL, '7', '30', 'Fahmul Qowaid', '88', '2021-01-05 09:13:53'), (NULL, '7', '29', 'Fahmul Qowaid', '90', '2021-01-05 09:13:53'), (NULL, '7', '28', 'Fahmul Qowaid', '100', '2021-01-05 09:13:53'), (NULL, '7', '31', 'Fahmul Qowaid', '100', '2021-01-05 09:13:53'), (NULL, '7', '32', 'Fahmul Qowaid', '100', '2021-01-05 09:13:53');

INSERT INTO `nilai_peserta` (`id`, `id_kelas`, `id_peserta`, `pelajaran`, `nilai`, `tgl_input`) VALUES (NULL, '7', '30', "Adad Ma'dud", '88', '2021-01-05 09:13:53'), (NULL, '7', '29', "Adad Ma'dud", '90', '2021-01-05 09:13:53'), (NULL, '7', '28', "Adad Ma'dud", '100', '2021-01-05 09:13:53'), (NULL, '7', '31', "Adad Ma'dud", '100', '2021-01-05 09:13:53'), (NULL, '7', '32', "Adad Ma'dud", '100', '2021-01-05 09:13:53'); -->
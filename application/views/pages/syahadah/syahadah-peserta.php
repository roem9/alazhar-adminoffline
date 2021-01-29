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
            top: 495px;
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
            width: 150px;
            /* background: red; */
            top: 863px;
            left: 200px;
        }

        .tgl_selesai {
            position: absolute;
            font-size: 18px;
            top: 853px;
            left: 200;
            /* background: red; */
            width: 150px;
        }
        
        .tgl_selesai2 {
            position: absolute;
            font-size: 18px;
            top: 875px;
            left: 200;
            /* background: green; */
            width: 150px;
        }

    </style>
</head>
<body lang="ar">
    <!-- <img src="<?= base_url()?>assets/img/sertifikat.jpg" alt="" srcset=""> -->
    <div class="nama">
        <p style="text-align: center; font-size: 40px"><strong><?= $peserta['nama_arab']?></strong></p>
    </div>
    <div class="ttl">
        <p style="text-align: center; font-size: 26px"><strong><?= $peserta['t4_lahir_arab'] . "، " . $peserta['tgl_lahir']?></strong></p>
    </div>
    <div class="alamat">
        <p style="text-align: center; font-size: 26px"><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></p>
    </div>
    <div class="pr1">
        <?php if($peserta['jk'] == "Laki-Laki") :?>
            <div style="text-align: center; font-size: 24px">قد اشترك الدراسة العربية <strong>"<?= $peserta['syahadah']['program_arab'];?>"</strong> <span style="font-size: 1px">ش</span></div>
        <?php else :?>
            <div style="text-align: center; font-size: 24px">قد اشتركت الدراسة العربية <strong>"<?= $peserta['syahadah']['program_arab'];?>"</strong> <span style="font-size: 1px">ش</span></div>
        <?php endif;?>
    </div>
    <div class="pr2">
        <div style="text-align: center; font-size: 22px">التي قام بها تعليم اللغة العربية الدورى <strong>"الأزهار"</strong> <span style="font-size: 1px">ش</span></div>
    </div>
    <div class="pr3">
        <?php if($peserta['jk'] == "Laki-Laki") :?>
            <div style="text-align: center; font-size: 22px"><i>من <?= $kelas['tgl_mulai']?>م - <?= $kelas['tgl_selesai']?>م.</i> و أن له حسب نتائج اختباره</div>
        <?php else :?>
            <div style="text-align: center; font-size: 22px"><i>من <?= $kelas['tgl_mulai']?>م - <?= $kelas['tgl_selesai']?>م.</i> وأن لها حسب نتائج اختبارها</div>
        <?php endif;?>
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
        <div style="text-align: center"><b><?= $kelas['tgl_cetak_sertifikat'];?>م</b></div>
    </div>
    <div class="tgl_selesai2">
        <div style="text-align: center"><b><?= $kelas['tgl_cetak_sertifikat_hijriah'];?></b></div>
    </div>
</body>
</html>
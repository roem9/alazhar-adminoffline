<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
			/* position: absolute;
			left: 500;
			top: 560px;
            font-size: 22px; */
            font-family: 'arab';
            direction: 'rtl';
        }

        .kiri1{
            position: absolute;
            color: #016433;
            top: 350px;
            right: 226px;
            /* background: red; */
            width: 170px;
            height: 37px;
        }
        
        .kiri2{
            position: absolute;
            color: #016433;
            top: 387px;
            right: 226px;
            /* background: blue; */
            width: 170px;
            height: 37px;
        }
        
        .kiri3{
            position: absolute;
            color: #016433;
            top: 424px;
            right: 226px;
            /* background: red; */
            width: 170px;
            height: 37px;
        }
        
        .kiri3toafl{
            position: absolute;
            color: #016433;
            top: 432px;
            right: 226px;
            /* background: red; */
            width: 170px;
            height: 37px;
        }
        
        .kanan1{
            position: absolute;
            color: #016433;
            top: 350px;
            right: 396px;
            /* background: red; */
            width: 170px;
            height: 37px;
        }
        
        .kanan2{
            position: absolute;
            color: #016433;
            top: 387px;
            right: 396px;
            /* background: blue; */
            width: 170px;
            height: 37px;
        }
        
        .kanan3{
            position: absolute;
            color: #016433;
            top: 424px;
            right: 396px;
            /* background: red; */
            width: 170px;
            height: 37px;
        }
    </style>
</head>
<body>
    <?php if($kelas['program'] == "Full Time 1" || $kelas['program'] == "Full Time 2" || $kelas['program'] == "Full Time 3" || $kelas['program'] == "Usbuain"):?>
        <div class="kiri1">
            <div style="text-align: center;font-size: 26px;"><strong>المفردات</strong></div>
        </div>
        <div class="kanan1">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_mufrodat']?><br></strong></div>
        </div>
        <div class="kiri2">
            <div style="text-align: center;font-size: 26px;"><strong>المحادثة</strong></div>
        </div>
        <div class="kanan2">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_muhadatsah']?><br></strong></div>
        </div>
        <div class="kiri3">
            <div style="text-align: center;font-size: 26px;"><strong>القواعد</strong></div>
        </div>
        <div class="kanan3">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_qowaid']?></strong></div>
        </div>
    <?php elseif($kelas['program'] == "Tamyiz 1&2"):?>
        <div class="kiri1">
            <div style="text-align: center;font-size: 26px;"><strong>فهم القواعد</strong></div>
        </div>
        <div class="kanan1">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_fahmulqowaid']?><br></strong></div>
        </div>
        <div class="kiri2">
            <div style="text-align: center;font-size: 26px;"><strong>الترجمة</strong></div>
        </div>
        <div class="kanan2">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_tarjamah']?><br></strong></div>
        </div>
        <div class="kiri3">
            <div style="text-align: center;font-size: 26px;"><strong>تطبيق التعليم</strong></div>
        </div>
        <div class="kanan3">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_tatbiquttalim']?></strong></div>
        </div>
    <?php elseif($kelas['program'] == "Tamyiz 3&4"):?>
        <div class="kiri1">
            <div style="text-align: center;font-size: 26px;"><strong>التركيب</strong></div>
        </div>
        <div class="kanan1">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_tarkib']?><br></strong></div>
        </div>
        <div class="kiri2">
            <div style="text-align: center;font-size: 26px;"><strong>الإعلال</strong></div>
        </div>
        <div class="kanan2">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_ilal']?><br></strong></div>
        </div>
        <div class="kiri3">
            <div style="text-align: center;font-size: 26px;"><strong>الترجمة</strong></div>
        </div>
        <div class="kanan3">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_tarjamah']?></strong></div>
        </div>
    <?php elseif($kelas['program'] == "AlMiftah 1"):?>
        <div class="kiri1">
            <div style="text-align: center;font-size: 26px;"><strong>بنايات الجملة</strong></div>
        </div>
        <div class="kanan1">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_binayatuljumlah']?><br></strong></div>
        </div>
        <div class="kiri2">
            <div style="text-align: center;font-size: 26px;"><strong>تراكيب</strong></div>
        </div>
        <div class="kanan2">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_tarakib']?><br></strong></div>
        </div>
    <?php elseif($kelas['program'] == "AlMiftah 2"):?>
        <div class="kiri1">
            <div style="text-align: center;font-size: 26px;"><strong>تحفيظ الأنظمة</strong></div>
        </div>
        <div class="kanan1">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_tahfidzulandzhima']?><br></strong></div>
        </div>
        <div class="kiri2">
            <div style="text-align: center;font-size: 26px;"><strong>قراءة</strong></div>
        </div>
        <div class="kanan2">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_qiroah']?><br></strong></div>
        </div>
    <?php elseif($kelas['program'] == "Timur Tengah 1" || $kelas['program'] == "Timur Tengah 2"):?>
        <div class="kiri1">
            <div style="text-align: center;font-size: 26px;"><strong>القراءة</strong></div>
        </div>
        <div class="kanan1">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_qiroah']?><br></strong></div>
        </div>
        <div class="kiri2">
            <div style="text-align: center;font-size: 26px;"><strong>القواعد</strong></div>
        </div>
        <div class="kanan2">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_qowaid']?><br></strong></div>
        </div>
        <div class="kiri3toafl">
            <div style="text-align: center;font-size: 18px;"><strong>TOAFL</strong></div>
        </div>
        <div class="kanan3">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_toafl']?></strong></div>
        </div>
    <?php elseif($kelas['program'] == "Manhaji"):?>
        <div class="kiri1">
            <div style="text-align: center;font-size: 26px;"><strong>فهم القواعد</strong></div>
        </div>
        <div class="kanan1">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_fahmulqowaid']?><br></strong></div>
        </div>
        <div class="kiri2">
            <div style="text-align: center;font-size: 26px;"><strong>العدد و المعدود</strong></div>
        </div>
        <div class="kanan2">
            <div style="text-align: center;font-size: 26px;"><strong><?= $peserta['syahadah']['nilai_adadmadud']?><br></strong></div>
        </div>
    <?php endif;?>
</body>
</html>
<?php
    function tgl_masehi($tanggal)
    {
        
        $array_bulan=array("يناير","فبراير","مارس","أبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر");
                    
        $tanggalnya=substr($tanggal,8,2);
        $bulannya=$array_bulan[ceil(substr($tanggal,5,2))-1];
        $tahunnya=substr($tanggal,0,4);
        $tglsekarang=$tanggalnya." ".$bulannya." ".$tahunnya;

        return $tglsekarang;

    }

    function makeInt($angka)
    {
        if ($angka < -0.0000001)
        {
            return ceil($angka-0.0000001);
        }
        else 
        { 
            return floor($angka+0.0000001); 
        }
    }

    function tgl_hijriah($tanggal)
    {

        $array_bulan = array("محرم","صفر","ربيع الأول","ربيع الثاني","جمادى الأولى","جمادى الثانية","رجب","شعبان","رمضان","شوال","ذو القعدة","ذو الحجة");
                            
        $date = makeInt(substr($tanggal,8,2));
        $month = makeInt(substr($tanggal,5,2));
        $year = makeInt(substr($tanggal,0,4));

        if (($year>1582)||(($year == "1582") && ($month > 10))||(($year == "1582") && ($month=="10")&&($date >14)))
        {
            $jd = makeInt((1461*($year+4800+makeInt(($month-14)/12)))/4)+
            makeInt((367*($month-2-12*(makeInt(($month-14)/12))))/12)-
            makeInt( (3*(makeInt(($year+4900+makeInt(($month-14)/12))/100))) /4)+
            $date-32075; 
        } 
        else
        {
            $jd = 367*$year-makeInt((7*($year+5001+makeInt(($month-9)/7)))/4)+
            makeInt((275*$month)/9)+$date+1729777;
        }

        $wd = $jd%7;
        $l = $jd-1948440+10632;
        $n=makeInt(($l-1)/10631);
        $l=$l-10631*$n+354;
        $z=(makeInt((10985-$l)/5316))*(makeInt((50*$l)/17719))+(makeInt($l/5670))*(makeInt((43*$l)/15238));
        $l=$l-(makeInt((30-$z)/15))*(makeInt((17719*$z)/50))-(makeInt($z/16))*(makeInt((15238*$z)/43))+29;
        $m=makeInt((24*$l)/709);
        $d=$l-makeInt((709*$m)/24);
        $y=30*$n+$z-30;

        $g = $m-1;
        $final = "$d $array_bulan[$g] ".$y."هـ";

        return $final;
    }
?>

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
                        <td colspan="19"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td><center>Nama</center></td>
                        <td><center>Tempat, Tanggal lahir</center></td>
                        <td><center>Alamat</center></td>
                        <td><center>Nilai</center></td>
                        <td><center>NIM</center></td>
                        <td><center>Mufrodat</center></td>
                        <td><center>Muhadatsah</center></td>
                        <td><center>Qowaid</center></td>
                        <td><center>Periode</center></td>
                        <td><center>Tanggal</center></td>
                        <td><center>Masehi</center></td>
                        <td><center>Hijriyah</center></td>
                        <td><center>Murid</center></td>
                        <td><center>Mengikuti</center></td>
                        <td><center>Dhomirnya</center></td>
                        <td><center>Jenis Kelamin</center></td>
                        <td><center>Nama Peserta</center></td>
                        <td><center>Nilai</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_arab']?></td>
                            <td><?= $peserta['t4_lahir_arab'].", ".tgl_masehi($peserta['tgl_lahir'])?></td>
                            <td><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                            <td></td>
                            <td><center><?= $peserta['nilai_mufrodat']?></center></td>
                            <td><center><?= $peserta['nilai_muhadatsah']?></center></td>
                            <td><center><?= $peserta['nilai_qowaid']?></center></td>
                            <td>
                                <?php
                                    if($kelas['program'] == "Full Time 1") echo "يوميّا كاملا 1 (فى تعليم القواعد والمحادثة)";
                                    elseif($kelas['program'] == "Full Time 2") echo "يوميّا كاملا 2 (فى تعليم القواعد والمحادثة)";
                                    elseif($kelas['program'] == "Full Time 3") echo "يوميّا كاملا 3 (فى تعليم القواعد والمحادثة)";
                                    else echo "يوميّا كاملا استعداديا (فى تعليم القواعد والمحادثة)";
                                ?>
                            </td>
                            <td>من<?= tgl_masehi($kelas['tgl_mulai'])."م - ".tgl_masehi($kelas['tgl_selesai'])."م"?></td>
                            <td><?= tgl_masehi($tgl_cetak)."م"?></td>
                            <td><?= tgl_hijriah($tgl_cetak)?></td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "للطالب";
                                    else echo "للطالبة";
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "اشترك";
                                    else echo "اشتركت";
                                ?>
                            </td>
                            <td>
                                <!-- tanyain ikhtibariha ikhtibarihi -->
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "وأن له حسب نتائج اختباره";
                                    else echo "وأن لها حسب نتائج اختبارها";
                                ?>
                            </td>
                            <td><?= $peserta['jk']?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= $peserta['nilai_sertifikat_indo']?></td>
                        </tr>
                    <?php endforeach;?> 
                <?php elseif($kelas['program'] == "Timur Tengah 1" || $kelas['program'] == "Timur Tengah 2") :?>
                    <tr>
                        <td colspan="19"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td><center>Nama</center></td>
                        <td><center>Tempat, Tanggal lahir</center></td>
                        <td><center>Alamat</center></td>
                        <td><center>Nilai</center></td>
                        <td><center>NIM</center></td>
                        <td><center>TOAFL</center></td>
                        <td><center>القواعد</center></td>
                        <td><center>القراءة</center></td>
                        <td><center>Periode</center></td>
                        <td><center>Tanggal</center></td>
                        <td><center>Masehi</center></td>
                        <td><center>Hijriyah</center></td>
                        <td><center>Murid</center></td>
                        <td><center>Mengikuti</center></td>
                        <td><center>Dhomirnya</center></td>
                        <td><center>Jenis Kelamin</center></td>
                        <td><center>Nama Peserta</center></td>
                        <td><center>Nilai</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_arab']?></td>
                            <td><?= $peserta['t4_lahir_arab'].", ".tgl_masehi($peserta['tgl_lahir'])?></td>
                            <td><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                            <td></td>
                            <td><center><?= $peserta['nilai_toafl']?></center></td>
                            <td><center><?= $peserta['nilai_qowaid']?></center></td>
                            <td><center><?= $peserta['nilai_qiroah']?></center></td>
                            <td>
                                <?php
                                    if($kelas['program'] == "Timur Tengah 1") echo "1 (الطريقة لقراءة الكتب بالسهولة)";
                                    elseif($kelas['program'] == "Timur Tengah 2") echo "2 (الطريقة لقراءة الكتب بالسهولة) ";
                                ?>
                            </td>
                            <td>من<?= tgl_masehi($kelas['tgl_mulai'])."م - ".tgl_masehi($kelas['tgl_selesai'])."م"?></td>
                            <td><?= tgl_masehi($tgl_cetak)."م"?></td>
                            <td><?= tgl_hijriah($tgl_cetak)?></td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "للطالب";
                                    else echo "للطالبة";
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "اشترك";
                                    else echo "اشتركت";
                                ?>
                            </td>
                            <td>
                                <!-- tanyain ikhtibariha ikhtibarihi -->
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "وأن له حسب نتائج اختباره";
                                    else echo "وأن لها حسب نتائج اختبارها";
                                ?>
                            </td>
                            <td><?= $peserta['jk']?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= $peserta['nilai_sertifikat_indo']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php elseif($kelas['program'] == "AlMiftah 1") :?>
                    <tr>
                        <td colspan="19"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td><center>Nama</center></td>
                        <td><center>Tempat, Tanggal lahir</center></td>
                        <td><center>Alamat</center></td>
                        <td><center>Nilai</center></td>
                        <td><center>NIM</center></td>
                        <td><center>بنايات الجملة</center></td>
                        <td><center>تراكيب</center></td>
                        <td><center></center></td>
                        <td><center>Periode</center></td>
                        <td><center>Tanggal</center></td>
                        <td><center>Masehi</center></td>
                        <td><center>Hijriyah</center></td>
                        <td><center>Murid</center></td>
                        <td><center>Mengikuti</center></td>
                        <td><center>Dhomirnya</center></td>
                        <td><center>Jenis Kelamin</center></td>
                        <td><center>Nama Peserta</center></td>
                        <td><center>Nilai</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_arab']?></td>
                            <td><?= $peserta['t4_lahir_arab'].", ".tgl_masehi($peserta['tgl_lahir'])?></td>
                            <td><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                            <td></td>
                            <td><center><?= $peserta['nilai_binayatuljumlah']?></center></td>
                            <td><center><?= $peserta['nilai_tarakib']?></center></td>
                            <td></td>
                            <td>فصل المفتاح 1 (فى تعليم النحو والصرف وقراءة الكتب)</td>
                            <td>من<?= tgl_masehi($kelas['tgl_mulai'])."م - ".tgl_masehi($kelas['tgl_selesai'])."م"?></td>
                            <td><?= tgl_masehi($tgl_cetak)."م"?></td>
                            <td><?= tgl_hijriah($tgl_cetak)?></td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "للطالب";
                                    else echo "للطالبة";
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "اشترك";
                                    else echo "اشتركت";
                                ?>
                            </td>
                            <td>
                                <!-- tanyain ikhtibariha ikhtibarihi -->
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "وأن له حسب نتائج اختباره";
                                    else echo "وأن لها حسب نتائج اختبارها";
                                ?>
                            </td>
                            <td><?= $peserta['jk']?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= $peserta['nilai_sertifikat_indo']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php elseif($kelas['program'] == "AlMiftah 2") :?>
                    <tr>
                        <td colspan="19"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td><center>Nama</center></td>
                        <td><center>Tempat, Tanggal lahir</center></td>
                        <td><center>Alamat</center></td>
                        <td><center>Nilai</center></td>
                        <td><center>NIM</center></td>
                        <td><center>Nadhom</center></td>
                        <td><center>Qiraah</center></td>
                        <td><center></center></td>
                        <td><center>Periode</center></td>
                        <td><center>Tanggal</center></td>
                        <td><center>Masehi</center></td>
                        <td><center>Hijriyah</center></td>
                        <td><center>Murid</center></td>
                        <td><center>Mengikuti</center></td>
                        <td><center>Dhomirnya</center></td>
                        <td><center>Jenis Kelamin</center></td>
                        <td><center>Nama Peserta</center></td>
                        <td><center>Nilai</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_arab']?></td>
                            <td><?= $peserta['t4_lahir_arab'].", ".tgl_masehi($peserta['tgl_lahir'])?></td>
                            <td><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                            <td></td>
                            <td><center><?= $peserta['nilai_tahfidzulandzhima']?></center></td>
                            <td><center><?= $peserta['nilai_qiroah']?></center></td>
                            <td></td>
                            <td>فصل المفتاح 2 (فى تعليم النحو والصرف وقراءة الكتب)</td>
                            <td>من<?= tgl_masehi($kelas['tgl_mulai'])."م - ".tgl_masehi($kelas['tgl_selesai'])."م"?></td>
                            <td><?= tgl_masehi($tgl_cetak)."م"?></td>
                            <td><?= tgl_hijriah($tgl_cetak)?></td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "للطالب";
                                    else echo "للطالبة";
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "اشترك";
                                    else echo "اشتركت";
                                ?>
                            </td>
                            <td>
                                <!-- tanyain ikhtibariha ikhtibarihi -->
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "وأن له حسب نتائج اختباره";
                                    else echo "وأن لها حسب نتائج اختبارها";
                                ?>
                            </td>
                            <td><?= $peserta['jk']?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= $peserta['nilai_sertifikat_indo']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php elseif($kelas['program'] == "Tamyiz 1&2") :?>
                    <tr>
                        <td colspan="19"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td><center>Nama</center></td>
                        <td><center>Tempat, Tanggal lahir</center></td>
                        <td><center>Alamat</center></td>
                        <td><center>Nilai</center></td>
                        <td><center>NIM</center></td>
                        <td><center>فهم القواعد</center></td>
                        <td><center>الترجمة</center></td>
                        <td><center>تطبيق التعليم</center></td>
                        <td><center>Periode</center></td>
                        <td><center>Tanggal</center></td>
                        <td><center>Masehi</center></td>
                        <td><center>Hijriyah</center></td>
                        <td><center>Murid</center></td>
                        <td><center>Mengikuti</center></td>
                        <td><center>Dhomirnya</center></td>
                        <td><center>Jenis Kelamin</center></td>
                        <td><center>Nama Peserta</center></td>
                        <td><center>Nilai</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_arab']?></td>
                            <td><?= $peserta['t4_lahir_arab'].", ".tgl_masehi($peserta['tgl_lahir'])?></td>
                            <td><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                            <td></td>
                            <td><center><?= $peserta['nilai_fahmulqowaid']?></center></td>
                            <td><center><?= $peserta['nilai_tarjamah']?></center></td>
                            <td><center><?= $peserta['nilai_tatbiquttalim']?></center></td>
                            <td>تمييز1 و 2 (فى تعليم القواعد وترجمة القرآن)</td>
                            <td>من<?= tgl_masehi($kelas['tgl_mulai'])."م - ".tgl_masehi($kelas['tgl_selesai'])."م"?></td>
                            <td><?= tgl_masehi($tgl_cetak)."م"?></td>
                            <td><?= tgl_hijriah($tgl_cetak)?></td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "للطالب";
                                    else echo "للطالبة";
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "اشترك";
                                    else echo "اشتركت";
                                ?>
                            </td>
                            <td>
                                <!-- tanyain ikhtibariha ikhtibarihi -->
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "وأن له حسب نتائج اختباره";
                                    else echo "وأن لها حسب نتائج اختبارها";
                                ?>
                            </td>
                            <td><?= $peserta['jk']?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= $peserta['nilai_sertifikat_indo']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php elseif($kelas['program'] == "Tamyiz 3&4") :?>
                    <tr>
                        <td colspan="19"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td><center>Nama</center></td>
                        <td><center>Tempat, Tanggal lahir</center></td>
                        <td><center>Alamat</center></td>
                        <td><center>Nilai</center></td>
                        <td><center>NIM</center></td>
                        <td><center>التركيب</center></td>
                        <td><center>الإعلا</center></td>
                        <td><center>الترجمة</center></td>
                        <td><center>Periode</center></td>
                        <td><center>Tanggal</center></td>
                        <td><center>Masehi</center></td>
                        <td><center>Hijriyah</center></td>
                        <td><center>Murid</center></td>
                        <td><center>Mengikuti</center></td>
                        <td><center>Dhomirnya</center></td>
                        <td><center>Jenis Kelamin</center></td>
                        <td><center>Nama Peserta</center></td>
                        <td><center>Nilai</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_arab']?></td>
                            <td><?= $peserta['t4_lahir_arab'].", ".tgl_masehi($peserta['tgl_lahir'])?></td>
                            <td><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                            <td></td>
                            <td><center><?= $peserta['nilai_tarkib']?></center></td>
                            <td><center><?= $peserta['nilai_ilal']?></center></td>
                            <td><center><?= $peserta['nilai_tarjamah']?></center></td>
                            <td>تمييز3 و 4 (فى تعليم القواعد وترجمة القرآن)</td>
                            <td>من<?= tgl_masehi($kelas['tgl_mulai'])."م - ".tgl_masehi($kelas['tgl_selesai'])."م"?></td>
                            <td><?= tgl_masehi($tgl_cetak)."م"?></td>
                            <td><?= tgl_hijriah($tgl_cetak)?></td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "للطالب";
                                    else echo "للطالبة";
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "اشترك";
                                    else echo "اشتركت";
                                ?>
                            </td>
                            <td>
                                <!-- tanyain ikhtibariha ikhtibarihi -->
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "وأن له حسب نتائج اختباره";
                                    else echo "وأن لها حسب نتائج اختبارها";
                                ?>
                            </td>
                            <td><?= $peserta['jk']?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= $peserta['nilai_sertifikat_indo']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php elseif($kelas['program'] == "Manhaji") :?>
                    <tr>
                        <td colspan="19"><center><?= $kelas['nama_kelas']?></center></td>
                    </tr>
                    <tr>
                        <td>No</td>
                        <td><center>Nama</center></td>
                        <td><center>Tempat, Tanggal lahir</center></td>
                        <td><center>Alamat</center></td>
                        <td><center>Nilai</center></td>
                        <td><center>NIM</center></td>
                        <td><center>العدد والمعدود</center></td>
                        <td><center>فهم القواعد </center></td>
                        <td><center></center></td>
                        <td><center>Periode</center></td>
                        <td><center>Tanggal</center></td>
                        <td><center>Masehi</center></td>
                        <td><center>Hijriyah</center></td>
                        <td><center>Murid</center></td>
                        <td><center>Mengikuti</center></td>
                        <td><center>Dhomirnya</center></td>
                        <td><center>Jenis Kelamin</center></td>
                        <td><center>Nama Peserta</center></td>
                        <td><center>Nilai</center></td>
                    </tr>
                    <?php foreach ($kelas['peserta'] as $i => $peserta) :?>
                        <tr>
                            <td><?= $i+1?></td>
                            <td><?= $peserta['nama_arab']?></td>
                            <td><?= $peserta['t4_lahir_arab'].", ".tgl_masehi($peserta['tgl_lahir'])?></td>
                            <td><?= $peserta['desa_kel_arab']."، ".$peserta['kec_arab']."، ".$peserta['kota_kab_arab'];?></td>
                            <td><center><?= $peserta['nilai_sertifikat']?></center></td>
                            <td></td>
                            <td><center><?= $peserta['nilai_fahmulqowaid']?></center></td>
                            <td><center><?= $peserta['nilai_adadmadud']?></center></td>
                            <td></td>
                            <td>منهجي (فى تعليم القواعد)</td>
                            <td>من<?= tgl_masehi($kelas['tgl_mulai'])."م - ".tgl_masehi($kelas['tgl_selesai'])."م"?></td>
                            <td><?= tgl_masehi($tgl_cetak)."م"?></td>
                            <td><?= tgl_hijriah($tgl_cetak)?></td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "للطالب";
                                    else echo "للطالبة";
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "اشترك";
                                    else echo "اشتركت";
                                ?>
                            </td>
                            <td>
                                <!-- tanyain ikhtibariha ikhtibarihi -->
                                <?php 
                                    if($peserta['jk'] == "Laki-Laki") echo "وأن له حسب نتائج اختباره";
                                    else echo "وأن لها حسب نتائج اختبارها";
                                ?>
                            </td>
                            <td><?= $peserta['jk']?></td>
                            <td><?= $peserta['nama_indo']?></td>
                            <td><?= $peserta['nilai_sertifikat_indo']?></td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </table>
            <br>
        <?php endforeach;?>
    </body>
</html>
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Syahadah extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
            redirect(base_url("login"));
        }
    }

    public function kelas($id_kelas){
        $peserta = $this->Main_model->get_all("kelas_peserta", ["MD5(id_kelas)" => $id_kelas]);
        $data['kelas'] = $this->Main_model->get_one("kelas", ["MD5(id_kelas)" => $id_kelas]);
        $data['kelas']['tgl_selesai_hijriah'] = $this->tgl_hijriah($data['kelas']['tgl_selesai']);
        $data['kelas']['tgl_mulai'] = $this->tgl_masehi($data['kelas']['tgl_mulai']);
        $data['kelas']['tgl_selesai'] = $this->tgl_masehi($data['kelas']['tgl_selesai']);
        foreach ($peserta as $i => $peserta) {
            $dataPeserta = $this->Main_model->get_one("peserta", ["id_peserta" => $peserta['id_peserta']]);
            $data['peserta'][$i] = $dataPeserta;
            $data['peserta'][$i]['syahadah'] = $peserta;
            $data['peserta'][$i]['syahadah']['nomor'] = $this->angka_arab($peserta['no_syahadah'])."/أز/".$this->angka_arab($peserta['tahun']);

            // $nilaiPeserta = $this->Main_model->get_all("nilai_peserta", ["id_peserta" => $peserta['id_peserta'], "id_kelas" => $peserta['id_kelas']]);
            if($data['kelas']['program'] == "Full Time 1" || $data['kelas']['program'] == "Full Time 2" || $data['kelas']['program'] == "Full Time 3"){
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Muhadatsah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_muhadatsah'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_muhadatsah'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_qowaid'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_qowaid'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Mufrodat", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_mufrodat'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_mufrodat'] = 0;
            }
        }

        var_dump($data);
    }

    public function peserta($id){
        $peserta = $this->Main_model->get_one("kelas_peserta", ["MD5(id)" => $id]);
        $data['peserta'] = $this->Main_model->get_one("peserta", ["id_peserta" => $peserta['id_peserta']]);
        $data['peserta']['syahadah'] = $peserta;
        $data['peserta']['syahadah']['nomor'] = $this->angka_arab($peserta['no_syahadah'])."/أز/".$this->angka_arab($peserta['tahun']);
        $data['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $peserta['id_kelas']]);
        $data['kelas']['tgl_selesai_hijriah'] = $this->tgl_hijriah($data['kelas']['tgl_selesai']);
        $data['kelas']['tgl_mulai'] = $this->tgl_masehi($data['kelas']['tgl_mulai']);
        $data['kelas']['tgl_selesai'] = $this->tgl_masehi($data['kelas']['tgl_selesai']);

        if($data['kelas']['program'] == "Full Time 1" || $data['kelas']['program'] == "Full Time 2" || $data['kelas']['program'] == "Full Time 3"){
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Muhadatsah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_muhadatsah'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_muhadatsah'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_qowaid'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_qowaid'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Mufrodat", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_mufrodat'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_mufrodat'] = 0;
        }
        
        var_dump($data);
    }

    public function tgl_masehi($tanggal)
    {
        
        $array_bulan=array("يناير","فبراير","مارس","أبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر");
                    
        $tanggalnya=$this->angka_arab(substr($tanggal,8,2));
        $bulannya=$array_bulan[ceil(substr($tanggal,5,2))-1];
        $tahunnya=$this->angka_arab(substr($tanggal,0,4));
        $tglsekarang=$tanggalnya." ".$bulannya." ".$tahunnya."م";

        return $tglsekarang;

    }

    public function makeInt($angka)
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

    public function tgl_hijriah($tanggal)
    {

        $array_bulan = array("محرم","صفر","ربيع الأول","ربيع الثاني","جمادى الأولى","جمادى الثانية","رجب","شعبان","رمضان","شوال","ذو القعدة","ذو الحجة");
                            
        $date = $this->makeInt(substr($tanggal,8,2));
        $month = $this->makeInt(substr($tanggal,5,2));
        $year = $this->makeInt(substr($tanggal,0,4));

        if (($year>1582)||(($year == "1582") && ($month > 10))||(($year == "1582") && ($month=="10")&&($date >14)))
        {
            $jd = $this->makeInt((1461*($year+4800+$this->makeInt(($month-14)/12)))/4)+
            $this->makeInt((367*($month-2-12*($this->makeInt(($month-14)/12))))/12)-
            $this->makeInt( (3*($this->makeInt(($year+4900+$this->makeInt(($month-14)/12))/100))) /4)+
            $date-32075; 
        } 
        else
        {
            $jd = 367*$year-$this->makeInt((7*($year+5001+$this->makeInt(($month-9)/7)))/4)+
            $this->makeInt((275*$month)/9)+$date+1729777;
        }

        $wd = $jd%7;
        $l = $jd-1948440+10632;
        $n=$this->makeInt(($l-1)/10631);
        $l=$l-10631*$n+354;
        $z=($this->makeInt((10985-$l)/5316))*($this->makeInt((50*$l)/17719))+($this->makeInt($l/5670))*($this->makeInt((43*$l)/15238));
        $l=$l-($this->makeInt((30-$z)/15))*($this->makeInt((17719*$z)/50))-($this->makeInt($z/16))*($this->makeInt((15238*$z)/43))+29;
        $m=$this->makeInt((24*$l)/709);
        $d=$this->angka_arab($l-$this->makeInt((709*$m)/24));
        $y=$this->angka_arab(30*$n+$z-30);

        $g = $m-1;
        $final = "$d $array_bulan[$g] ".$y."هـ";

        return $final;
    }

    public function angka_arab($data){
        $data = str_replace("0", "٠", $data);
        $data = str_replace("1", "١", $data);
        $data = str_replace("2", "٢", $data);
        $data = str_replace("3", "٣", $data);
        $data = str_replace("4", "٤", $data);
        $data = str_replace("5", "٥", $data);
        $data = str_replace("6", "٦", $data);
        $data = str_replace("7", "٧", $data);
        $data = str_replace("8", "٨", $data);
        $data = str_replace("9", "٩", $data);

        return $data;
    }
}

/* End of file Syahadah.php */

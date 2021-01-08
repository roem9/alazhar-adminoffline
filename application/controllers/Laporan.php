<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
    
    public function cetak_laporan()
    {
        $bulan = $this->input->post("bulan");
        $tahun = $this->input->post("tahun");
        
        $filename = "Laporan_Peserta_{$bulan}_{$tahun}";

        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');

        $kelas = $this->Main_model->get_all("kelas", ["MONTH(tgl_mulai)" => $bulan, "YEAR(tgl_mulai)" => $tahun], "program", "ASC");
        foreach ($kelas as $i => $kelas) {
            $data['kelas'][$i] = $kelas;
            
            $pelajaran = $this->Main_model->get_all("pelajaran_kelas", ["program" => $kelas['program']]);
            $data['kelas'][$i]['pelajaran'] = [];
            foreach ($pelajaran as $pelajaran) {
                $data['kelas'][$i]['pelajaran'][] = $pelajaran['pelajaran'];
            }

            $peserta = $this->Main_model->get_all("kelas_peserta", ["id_kelas" => $kelas['id_kelas']]);
            foreach ($peserta as $j => $peserta) {
                $dataPeserta = $this->Main_model->get_one("peserta", ["id_peserta" => $peserta['id_peserta']]);
                $data['kelas'][$i]['peserta'][$j] = $dataPeserta;
                if($kelas['program'] == "Full Time 1" || $kelas['program'] == "Full Time 2" || $kelas['program'] == "Full Time 3"){
                    $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Muhadatsah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                    if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_muhadatsah'] = $nilai['nilai'];
                    else $data['kelas'][$i]['peserta'][$j]['nilai_muhadatsah'] = 0;
                    $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                    if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] = $nilai['nilai'];
                    else $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] = 0;
                    $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Mufrodat", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                    if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_mufrodat'] = $nilai['nilai'];
                    else $data['kelas'][$i]['peserta'][$j]['nilai_mufrodat'] = 0;

                    $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_mufrodat'] + $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] + $data['kelas'][$i]['peserta'][$j]['nilai_muhadatsah']) / 3;


                    if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat'] = "ممتاز";
                    } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat'] = "جيد جدا";
                    } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat'] = "جيد";
                    } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat'] = "مقبول";
                    } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat'] = "ضعيف";
                    }
                }
                
                $data['kelas'][$i]['peserta'][$j]['no_syahadah'] = "no. ".$peserta['no_syahadah']."/".$peserta['tahun']."";

            }
        }

        $this->load->view("pages/laporan/cetak-laporan-peserta", $data);
        // var_dump($data);
    }

    // public function angka_arab($data){
    //     $western_arabic = array('0','1','2','3','4','5','6','7','8','9');
    //     $eastern_arabic = array('٠','١','٢','٣','٤','٥','٦','٧','٨','٩');

    //     $str = str_replace($western_arabic, $eastern_arabic, $data);

    //     return $str;
    // }

}

/* End of file Laporan.php */

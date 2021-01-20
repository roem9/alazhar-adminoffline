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

    public function index(){

    }
    
    public function cetak_laporan()
    {
        $jenis_laporan = $this->input->post("jenis_laporan");
        if($jenis_laporan == "Syahadah"){
            $data['tgl_cetak'] = $this->input->post("tgl_cetak");
            $bulan = $this->input->post("bulan");
            $tahun = $this->input->post("tahun");
            
            $filename = "Syahadah_Peserta_Periode_{$bulan}_{$tahun}";
    
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
    
            $mon = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            $data['filename'] = "Syahadah Peserta Periode ".$mon[$bulan-1]." ".$tahun;
    
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
                    if($kelas['program'] == "Full Time 1" || $kelas['program'] == "Full Time 2" || $kelas['program'] == "Full Time 3" || $kelas['program'] == "Usbuain"){
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
    
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
    
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
                    } else if($kelas['program'] == "Tamyiz 1&2") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Fahmul Qowaid", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarjamah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tathbiiqu Atta'liim", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tatbiquttalim'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tatbiquttalim'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] + $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] + $data['kelas'][$i]['peserta'][$j]['nilai_tatbiquttalim']) / 3;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "Tamyiz 3&4") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarkib", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tarkib'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tarkib'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "I'lal", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_ilal'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_ilal'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarjamah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_tarkib'] + $data['kelas'][$i]['peserta'][$j]['nilai_ilal'] + $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah']) / 3;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "AlMiftah 1") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Binaayatul Jumlah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_binayatuljumlah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_binayatuljumlah'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarakib", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tarakib'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tarakib'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_binayatuljumlah'] + $data['kelas'][$i]['peserta'][$j]['nilai_tarakib']) / 2;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "AlMiftah 2") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tahfidzul Andzhima", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tahfidzulandzhima'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tahfidzulandzhima'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qiroah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_tahfidzulandzhima'] + $data['kelas'][$i]['peserta'][$j]['nilai_qiroah']) / 2;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "Timur Tengah 1" || $kelas['program'] == "Timur Tengah 2") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qiroah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "TOAFL", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_toafl'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_toafl'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] + $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] + $data['kelas'][$i]['peserta'][$j]['nilai_toafl']) / 3;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "Manhaji") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Fahmul Qowaid", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Adad Ma'dud", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_adadmadud'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_adadmadud'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] + $data['kelas'][$i]['peserta'][$j]['nilai_adadmadud']) / 2;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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

                usort($data['kelas'][$i]['peserta'], function($a, $b) {
                    return $a['nama_indo'] <=> $b['nama_indo'];
                });
            }
    
            $this->load->view("pages/laporan/cetak-laporan-syahadah", $data);
        } elseif($jenis_laporan == "Laporan"){
            $bulan = $this->input->post("bulan");
            $tahun = $this->input->post("tahun");
            
            $filename = "Laporan_Peserta_Periode_{$bulan}_{$tahun}";
    
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
    
            $mon = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            $data['filename'] = "Laporan Peserta Periode ".$mon[$bulan-1]." ".$tahun;
    
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
                    if($kelas['program'] == "Full Time 1" || $kelas['program'] == "Full Time 2" || $kelas['program'] == "Full Time 3" || $kelas['program'] == "Usbuain"){
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
    
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
    
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
                    } else if($kelas['program'] == "Tamyiz 1&2") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Fahmul Qowaid", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarjamah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tathbiiqu Atta'liim", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tatbiquttalim'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tatbiquttalim'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] + $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] + $data['kelas'][$i]['peserta'][$j]['nilai_tatbiquttalim']) / 3;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "Tamyiz 3&4") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarkib", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tarkib'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tarkib'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "I'lal", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_ilal'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_ilal'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarjamah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_tarkib'] + $data['kelas'][$i]['peserta'][$j]['nilai_ilal'] + $data['kelas'][$i]['peserta'][$j]['nilai_tarjamah']) / 3;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "AlMiftah 1") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Binaayatul Jumlah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_binayatuljumlah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_binayatuljumlah'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarakib", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tarakib'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tarakib'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_binayatuljumlah'] + $data['kelas'][$i]['peserta'][$j]['nilai_tarakib']) / 2;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "AlMiftah 2") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tahfidzul Andzhima", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_tahfidzulandzhima'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_tahfidzulandzhima'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qiroah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_tahfidzulandzhima'] + $data['kelas'][$i]['peserta'][$j]['nilai_qiroah']) / 2;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "Timur Tengah 1" || $kelas['program'] == "Timur Tengah 2") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qiroah", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "TOAFL", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_toafl'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_toafl'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_qiroah'] + $data['kelas'][$i]['peserta'][$j]['nilai_qowaid'] + $data['kelas'][$i]['peserta'][$j]['nilai_toafl']) / 3;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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
                    } else if($kelas['program'] == "Manhaji") {
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Fahmul Qowaid", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] = 0;
                        $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Adad Ma'dud", "id_kelas" => $kelas['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                        if($nilai) $data['kelas'][$i]['peserta'][$j]['nilai_adadmadud'] = $nilai['nilai'];
                        else $data['kelas'][$i]['peserta'][$j]['nilai_adadmadud'] = 0;
                        
                        $nilai_sertifikat = ($data['kelas'][$i]['peserta'][$j]['nilai_fahmulqowaid'] + $data['kelas'][$i]['peserta'][$j]['nilai_adadmadud']) / 2;
            
                        $data['kelas'][$i]['peserta'][$j]['nilai_sertifikat_indo'] = $nilai_sertifikat;
                        
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

                usort($data['kelas'][$i]['peserta'], function($a, $b) {
                    return $a['nama_indo'] <=> $b['nama_indo'];
                });
            }
    
            $this->load->view("pages/laporan/cetak-laporan-peserta", $data);
        } elseif($jenis_laporan == "Absensi"){
            $bulan = $this->input->post("bulan");
            $tahun = $this->input->post("tahun");
            
            $filename = "Absensi_Peserta_Periode_{$bulan}_{$tahun}";
    
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
    
            $mon = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            
            $kelas = $this->Main_model->get_all("kelas", ["MONTH(tgl_mulai)" => $bulan, "YEAR(tgl_mulai)" => $tahun], "program", "ASC");
            foreach ($kelas as $i => $kelas) {
                $data['kelas'][$i] = $kelas;

                $peserta = $this->Main_model->get_all("kelas_peserta", ["id_kelas" => $kelas['id_kelas']]);
                foreach ($peserta as $j => $peserta) {
                    $dataPeserta = $this->Main_model->get_one("peserta", ["id_peserta" => $peserta['id_peserta']]);
                    $data['kelas'][$i]['peserta'][$j] = $dataPeserta;
                }

                usort($data['kelas'][$i]['peserta'], function($a, $b) {
                    return $a['nama_indo'] <=> $b['nama_indo'];
                });
            }
    
            $this->load->view("pages/laporan/cetak-absensi", $data);
        }
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

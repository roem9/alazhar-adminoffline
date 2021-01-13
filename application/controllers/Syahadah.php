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
        $peserta = $this->Main_model->get_all("kelas_peserta", ["MD5(id_kelas)" => $id_kelas, "no_syahadah != " => 0]);
        $data['kelas'] = $this->Main_model->get_one("kelas", ["MD5(id_kelas)" => $id_kelas]);
        $data['kelas']['tgl_selesai_hijriah'] = $this->tgl_hijriah($data['kelas']['tgl_selesai']);
        $data['kelas']['tgl_mulai'] = $this->tgl_masehi($data['kelas']['tgl_mulai']);
        $data['kelas']['tgl_selesai'] = $this->tgl_masehi($data['kelas']['tgl_selesai']);
        foreach ($peserta as $i => $peserta) {
            $dataPeserta = $this->Main_model->get_one("peserta", ["id_peserta" => $peserta['id_peserta']]);
            $data['peserta'][$i] = $dataPeserta;
            
            $data['peserta'][$i]['tgl_lahir'] = $this->tgl_masehi($data['peserta'][$i]['tgl_lahir']);

            $data['peserta'][$i]['syahadah'] = $peserta;
            $data['peserta'][$i]['syahadah']['nomor'] = $this->angka_arab($peserta['no_syahadah'])."/أز/".$this->angka_arab($peserta['tahun']);

            if($data['kelas']['program'] == "Full Time 1" || $data['kelas']['program'] == "Full Time 2" || $data['kelas']['program'] == "Full Time 3" || $data['kelas']['program'] == "Usbuain"){
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Muhadatsah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_muhadatsah'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_muhadatsah'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_qowaid'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_qowaid'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Mufrodat", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_mufrodat'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_mufrodat'] = 0;
                
                $nilai_sertifikat = ($this->angka_indo($data['peserta'][$i]['syahadah']['nilai_muhadatsah']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_qowaid']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_mufrodat'])) / 3;
    
                if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ممتاز";
                } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد جدا";
                } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد";
                } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                    $data['peserta'][$i]['syahadah']['nilai'] = "مقبول";
                } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ضعيف";
                }
            } else if($data['kelas']['program'] == "Tamyiz 1&2") {
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Fahmul Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_fahmulqowaid'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_fahmulqowaid'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarjamah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_tarjamah'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_tarjamah'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tathbiiqu Atta'liim", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_tatbiquttalim'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_tatbiquttalim'] = 0;
                
                $nilai_sertifikat = ($this->angka_indo($data['peserta'][$i]['syahadah']['nilai_fahmulqowaid']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_tarjamah']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_tatbiquttalim'])) / 3;
    
                if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ممتاز";
                } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد جدا";
                } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد";
                } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                    $data['peserta'][$i]['syahadah']['nilai'] = "مقبول";
                } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ضعيف";
                }
            } else if($data['kelas']['program'] == "Tamyiz 3&4") {
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarkib", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_tarkib'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_tarkib'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "I'lal", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_ilal'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_ilal'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarjamah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_tarjamah'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_tarjamah'] = 0;
                
                $nilai_sertifikat = ($this->angka_indo($data['peserta'][$i]['syahadah']['nilai_tarkib']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_ilal']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_tarjamah'])) / 3;
    
                if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ممتاز";
                } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد جدا";
                } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد";
                } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                    $data['peserta'][$i]['syahadah']['nilai'] = "مقبول";
                } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ضعيف";
                }
            } else if($data['kelas']['program'] == "AlMiftah 1") {
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Binaayatul Jumlah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_binayatuljumlah'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_binayatuljumlah'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarakib", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_tarakib'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_tarakib'] = 0;
                
                $nilai_sertifikat = ($this->angka_indo($data['peserta'][$i]['syahadah']['nilai_binayatuljumlah']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_tarakib'])) / 2;
    
                if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ممتاز";
                } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد جدا";
                } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد";
                } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                    $data['peserta'][$i]['syahadah']['nilai'] = "مقبول";
                } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ضعيف";
                }
            } else if($data['kelas']['program'] == "AlMiftah 2") {
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tahfidzul Andzhima", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_tahfidzulandzhima'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_tahfidzulandzhima'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qiroah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_qiroah'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_qiroah'] = 0;
                
                $nilai_sertifikat = ($this->angka_indo($data['peserta'][$i]['syahadah']['nilai_tahfidzulandzhima']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_qiroah'])) / 2;
    
                if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ممتاز";
                } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد جدا";
                } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد";
                } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                    $data['peserta'][$i]['syahadah']['nilai'] = "مقبول";
                } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ضعيف";
                }
            } else if($data['kelas']['program'] == "Timur Tengah 1" || $data['kelas']['program'] == "Timur Tengah 2") {
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qiroah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_qiroah'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_qiroah'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_qowaid'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_qowaid'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "TOAFL", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_toafl'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_toafl'] = 0;
                
                $nilai_sertifikat = ($this->angka_indo($data['peserta'][$i]['syahadah']['nilai_qiroah']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_qowaid']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_toafl'])) / 3;
    
                if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ممتاز";
                } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد جدا";
                } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد";
                } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                    $data['peserta'][$i]['syahadah']['nilai'] = "مقبول";
                } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ضعيف";
                }
            } else if($data['kelas']['program'] == "Manhaji") {
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Fahmul Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_fahmulqowaid'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_fahmulqowaid'] = 0;
                $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Adad Ma'dud", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
                if($nilai) $data['peserta'][$i]['syahadah']['nilai_adadmadud'] = $this->angka_arab($nilai['nilai']);
                else $data['peserta'][$i]['syahadah']['nilai_adadmadud'] = 0;
                
                $nilai_sertifikat = ($this->angka_indo($data['peserta'][$i]['syahadah']['nilai_fahmulqowaid']) + $this->angka_indo($data['peserta'][$i]['syahadah']['nilai_adadmadud'])) / 2;
    
                if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ممتاز";
                } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد جدا";
                } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                    $data['peserta'][$i]['syahadah']['nilai'] = "جيد";
                } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                    $data['peserta'][$i]['syahadah']['nilai'] = "مقبول";
                } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                    $data['peserta'][$i]['syahadah']['nilai'] = "ضعيف";
                }
            }
            
            // ss
            $program = $this->Main_model->get_one("program", ["program" => $peserta['program']]);
            $data['peserta'][$i]['syahadah']['program_arab'] = $program['program_arab'];
        }

        // $this->load->view("pages/syahadah/syahadah-kelas", $data);
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 330], 'orientation' => 'P', 'margin_left' => '0', 'margin_right' => '0', 'margin_top' => '0', 'margin_bottom' => '0', 'fontDir' => array_merge($fontDirs, [__DIR__ . '/assets/font',]),
        'fontdata' => $fontData + [
            'arab' => [
                'R' => 'trado.ttf',
                'useOTL' => 0xFF,
                'useKashida' => 75,
            ],
            'mcs' => [
                'R' => 'mcs.ttf',
                // mcs_erwah.ttf
                // 'useOTL' => 0xFF,
                'useKashida' => 75,
            ]
        ], 
        ]);

        $mpdf->allow_charset_conversion = true;
        
        $mpdf->text_input_as_HTML = true; //(default = false)

        foreach ($data['peserta'] as $i => $peserta) {
            // if($peserta['nama_indo'] == "Muhammad Rum"){
                $mpdf->AddPage();
                $print = $this->load->view("pages/syahadah/syahadah-peserta", ["peserta" => $peserta, "kelas" => $data['kelas']], TRUE);
                $mpdf->WriteHTML($print);
                $mpdf->AddPage();
                $print = $this->load->view("pages/syahadah/nilai", ["peserta" => $peserta, "kelas" => $data['kelas']], TRUE);
                $mpdf->WriteHTML($print);
            // }
        }
        $mpdf->Output();
    }

    public function peserta($id, $id_kelas){
        $peserta = $this->Main_model->get_one("kelas_peserta", ["MD5(id)" => $id, "MD5(id_kelas)" => $id_kelas]);
        $data['peserta'] = $this->Main_model->get_one("peserta", ["id_peserta" => $peserta['id_peserta']]);
        // ss
        $data['peserta']['tgl_lahir'] = $this->tgl_masehi($data['peserta']['tgl_lahir']);

        $data['peserta']['syahadah'] = $peserta;
        $data['peserta']['syahadah']['nomor'] = $this->angka_arab($peserta['no_syahadah'])."/أز/".$this->angka_arab($peserta['tahun']);
        $data['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $peserta['id_kelas']]);
        $data['kelas']['tgl_selesai_hijriah'] = $this->tgl_hijriah($data['kelas']['tgl_selesai']);
        $data['kelas']['tgl_mulai'] = $this->tgl_masehi($data['kelas']['tgl_mulai']);
        $data['kelas']['tgl_selesai'] = $this->tgl_masehi($data['kelas']['tgl_selesai']);

        if($data['kelas']['program'] == "Full Time 1" || $data['kelas']['program'] == "Full Time 2" || $data['kelas']['program'] == "Full Time 3" || $data['kelas']['program'] == "Usbuain"){
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Muhadatsah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_muhadatsah'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_muhadatsah'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_qowaid'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_qowaid'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Mufrodat", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_mufrodat'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_mufrodat'] = 0;
            
            $nilai_sertifikat = ($this->angka_indo($data['peserta']['syahadah']['nilai_muhadatsah']) + $this->angka_indo($data['peserta']['syahadah']['nilai_qowaid']) + $this->angka_indo($data['peserta']['syahadah']['nilai_mufrodat'])) / 3;

            if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                $data['peserta']['syahadah']['nilai'] = "ممتاز";
            } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                $data['peserta']['syahadah']['nilai'] = "جيد جدا";
            } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                $data['peserta']['syahadah']['nilai'] = "جيد";
            } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                $data['peserta']['syahadah']['nilai'] = "مقبول";
            } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                $data['peserta']['syahadah']['nilai'] = "ضعيف";
            }
        } else if($data['kelas']['program'] == "Tamyiz 1&2") {
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Fahmul Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_fahmulqowaid'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_fahmulqowaid'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarjamah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_tarjamah'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_tarjamah'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tathbiiqu Atta'liim", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_tatbiquttalim'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_tatbiquttalim'] = 0;
            
            $nilai_sertifikat = ($this->angka_indo($data['peserta']['syahadah']['nilai_fahmulqowaid']) + $this->angka_indo($data['peserta']['syahadah']['nilai_tarjamah']) + $this->angka_indo($data['peserta']['syahadah']['nilai_tatbiquttalim'])) / 3;

            if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                $data['peserta']['syahadah']['nilai'] = "ممتاز";
            } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                $data['peserta']['syahadah']['nilai'] = "جيد جدا";
            } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                $data['peserta']['syahadah']['nilai'] = "جيد";
            } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                $data['peserta']['syahadah']['nilai'] = "مقبول";
            } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                $data['peserta']['syahadah']['nilai'] = "ضعيف";
            }
        } else if($data['kelas']['program'] == "Tamyiz 3&4") {
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarkib", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_tarkib'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_tarkib'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "I'lal", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_ilal'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_ilal'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarjamah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_tarjamah'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_tarjamah'] = 0;
            
            $nilai_sertifikat = ($this->angka_indo($data['peserta']['syahadah']['nilai_tarkib']) + $this->angka_indo($data['peserta']['syahadah']['nilai_ilal']) + $this->angka_indo($data['peserta']['syahadah']['nilai_tarjamah'])) / 3;

            if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                $data['peserta']['syahadah']['nilai'] = "ممتاز";
            } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                $data['peserta']['syahadah']['nilai'] = "جيد جدا";
            } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                $data['peserta']['syahadah']['nilai'] = "جيد";
            } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                $data['peserta']['syahadah']['nilai'] = "مقبول";
            } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                $data['peserta']['syahadah']['nilai'] = "ضعيف";
            }
        } else if($data['kelas']['program'] == "AlMiftah 1") {
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Binaayatul Jumlah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_binayatuljumlah'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_binayatuljumlah'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tarakib", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_tarakib'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_tarakib'] = 0;
            
            $nilai_sertifikat = ($this->angka_indo($data['peserta']['syahadah']['nilai_binayatuljumlah']) + $this->angka_indo($data['peserta']['syahadah']['nilai_tarakib'])) / 2;

            if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                $data['peserta']['syahadah']['nilai'] = "ممتاز";
            } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                $data['peserta']['syahadah']['nilai'] = "جيد جدا";
            } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                $data['peserta']['syahadah']['nilai'] = "جيد";
            } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                $data['peserta']['syahadah']['nilai'] = "مقبول";
            } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                $data['peserta']['syahadah']['nilai'] = "ضعيف";
            }
        } else if($data['kelas']['program'] == "AlMiftah 2") {
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Tahfidzul Andzhima", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_tahfidzulandzhima'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_tahfidzulandzhima'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qiroah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_qiroah'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_qiroah'] = 0;
            
            $nilai_sertifikat = ($this->angka_indo($data['peserta']['syahadah']['nilai_tahfidzulandzhima']) + $this->angka_indo($data['peserta']['syahadah']['nilai_qiroah'])) / 2;

            if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                $data['peserta']['syahadah']['nilai'] = "ممتاز";
            } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                $data['peserta']['syahadah']['nilai'] = "جيد جدا";
            } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                $data['peserta']['syahadah']['nilai'] = "جيد";
            } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                $data['peserta']['syahadah']['nilai'] = "مقبول";
            } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                $data['peserta']['syahadah']['nilai'] = "ضعيف";
            }
        } else if($data['kelas']['program'] == "Timur Tengah 1" || $data['kelas']['program'] == "Timur Tengah 2") {
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qiroah", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_qiroah'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_qiroah'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_qowaid'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_qowaid'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "TOAFL", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_toafl'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_toafl'] = 0;
            
            $nilai_sertifikat = ($this->angka_indo($data['peserta']['syahadah']['nilai_qiroah']) + $this->angka_indo($data['peserta']['syahadah']['nilai_qowaid']) + $this->angka_indo($data['peserta']['syahadah']['nilai_toafl'])) / 3;

            if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                $data['peserta']['syahadah']['nilai'] = "ممتاز";
            } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                $data['peserta']['syahadah']['nilai'] = "جيد جدا";
            } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                $data['peserta']['syahadah']['nilai'] = "جيد";
            } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                $data['peserta']['syahadah']['nilai'] = "مقبول";
            } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                $data['peserta']['syahadah']['nilai'] = "ضعيف";
            }
        } else if($data['kelas']['program'] == "Manhaji") {
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Fahmul Qowaid", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_fahmulqowaid'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_fahmulqowaid'] = 0;
            $nilai = $this->Main_model->get_one("nilai_peserta", ["pelajaran" => "Adad Ma'dud", "id_kelas" => $data['kelas']['id_kelas'], "id_peserta" => $peserta['id_peserta']]);
            if($nilai) $data['peserta']['syahadah']['nilai_adadmadud'] = $this->angka_arab($nilai['nilai']);
            else $data['peserta']['syahadah']['nilai_adadmadud'] = 0;
            
            $nilai_sertifikat = ($this->angka_indo($data['peserta']['syahadah']['nilai_fahmulqowaid']) + $this->angka_indo($data['peserta']['syahadah']['nilai_adadmadud'])) / 2;

            if($nilai_sertifikat >= 90 && $nilai_sertifikat <= 100){
                $data['peserta']['syahadah']['nilai'] = "ممتاز";
            } else if($nilai_sertifikat >= 80 && $nilai_sertifikat < 90){
                $data['peserta']['syahadah']['nilai'] = "جيد جدا";
            } else if($nilai_sertifikat >= 70 && $nilai_sertifikat < 79){
                $data['peserta']['syahadah']['nilai'] = "جيد";
            } else if($nilai_sertifikat >= 60 && $nilai_sertifikat < 70){
                $data['peserta']['syahadah']['nilai'] = "مقبول";
            } else if($nilai_sertifikat >= 0 && $nilai_sertifikat < 60){
                $data['peserta']['syahadah']['nilai'] = "ضعيف";
            }
        }
        
        // ss
        $program = $this->Main_model->get_one("program", ["program" => $peserta['program']]);
        $data['peserta']['syahadah']['program_arab'] = $program['program_arab'];
        
        // var_dump($data);
        // $this->load->view("templates/header", $data);
        // $this->load->view("pages/syahadah/syahadah-peserta", $data);
        
        // echo json_encode($data);
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 330], 'orientation' => 'P', 'margin_left' => '0', 'margin_right' => '0', 'margin_top' => '0', 'margin_bottom' => '0', 'fontDir' => array_merge($fontDirs, [__DIR__ . '/assets/font',]),
        'fontdata' => $fontData + [
            'arab' => [
                'R' => 'trado.ttf',
                'useOTL' => 0xFF,
                'useKashida' => 75,
            ],
            'mcs' => [
                'R' => 'MCS-Erwah-S_U-normal..ttf',
                // mcs_erwah.ttf
                // 'useOTL' => 0xFF,
                // 'useKashida' => 75,
            ]
        ], 
        ]);

        $mpdf->allow_charset_conversion = true;
        
        $mpdf->text_input_as_HTML = true; //(default = false)

        $print = $this->load->view("pages/syahadah/syahadah-peserta", $data, TRUE);
        $mpdf->WriteHTML($print);
        $mpdf->AddPage();
        $print = $this->load->view("pages/syahadah/nilai", $data, TRUE);
        $mpdf->WriteHTML($print);
        $mpdf->Output();
    }

    public function tgl_masehi($tanggal)
    {
        
        $array_bulan=array("يناير","فبراير","مارس","أبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر");
                    
        $tanggalnya=$this->angka_arab(substr($tanggal,8,2));
        $bulannya=$array_bulan[ceil(substr($tanggal,5,2))-1];
        $tahunnya=$this->angka_arab(substr($tanggal,0,4));
        $tglsekarang=$tanggalnya." ".$bulannya." ".$tahunnya;

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
    
    public function angka_indo($data){
        $data = str_replace("٠", "0", $data);
        $data = str_replace("١", "1", $data);
        $data = str_replace("٢", "2", $data);
        $data = str_replace("٣", "3", $data);
        $data = str_replace("٤", "4", $data);
        $data = str_replace("٥", "5", $data);
        $data = str_replace("٦", "6", $data);
        $data = str_replace("٧", "7", $data);
        $data = str_replace("٨", "8", $data);
        $data = str_replace("٩", "9", $data);

        return $data;
    }
}

/* End of file Syahadah.php */

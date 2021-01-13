<?php
    class Peserta extends CI_CONTROLLER{
        public function __construct(){
            parent::__construct();
            $this->load->model('Peserta_model');
            $this->load->model('Wl_model');
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
            $data['title'] = 'List Peserta';
            $data['program'] = $this->Main_model->get_all("program", "", "program", "asc");
            $data['sidebar'] = "sidebarPeserta";

            // konfirm = 1 telah dikonfirmasi
            $data['konfirm'] = '1';

            $data['kelas'] = $this->Main_model->get_all("kelas", ["status" => "aktif"], "nama_kelas");

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('peserta/peserta', $data);
            $this->load->view('templates/footer');
        }
        
        public function konfirm(){
            $data['title'] = 'Konfirmasi Peserta';
            $data['program'] = $this->Main_model->get_all("program", "", "program", "asc");
            $data['sidebar'] = "sidebarKonfirmPeserta";
            
            // konfirm = 0 belum dikonfirmasi
            $data['konfirm'] = '0';

            $data['kelas'] = $this->Main_model->get_all("kelas", ["status" => "aktif"], "nama_kelas");

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('peserta/peserta-konfirm', $data);
            $this->load->view('templates/footer');
        }

        public function wl(){
            $data['title'] = 'Waiting List Peserta';
            $data['program'] = $this->Main_model->get_all("program", "", "program", "asc");
            
            // konfirm = 0 belum dikonfirmasi
            $data['konfirm'] = '0';

            $data['kelas'] = $this->Main_model->get_all("kelas", ["status" => "aktif"], "nama_kelas");

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('peserta/peserta-wl', $data);
            $this->load->view('templates/footer');
        }

        public function ajax_list($konfirm){
            $list = $this->Peserta_model->get_datatables("konfirm = $konfirm");
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $peserta) {
                $no++;
                $row = array();
                $row[] = '<center>'.$no.'</center>';
                $row[] = date("d-m-Y", strtotime($peserta->tgl_daftar));
                
                if($konfirm == 1) $row[] = $peserta->no_peserta;

                $row[] = $peserta->nama_indo;
                
                if($konfirm == 1){
                    $row[] = $this->Main_model->rupiah($peserta->pembayaran);
    
                    if($peserta->kaos == 1) $kaos = '<a href="javascript:void(0)" data-id="'.$peserta->id_peserta.'|'.$peserta->nama_indo.'|0|kaos" class="btn btn-sm btn-success mr-1 list"><i class="fa fa-tshirt"></i></a>';
                    else $kaos = '<a href="javascript:void(0)"  data-id="'.$peserta->id_peserta.'|'.$peserta->nama_indo.'|1|kaos" class="btn btn-sm btn-outline-success mr-1 list"><i class="fa fa-tshirt"></i></a>';
                    
                    if($peserta->pin == 1) $pin = '<a href="javascript:void(0)" data-id="'.$peserta->id_peserta.'|'.$peserta->nama_indo.'|0|pin" class="btn btn-sm btn-success mr-1 list"><i class="fa fa-universal-access"></i></a>';
                    else $pin = '<a href="javascript:void(0)"  data-id="'.$peserta->id_peserta.'|'.$peserta->nama_indo.'|1|pin" class="btn btn-sm btn-outline-success mr-1 list"><i class="fa fa-universal-access"></i></a>';
                    
                    if($peserta->tas == 1) $tas = '<a href="javascript:void(0)" data-id="'.$peserta->id_peserta.'|'.$peserta->nama_indo.'|0|tas" class="btn btn-sm btn-success mr-1 list"><i class="fa fa-shopping-bag"></i></a>';
                    else $tas = '<a href="javascript:void(0)"  data-id="'.$peserta->id_peserta.'|'.$peserta->nama_indo.'|1|tas" class="btn btn-sm btn-outline-success mr-1 list"><i class="fa fa-shopping-bag"></i></a>';
    
                    $row[] = '<center>'.$kaos.$pin.$tas.'</center>';
    
                    $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$peserta->id_peserta.'" class="btn btn-sm btn-outline-dark peserta">' . COUNT($this->Main_model->get_all("kelas_peserta", ["id_peserta" => $peserta->id_peserta, "id_kelas <>" => NULL])) . '</a></center>';
                    $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$peserta->id_peserta.'" class="btn btn-sm btn-outline-warning peserta">' . COUNT($this->Main_model->get_all("kelas_peserta", ["id_peserta" => $peserta->id_peserta, "id_kelas =" => NULL])) . '</a></center>';
                    $row[] = '<a href="#modalEdit" data-toggle="modal" data-id="'.$peserta->id_peserta.'" class="btn btn-sm btn-info detail">detail</a>';
                    $row[] = '<center><a href="#modalAdd" data-toggle="modal" data-id="'.$peserta->id_peserta.'" class="btn btn-sm btn-outline-secondary salin"><i class="fa fa-copy"></i></a></center>';
                } else {
                    $row[] = '<a href="#modalAdd" data-toggle="modal" data-id="'.$peserta->id_peserta.'" class="btn btn-sm btn-success konfirmasi">Konfirmasi</a>';
                }
    
                $data[] = $row;
            }
    
            $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Peserta_model->count_all("konfirm = $konfirm"),
                        "recordsFiltered" => $this->Peserta_model->count_filtered("konfirm = $konfirm"),
                        "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }

        public function wl_list(){
            $list = $this->Wl_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $peserta) {
                $no++;
                $row = array();
                $row[] = '<center>'.$no.'</center>';
                $row[] = $peserta->no_peserta;
                $row[] = $peserta->nama_indo;
                $row[] = $peserta->program;
                $row[] = date('d-M-Y', strtotime($peserta->periode));
                $row[] = '<a href="#modalAdd" data-toggle="modal" data-id="'.$peserta->id.'|'.$peserta->nama_indo.'|'.$peserta->program.'" class="btn btn-sm btn-info kelas">kelas</a>';
    
                $data[] = $row;
            }
    
            $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Wl_model->count_all(),
                        "recordsFiltered" => $this->Wl_model->count_filtered(),
                        "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }

        // get
            public function get_detail_peserta(){
                $id = $this->input->post("id");
                $data = $this->Main_model->get_one("peserta", ["id_peserta" => $id]);

                // kelas peserta 
                    $kelas = $this->Main_model->get_all("kelas_peserta", ["id_peserta" => $id, "id_kelas <>" => NULL], "id");
                    foreach ($kelas as $i => $kelas) {
                        $data['user'][$i] = $kelas;
                        $data['user'][$i]['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $kelas['id_kelas']]);
                    }
                // kelas peserta 
                
                // waiting list peserta 
                    $wl = $this->Main_model->get_all("kelas_peserta", ["id_peserta" => $id, "id_kelas =" => NULL], "id");
                    foreach ($wl as $i => $wl) {
                        $data['wl'][$i] = $wl;
                        $data['wl'][$i]['periode'] = date("d-M-Y", strtotime($wl['periode']));
                    }
                // waiting list peserta 
                echo json_encode($data);
            }

            public function get_kelas_peserta(){
                $id = $this->input->post("id");
                $kelas = $this->Main_model->get_all("kelas_peserta", ["id_peserta" => $id, "id_kelas <>" => NULL]);
                foreach ($kelas as $i => $kelas) {
                    $data['user'][$i] = $kelas;
                    $data['user'][$i]['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $kelas['id_kelas']]);
                }
                echo json_encode($data);
            }
        // get

        // edit
            public function edit_peserta(){
                $id_peserta = $this->input->post("id_peserta", TRUE);
                $data = [
                    'nik' => $this->input->post('nik'),
                    'nama_indo' => $this->input->post('nama_indo'),
                    'nama_arab' => $this->input->post('nama_arab'),
                    't4_lahir_indo' => $this->input->post('t4_lahir_indo'),
                    't4_lahir_arab' => $this->input->post('t4_lahir_arab'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'desa_kel_indo' => $this->input->post('desa_kel_indo'),
                    'desa_kel_arab' => $this->input->post('desa_kel_arab'),
                    'kec_indo' => $this->input->post('kec_indo'),
                    'kec_arab' => $this->input->post('kec_arab'),
                    'kota_kab_indo' => $this->input->post('kota_kab_indo'),
                    'kota_kab_arab' => $this->input->post('kota_kab_arab'),
                    'no_wa' => $this->input->post('no_wa'),
                    'pembayaran' => $this->Main_model->rupiah_to_int($this->input->post('pembayaran')),
                    'detail_pembayaran' => $this->input->post('detail_pembayaran'),
                    'email' => $this->input->post('email'),
                ];

                $this->Main_model->edit_data("peserta", ["id_peserta" => $id_peserta], $data);
                echo json_encode("1");
            }

            public function konfirmasi(){
                $id_peserta = $this->input->post("id_peserta", TRUE);
                $this->Main_model->edit_data("user", ["id_peserta" => $id_peserta], ["konfirm" => 1]);
                echo json_encode("1");
            }

            // list kaos, pin dan tas
            public function edit_list(){
                $id_peserta = $this->input->post("id_peserta");
                $list = $this->input->post("list");
                $this->Main_model->edit_data("peserta", ["id_peserta" => $id_peserta], [$list => 1]);
                echo 1;
            }

            public function add_buku(){
                $id = $this->input->post("id");
                $this->Main_model->edit_data("kelas_peserta", ["id" => $id], ["buku" => 1]);
                echo 1;
            }
        // edit

        // delete
            public function remove_kelas(){
                $kelas = $this->input->post("id");
                foreach ($kelas as $kelas) {
                    $this->Main_model->delete_data("kelas_peserta", ["id" => $kelas]);
                }
                echo json_encode("1");
            }

            public function delete_wl(){
                $id = $this->input->post("id");
                $data = $this->Main_model->get_one("kelas_peserta", ["id" => $id]);
                $this->Main_model->delete_data("kelas_peserta", ["id" => $id]);
                echo json_encode($data['id_peserta']);
            }

            public function delete_peserta(){
                $id = $this->input->post("id");
                $this->Main_model->edit_data("peserta", ["id_peserta" => $id], ["konfirm" => 2]);
                echo json_encode("1");
            }
        // delete

        // add
            public function add_kelas(){
                $id_kelas = $this->input->post("id_kelas", TRUE);
                $periode = $this->input->post("periode", TRUE);
                
                if($id_kelas == "") {
                    $id_kelas = NULL;
                    $tahun = "";
                } else {
                    $kelas = $this->Main_model->get_one("kelas", ["id_kelas" => $id_kelas]);
                    $tahun = date("Y", strtotime($kelas['tgl_selesai']));
                }

                $data = [
                    "id_kelas" => $id_kelas,
                    "id_peserta" => $this->input->post("id_peserta", TRUE),
                    "program" => $this->input->post("program", TRUE),
                    "tahun" => $tahun,
                    "periode" => $periode,
                ];

                $cek = $this->Main_model->get_one("kelas_peserta", $data);
                if($cek){
                    echo json_encode("0");
                } else {
                    $this->Main_model->add_data("kelas_peserta", $data);
                    echo json_encode("1");
                }
            }

            public function add_kelas_wl(){
                $id = $this->input->post("id");
                $id_kelas = $this->input->post("id_kelas");

                $this->Main_model->edit_data("kelas_peserta", ["id" => $id], ["id_kelas" => $id_kelas]);
                echo json_encode("1");
            }

            public function add_peserta(){
                $no_peserta = $this->username($this->input->post("tgl_daftar", TRUE));
                $data = [
                    'no_peserta' => $no_peserta,
                    'tgl_daftar' => $this->input->post('tgl_daftar'),
                    'nik' => $this->input->post('nik'),
                    'nama_indo' => $this->input->post('nama_indo'),
                    'nama_arab' => $this->input->post('nama_arab'),
                    't4_lahir_indo' => $this->input->post('t4_lahir_indo'),
                    't4_lahir_arab' => $this->input->post('t4_lahir_arab'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'desa_kel_indo' => $this->input->post('desa_kel_indo'),
                    'desa_kel_arab' => $this->input->post('desa_kel_arab'),
                    'kec_indo' => $this->input->post('kec_indo'),
                    'kec_arab' => $this->input->post('kec_arab'),
                    'kota_kab_indo' => $this->input->post('kota_kab_indo'),
                    'kota_kab_arab' => $this->input->post('kota_kab_arab'),
                    'no_wa' => $this->input->post('no_wa'),
                    'pembayaran' => $this->Main_model->rupiah_to_int($this->input->post('pembayaran')),
                    'detail_pembayaran' => $this->input->post('detail_pembayaran'),
                    'email' => $this->input->post('email'),
                    'konfirm' => 1,
                ];

                $id_peserta = $this->Main_model->add_data("peserta", $data);

                // if($this->input->post("program")){
                //     $program = $this->input->post("program");
                //     foreach ($program as $program) {
                //         $data = [
                //             "id_peserta" => $id_peserta,
                //             "program" => $program
                //         ];
    
                //         $this->Main_model->add_data("kelas_peserta", $data);
                //     }
                // }

                echo json_encode("1");
            }
            
            public function konfirm_peserta(){
                $no_peserta = $this->username($this->input->post("tgl_daftar", TRUE));
                $data = [
                    'no_peserta' => $no_peserta,
                    'tgl_daftar' => $this->input->post('tgl_daftar'),
                    'nik' => $this->input->post('nik'),
                    'nama_indo' => $this->input->post('nama_indo'),
                    'nama_arab' => $this->input->post('nama_arab'),
                    't4_lahir_indo' => $this->input->post('t4_lahir_indo'),
                    't4_lahir_arab' => $this->input->post('t4_lahir_arab'),
                    'tgl_lahir' => $this->input->post('tgl_lahir'),
                    'desa_kel_indo' => $this->input->post('desa_kel_indo'),
                    'desa_kel_arab' => $this->input->post('desa_kel_arab'),
                    'kec_indo' => $this->input->post('kec_indo'),
                    'kec_arab' => $this->input->post('kec_arab'),
                    'kota_kab_indo' => $this->input->post('kota_kab_indo'),
                    'kota_kab_arab' => $this->input->post('kota_kab_arab'),
                    'no_wa' => $this->input->post('no_wa'),
                    'pembayaran' => $this->Main_model->rupiah_to_int($this->input->post('pembayaran')),
                    'detail_pembayaran' => $this->input->post('detail_pembayaran'),
                    'email' => $this->input->post('email'),
                    'konfirm' => 1,
                ];

                $id_peserta = $this->input->post("id_peserta");
                $this->Main_model->edit_data("peserta", ["id_peserta" => $id_peserta], $data);

                // if($this->input->post("program")){
                //     $program = $this->input->post("program");
                //     foreach ($program as $program) {
                //         $data = [
                //             "id_peserta" => $id_peserta,
                //             "program" => $program
                //         ];
    
                //         $this->Main_model->add_data("kelas_peserta", $data);
                //     }
                // }

                echo json_encode("1");
            }

            public function buat_id(){
                $id = $this->input->post("id");
                $tgl = date("Y-m-d");
                $user = $this->username($tgl);
                $data = [
                    "username" => $user,
                    "tgl_masuk" => $tgl
                ];

                $this->Main_model->edit_data("user", ["id_peserta" => $id], $data);
                echo json_encode("1");
            }

            public function add_followup(){
                $id = $this->input->post("id");
                $followup = $this->input->post("followup");
                $data = $this->Main_model->get_one("user", ["id_peserta" => $id]);
                $this->Main_model->edit_data("user", ["id_peserta" => $id], ["followup" => $followup]);
                echo json_encode("1");
            }

            public function username($tgl){
                $username = $this->Main_model->get_username_terakhir($tgl);
                if($username){
                    $id = $username['id'] + 1;
                } else {
                    $id = 1;
                }

                if($id >= 1 && $id < 10){
                    $user = date('ym', strtotime($tgl))."000".$id;
                } else if($id >= 10 && $id < 100){
                    $user = date('ym', strtotime($tgl))."00".$id;
                } else if($id >= 100 && $id < 1000){
                    $user = date('ym', strtotime($tgl))."0".$id;
                } else {
                    $user = date('ym', strtotime($tgl)).$id;
                }
                return $user;
            }

    }
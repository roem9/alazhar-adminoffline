<?php
    class Civitas extends CI_CONTROLLER{
        public function __construct(){
            parent::__construct();
            $this->load->model('Civitas_model');
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
            $data['title'] = 'List Civitas';

            // $data['kelas'] = $this->Main_model->get_all("kelas", ["status" => "aktif"], "nama_kelas");

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('civitas/civitas', $data);
            $this->load->view('templates/footer');
        }

        public function ajax_list()
        {
            $list = $this->Civitas_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $civitas) {
                $no++;
                $row = array();
                $row[] = '<center>'.$no.'</center>';
                $row[] = $civitas->status;
                $row[] = $civitas->username;
                $row[] = $civitas->nama_civitas;
                $row[] = '<a href="#modalEdit" data-toggle="modal" data-id="'.$civitas->id_civitas.'" class="btn btn-sm btn-info detail">detail</a>';
                $row[] = '<center><a target="_blank" href="https://api.whatsapp.com/send?phone=62'.substr($civitas->no_hp, 1).'&text=Link%20:%20cekguru.mrscholae.com%0AUsername%20:%20'.$civitas->username.'%0APassword%20:%20'.date('dmY', strtotime($civitas->tgl_lahir)).'" class="btn btn-sm btn-success"><i class="fa fa-user-lock"></i></a></center>';

                $data[] = $row;
            }
    
            $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->Civitas_model->count_all(),
                        "recordsFiltered" => $this->Civitas_model->count_filtered(),
                        "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }

        // get
            public function get_detail_civitas(){
                $id = $this->input->post("id");
                $data = $this->Main_model->get_one("civitas", ["id_civitas" => $id]);
                echo json_encode($data);
            }

            public function get_kelas_peserta(){
                $id = $this->input->post("id");
                $kelas = $this->Main_model->get_all("kelas_user", ["id_user" => $id]);
                foreach ($kelas as $i => $kelas) {
                    $data['user'][$i] = $kelas;
                    $data['user'][$i]['kelas'] = $this->Main_model->get_one("kelas", ["id_kelas" => $kelas['id_kelas']]);
                }
                echo json_encode($data);
            }
        // get

        // edit
            public function edit_civitas(){
                $id = $this->input->post("id_civitas", TRUE);
                $data = [
                    "nama_civitas" => $this->input->post("nama_civitas", TRUE),
                    "t4_lahir" => $this->input->post("t4_lahir", TRUE),
                    "tgl_lahir" => $this->input->post("tgl_lahir", TRUE),
                    "alamat" => $this->input->post("alamat", TRUE),
                    "no_hp" => $this->input->post("no_hp", TRUE),
                ];

                $this->Main_model->edit_data("civitas", ["id_civitas" => $id], $data);
                echo json_encode("1");
            }
        // edit

        // delete
            public function remove_kelas(){
                $kelas = $this->input->post("id");
                foreach ($kelas as $kelas) {
                    $this->Main_model->delete_data("kelas_user", ["id" => $kelas]);
                }
                echo json_encode("1");
            }
        // delete

        // add
            public function add_kelas(){
                $data = [
                    "id_kelas" => $this->input->post("id_kelas", TRUE),
                    "id_user" => $this->input->post("id_user", TRUE)
                ];

                $cek = $this->Main_model->get_one("kelas_user", $data);
                if($cek){
                    echo json_encode("0");
                } else {
                    $this->Main_model->add_data("kelas_user", $data);
                    echo json_encode("1");
                }
                // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan kelas peserta<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                // redirect($_SERVER['HTTP_REFERER']);
            }

            public function add_civitas(){
                $user = $this->username($this->input->post("tgl_masuk", TRUE));
                $password = date('dmY', strtotime($this->input->post("tgl_lahir", TRUE)));
                $data = [
                    "status" => "aktif",
                    "username" => $user,
                    "nama_civitas" => $this->input->post("nama_civitas", TRUE),
                    "t4_lahir" => $this->input->post("t4_lahir", TRUE),
                    "tgl_lahir" => $this->input->post("tgl_lahir", TRUE),
                    "alamat" => $this->input->post("alamat", TRUE),
                    "no_hp" => $this->input->post("no_hp", TRUE),
                    "password" => MD5($password),
                    "tgl_masuk" => $this->input->post("tgl_masuk", TRUE)
                ];

                $this->Main_model->add_data("civitas", $data);
                echo json_encode("1");
            }

            public function username($tgl){
                $username = $this->Civitas_model->get_username_terakhir($tgl);
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
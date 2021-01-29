<?php
class Kelas extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Kelas_model');
        $this->load->model('Main_model');
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('login', 'Maaf, Anda harus login terlebih dahulu');
            redirect(base_url("login"));
        }
    }

    public function aktif(){
        $data['title'] = 'List Kelas Aktif';
        $data['program'] = $this->Main_model->get_all("program", "", "program", "asc");
        $data['status'] = "aktif";
        // $kelas = $this->Main_model->get_all("kelas", "", "tgl_mulai", "ASC");
        // $data['kelas'] = [];
        // foreach ($kelas as $i => $kelas) {
        //     $data['kelas'][$i] = $kelas;
        //     $data['kelas'][$i]['peserta'] = COUNT($this->Main_model->get_all("kelas_peserta", ["id_kelas" => $kelas['id_kelas']]));
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/kelas', $data);
        $this->load->view('templates/footer');
    }
    
    public function nonaktif(){
        $data['title'] = 'List Kelas Nonaktif';
        $data['program'] = $this->Main_model->get_all("program", "", "program", "asc");
        $data['status'] = "nonaktif";
        // $kelas = $this->Main_model->get_all("kelas", "", "tgl_mulai", "ASC");
        // $data['kelas'] = [];
        // foreach ($kelas as $i => $kelas) {
        //     $data['kelas'][$i] = $kelas;
        //     $data['kelas'][$i]['peserta'] = COUNT($this->Main_model->get_all("kelas_peserta", ["id_kelas" => $kelas['id_kelas']]));
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/kelas', $data);
        $this->load->view('templates/footer');
    }

    public function ajax_list($status){
        $list = $this->Kelas_model->get_datatables("status = '$status'");
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kelas) {
            $no++;
            $row = array();
            $row[] = '<center>'.$no.'</center>';
            if($kelas->status == "aktif") $row[] = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-success" data-id="'.$kelas->id_kelas.'|'.$kelas->nama_kelas.'|menonaktifkan" id="btnStatusKelas">aktif</a>';
            else $row[] = '<a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary" data-id="'.$kelas->id_kelas.'|'.$kelas->nama_kelas.'|mengaktifkan" id="btnStatusKelas">nonaktif</a>';
            $row[] = date("d-m-Y", strtotime($kelas->tgl_mulai));
            $row[] = date("d-m-Y", strtotime($kelas->tgl_cetak));
            $row[] = $kelas->nama_kelas;
            $row[] = $kelas->program;
            $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$kelas->id_kelas.'" class="btn btn-sm btn-outline-dark peserta">' . COUNT($this->Main_model->get_all("kelas_peserta", ["id_kelas" => $kelas->id_kelas])) . '</a></center>';
            $row[] = '<center><a href="#modalEdit" data-toggle="modal" data-id="'.$kelas->id_kelas.'" class="btn btn-sm btn-outline-warning wl">' . COUNT($this->Main_model->get_all("kelas_peserta", ["id_kelas" => null, "program" => $kelas->program])) . '</a></center>';
            $row[] = '<a href="#modalEdit" data-toggle="modal" data-id="'.$kelas->id_kelas.'" class="btn btn-sm btn-info detail">detail</a>';
            $row[] = '<center><a target="_blank" href="'.base_url().'syahadah/kelas/'.MD5($kelas->id_kelas).'" class="btn btn-sm btn-warning">cetak</a></center>';

            $data[] = $row;
        }

        $output = array(
                    "draw" => $_POST['draw'],
                    "recordsTotal" => $this->Kelas_model->count_all("status = '$status'"),
                    "recordsFiltered" => $this->Kelas_model->count_filtered("status = '$status'"),
                    "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    // get
        public function get_detail_kelas(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("kelas", ["id_kelas" => $id]);
            $peserta = $this->Main_model->get_all("kelas_peserta", ["id_kelas" => $id]);
            foreach ($peserta as $i => $peserta) {
                $data['peserta'][$i] = $this->Main_model->get_one("peserta", ["id_peserta" => $peserta['id_peserta']]);
                $data['peserta'][$i]['id'] = $peserta['id'];
                $data['peserta'][$i]['no_syahadah'] = $peserta['no_syahadah'];
                $data['peserta'][$i]['link'] = MD5($peserta['id'])."/".MD5($id);
            }

            $wl = $this->Main_model->get_all("kelas_peserta", ["id_kelas" => null, "program" => $data['program']], "periode", "ASC");
            foreach ($wl as $i => $wl) {
                $data['wl'][$i] = $this->Main_model->get_one("peserta", ["id_peserta" => $wl['id_peserta']]);
                $data['wl'][$i]['id'] = $wl['id'];
                $data['wl'][$i]['periode'] = date("d-M-Y", strtotime($wl['periode']));
            }
            
            $link = $this->Main_model->get_all("pelajaran_kelas", ["program" => $data['program']]);
            foreach ($link as $i => $link) {
                $data['link'][$i]['pelajaran'] = $link['pelajaran'];
                $data['link'][$i]['link'] = "https://peserta.alazharpare.com/nilai/input/".MD5($id)."/".MD5($link['pelajaran']);
            }

            echo json_encode($data);
        }

        public function get_kelas_aktif_program(){
            $program = $this->input->post("program");
            $kelas = $this->Main_model->get_all("kelas", ["program" => $program, "status" => "aktif"]);
            foreach ($kelas as $i => $kelas) {
                $data[$i] = $kelas;
                $peserta = COUNT($this->Main_model->get_all("kelas_peserta", ["id_kelas" => $kelas['id_kelas']]));
                $data[$i]['peserta'] = $peserta;
            }
            echo json_encode($data);
        }
    // get

    // edit
        public function edit_kelas(){
            $id = $this->input->post("id_kelas");
            $data = [
                "nama_kelas" => $this->input->post("nama_kelas"),
                "program" => $this->input->post("program"),
                "tgl_mulai" => $this->input->post("tgl_mulai"),
                "tgl_cetak" => $this->input->post("tgl_cetak"),
                "tgl_selesai" => $this->input->post("tgl_selesai"),
            ];
            $this->Main_model->edit_data("kelas", ["id_kelas" => $id], $data);
            echo json_encode("1");
        }

        public function list_pertemuan(){
            $id = $this->input->post("id_kelas");
            $pert = $this->input->post("pertemuan");
            
            // delete list
                $this->Main_model->delete_data("materi_kelas", ["id_kelas" => $id]);
            // delete list

            if($pert){
                foreach ($pert as $pert) {
                    $data = [
                        "materi" => $pert,
                        "id_kelas" => $id
                    ];
    
                    $this->Main_model->add_data("materi_kelas", $data);
                }
            }

            echo json_encode("1");
            // $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menyimpan data pertemuan kelas<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            // redirect($_SERVER['HTTP_REFERER']);
        }

        public function edit_status_kelas(){
            $id = $this->input->post("id");
            $data = $this->Main_model->get_one("kelas", ["id_kelas" => $id]);
            if($data['status'] == "aktif") $this->Main_model->edit_data("kelas", ["id_kelas" => $id], ["status" => "nonaktif"]);
            else $this->Main_model->edit_data("kelas", ["id_kelas" => $id], ["status" => "aktif"]);
            echo json_encode("1");
        }

        public function buat_syahadah(){
            $id = $this->input->post("id");
            
            $kelas = $this->Main_model->get_one("kelas_peserta", ["id" => $id]);
            $syahadah = $this->Main_model->get_no_syahadah_terakhir($kelas['tahun']);

            $no_syahadah = $syahadah['no_syahadah'] + 1;

            $this->Main_model->edit_data("kelas_peserta", ["id" => $id], ["no_syahadah" => $no_syahadah]);
            echo $kelas['id_kelas'];
        }

    // edit
    
    // add
        public function add_kelas(){
            $data = [
                "nama_kelas" => $this->input->post("nama_kelas"),
                "program" => $this->input->post("program"),
                "tgl_mulai" => $this->input->post("tgl_mulai"),
                "tgl_selesai" => $this->input->post("tgl_selesai"),
                "tgl_cetak" => $this->input->post("tgl_cetak"),
                "status" => "aktif",
            ];
            
            $this->Main_model->add_data("kelas", $data);
            echo json_encode("1");
        }
        
        // pindah dari waiting list ke kelas 
        public function add_kelas_wl(){
            $id = $this->input->post("id");
            $id_kelas = $this->input->post("id_kelas");

            $kelas = $this->Main_model->get_one("kelas", ["id_kelas" => $id_kelas]);

            $this->Main_model->edit_data("kelas_peserta", ["id" => $id], ["id_kelas" => $id_kelas, "tahun" => date("Y", strtotime($kelas['tgl_selesai']))]);
            echo $id_kelas;
        }
    // add

    // delete
        public function keluar_kelas(){
            $id = $this->input->post("id");

            $data = $this->Main_model->get_one("kelas_peserta", ["id" => $id]);
            $this->Main_model->edit_data("kelas_peserta", ["id" => $id], ["id_kelas" => null]);

            echo $data['id_kelas'];
        }

        public function delete_wl(){
            $id = $this->input->post("id");
            $id_kelas = $this->input->post("id_kelas");

            $data = $this->Main_model->get_one("kelas_peserta", ["id" => $id]);
            $this->Main_model->delete_data("kelas_peserta", ["id" => $id]);

            echo $id_kelas;
        }
}
<?php
class Login extends CI_CONTROLLER{
    public function __construct(){
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Main_model');
    }

    public function index(){
        $data['header'] = 'Login';
        $data['title'] = 'Login';

        $this->load->view("templates/header", $data);
        $this->load->view("login/login");
        $this->load->view("templates/footer");
    }

    public function cekLogin(){		
        $username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$where = array(
			'username' => $username,
            'password' => MD5($password)
        );

        $admin = $this->Main_model->get_one("admin", $where);

		if($admin){

			$data_session = array(
				'status' => "login"
            );
 
			$this->session->set_userdata($data_session);
            
            redirect(base_url('peserta/konfirm'));
 
		}else{
            $this->session->set_flashdata('login', 'Maaf, kombinasi username dan password salah');
			redirect(base_url("login"));
		}
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }
}
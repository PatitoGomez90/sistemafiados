<?php

class Clogin extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('mclientes');
        $this->load->model('musuario');
    } 

	public function index()
	{
		$data['mensaje'] = '';
		$this->load->view('vlogin', $data);
	}

	public function ingresar(){
		$usuario = $this->input->post('usuario');
		$password = $this->input->post('password');
		$res = $this->musuario->login($usuario, $password);
		if($res == 1){
			redirect('home');
		} else {
			$data['mensaje'] = 'Usuario o contraseña incorrecta';
			$this->load->view('vlogin', $data);
		}
		
	}

	public function logout() {
		$data['mensaje'] = '';
        $this->session->sess_destroy();
        redirect('clogin');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
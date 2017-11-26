<?php

class Home extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('mclientes');
        $this->load->model('mapuestas');
    } 

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->view('bienvenida');
		$this->load->view('layout/footer');
	}

	public function clientes(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->view('home');
		$this->load->view('layout/footer');
	}

	public function getClientes(){
		$agencia = $this->uri->segment(3);
		$clientes = $this->mclientes->getclientes($agencia);
		echo json_encode($clientes);
	}

	public function consultasaldo(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->view('consultarsaldo');
		$this->load->view('layout/footer');
	}

	public function addcliente(){
		$param['agencia'] = $this->input->post('agencia');
		$param['nombre'] = $this->input->post('nombre');
		$param['apellido'] = $this->input->post('apellido');
		$param['telefono'] = $this->input->post('telefono');

		$resultado = $this->mclientes->guardarcliente($param);
		if($resultado == 1){
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('home');
			$this->load->view('layout/footer');
		}
	}

	public function delete(){
		$id = $this->input->post('id');
		echo $this->mclientes->borrarcliente($id);
		
	}

	public function deleteapuesta(){
		$id = $this->input->post('id');
		echo $this->mapuestas->borrarapuestas($id);
	}

	public function editarcliente(){
		$param['id'] = $this->input->post('id');
		$param['nombre'] = $this->input->post('nombre');
		$param['apellido'] = $this->input->post('apellido');
		$param['telefono'] = $this->input->post('telefono');
		echo $this->mclientes->actualizarcliente($param);
	}

	public function sumarsaldos(){
		$id = $this->uri->segment(3);
		// $resultado = $this->mclientes->versaldocliente($id);
		// if ($resultado > 0){
			// $data['fecha'] = $resultado->fecha;
			// $data['pago'] = $resultado->pago;
			// $data['debe'] = $resultado->debe;
			$data['cliente'] = $id;
			$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('saldocliente', $data);
			$this->load->view('layout/footer');
		// }
	}

	public function apuestas(){
		$id = $this->input->post('id');
		$apuestas = $this->mapuestas->getApuestas($id);
		echo json_encode($apuestas);
	}

	public function saldo(){
		$id = $this->input->post('id');
		$saldo = $this->mapuestas->getSaldo($id);
		echo json_encode($saldo);
	}

	public function guardarapuesta(){
		// $id_ap = $this->input->post('id_ap');
		$id = $this->input->post('id');
		$fecha = $this->input->post('fecha');
		$jugo = $this->input->post('jugo');
		$pago = $this->input->post('pago');
		$resultado = $this->mapuestas->saveApuesta($id, $fecha, $jugo, $pago);
		echo $resultado;
	}

	public function borra_id_apuesta(){
		$id = $this->input->post('id');
		$resultado = $this->mapuestas->borraidapuesta($id);
		echo $resultado;
	}

	public function edita_id_apuesta(){
		$id_ap = $this->input->post('id_ap');
		$id_apuesta = $this->input->post('id_apuesta');
		$fecha = $this->input->post('fecha');
		$jugo = $this->input->post('jugo');
		$pago = $this->input->post('pago');
		$resultado = $this->mapuestas->editaidapuesta($id_ap, $id_apuesta, $fecha, $jugo, $pago);
		echo $resultado;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
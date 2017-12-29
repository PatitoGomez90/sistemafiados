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
		$this->load->view('home');
		$this->load->view('layout/footer');
	}

	public function verclientes(){
		$data['clientes'] = $this->mclientes->getAllClientes(); 
		$this->load->view('layout/header');
		$this->load->view('clientes', $data);
		$this->load->view('layout/footer');
	}

	public function getAllClientes(){
		$clientes = $this->mclientes->getAllClientes();
		echo json_encode($clientes);
	}

	public function getSaldoTotalAgencia(){
		$agencia = $this->input->post('agencia');
		$saldoTotal = $this->mclientes->getSaldoTotalAgencia($agencia);
		echo json_encode($saldoTotal);
	}

	public function getSaldoTodaslasAgencias(){
		$saldoTotal = $this->mclientes->getSaldoTodaslasAgencias();
		echo json_encode($saldoTotal);
	}

	public function getClientesByAgencia(){
		// $agencia = $this->input->post('agencia');
		$agencia = $this->uri->segment(3);
		$clientes = $this->mclientes->getClientesByAgencia($agencia);
		echo json_encode($clientes);
	}

	public function verapuestas($id, $agencia){
		$data['id'] = $id;
		$data['nombre'] = $this->mclientes->getNombreyApellido($id);
		$data['agencia'] = $agencia;
		$this->load->view('layout/header');
		$this->load->view('verapuestas', $data);
		$this->load->view('layout/footer');
	}

	public function getAllApuestas(){
		$id = $this->input->post('id');
		$data['apuestas'] = $this->mclientes->getAllApuestas($id);
		echo json_encode($data);
	}

	public function getApuestasByFecha(){
		$id = $this->input->post('id');
		$desde = $this->input->post('desde');
		$hasta = $this->input->post('hasta');
		$data['apuestas'] = $this->mclientes->getApuestasByFecha($id, $desde, $hasta);
		$data['primersaldo'] = $this->mclientes->getFirstSaldoByFecha($id, $desde);
		echo json_encode($data);
	}

	public function borrar_apuesta(){
		$id = $this->input->post('id');
		$res = $this->mclientes->borrar_apuesta($id);
		echo $res;
	}

	public function agregarcliente(){
		$param['agencia'] = $this->input->post('agencia');
		$param['nombre'] = $this->input->post('nombre');
		$param['apellido'] = $this->input->post('apellido');
		$param['telefono'] = $this->input->post('telefono');

		$resultado = $this->mclientes->agregarcliente($param);
		echo $resultado;
	}

	public function delete(){
		$id = $this->input->post('id');
		echo $this->mclientes->borrarcliente($id);
	}

	public function deleteapuesta(){
		$id = $this->input->post('id');
		echo $this->mapuestas->borrarapuestas($id);
	}

	public function guardarapuesta(){
		$id = $this->input->post('id');
		$fecha = $this->input->post('fecha');
		$jugo = $this->input->post('jugo');
		$pago = $this->input->post('pago');
		$agencia = $this->input->post('agencia');
		$resultado = $this->mapuestas->saveApuesta($id, $fecha, $jugo, $pago, $agencia);
		echo $resultado;
	}

	public function editarcliente(){
		$param['id'] = $this->input->post('id');
		$param['nombre'] = $this->input->post('nombre');
		$param['apellido'] = $this->input->post('apellido');
		$param['telefono'] = $this->input->post('telefono');
		echo $this->mclientes->actualizarcliente($param);
	}

	public function saveApuestaEditada(){
		$id = $this->input->post('id');
		$fecha = $this->input->post('fecha');
		$jugo = $this->input->post('jugo');
		$pago = $this->input->post('pago');
		$res = $this->mapuestas->editaidapuesta($id, $fecha, $jugo, $pago);
		echo $res;
	}

	// public function getFirstSaldo(){
	// 	$id = $this->input->post('id');
	// 	$primersaldo = $this->mclientes->getFirstSaldo($id);
	// 	echo json_encode($primersaldo);
	// }

	// public function getClientes(){
	// 	$agencia = $this->input->post('agencia');
	// 	if($agencia == 1){
	// 		$agencia = 'agencia1';
	// 	}
		
	// 	$clientes = $this->mclientes->getclientes($agencia);
	// 	echo json_encode($clientes);
		
	// }

	// public function getTodosClientes(){
	// 	$todoslosclientes = $this->mclientes->getallclientes();
	// 	echo json_encode($todoslosclientes);
	// }

	// public function consultasaldo(){
	// 	$this->load->view('layout/header');
	// 	$this->load->view('layout/menu');
	// 	$this->load->view('consultarsaldo');
	// 	$this->load->view('layout/footer');
	// }

	

	

	// public function deleteapuesta(){
	// 	$id = $this->input->post('id');
	// 	echo $this->mapuestas->borrarapuestas($id);
	// }

	

	// public function sumarsaldos(){
	// 	$id = $this->uri->segment(3);
	// 	// $resultado = $this->mclientes->versaldocliente($id);
	// 	// if ($resultado > 0){
	// 		// $data['fecha'] = $resultado->fecha;
	// 		// $data['pago'] = $resultado->pago;
	// 		// $data['debe'] = $resultado->debe;
	// 		$data['cliente'] = $id;
	// 		$this->load->view('layout/header');
	// 		$this->load->view('layout/menu');
	// 		$this->load->view('saldocliente', $data);
	// 		$this->load->view('layout/footer');
	// 	// }
	// }

	// public function apuestas(){
	// 	$id = $this->input->post('id');
	// 	$apuestas = $this->mapuestas->getApuestas($id);
	// 	echo json_encode($apuestas);
	// }

	// public function saldo(){
	// 	$id = $this->input->post('id');
	// 	$saldo = $this->mapuestas->getSaldo($id);
	// 	echo json_encode($saldo);
	// }

	

	// public function borra_id_apuesta(){
	// 	$id = $this->input->post('id');
	// 	$resultado = $this->mapuestas->borraidapuesta($id);
	// 	echo $resultado;
	// }

	// public function edita_id_apuesta(){
	// 	$id_ap = $this->input->post('id_ap');
	// 	$id_apuesta = $this->input->post('id_apuesta');
	// 	$fecha = $this->input->post('fecha');
	// 	$jugo = $this->input->post('jugo');
	// 	$pago = $this->input->post('pago');
	// 	$resultado = $this->mapuestas->editaidapuesta($id_ap, $id_apuesta, $fecha, $jugo, $pago);
	// 	echo $resultado;
	// }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
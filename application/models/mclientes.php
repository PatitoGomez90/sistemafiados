<?php 
class Mclientes extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function getAgencia($suc) {
        $db = $this->load->database($suc, true);
        return $db->get('clientes');
    }
    
    public function getClientes($agencia) {
        $s = $this->db->get_where('clientes', array('agencia' => $agencia));
        return $s->result();
    }

    public function guardarcliente($param){
        $campos = array(
            'agencia' => $param['agencia'],
            'nombre' => $param['nombre'],
            'apellido' => $param['apellido'],
            'telefono' => $param['telefono']
        );
        $this->db->insert('clientes', $campos);
        return 1;
    }

    public function borrarcliente($id){
        $this->db->where('id_cliente', $id);
        $this->db->delete('clientes');
        return 1;
    }

    public function actualizarcliente($param){
        $campos = array(
            'nombre' => $param['nombre'],
            'apellido' => $param['apellido'],
            'telefono' => $param['telefono']
        );
        $this->db->where('id_cliente',$param['id']);
        $this->db->update('clientes',$campos);
        
        return 1;
    }

    public function versaldocliente($id){
        $this->db->get('id_cliente', 'nombre', 'apellido', 'fecha', 'pago', 'debe');
        $this->db->where('id_cliente', $id);
        return $this->db->result();
    }
}  
?>
<?php 
class Mapuestas extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function getApuestas($id){
        $this->db->select('id_ap, id_apuesta, jugo, pago');
        $this->db->select('DATE_FORMAT(fecha, "%d-%m-%Y") AS fecha', FALSE);
        $this->db->where('id_apuesta', $id);
        $this->db->order_by("fecha", "asc");
        $s = $this->db->get('apuestas');
        return $s->result();
    }

    public function getSaldo($id){
        $this->db->select('SUM(jugo)-SUM(pago) as saldo');
        $s = $this->db->get_where('apuestas', array('id_apuesta' => $id));
        return $s->result();
    }

    public function saveApuesta($id, $fecha, $jugo, $pago, $agencia){
        $campos = array(
            'id_apuesta' => $id,
            'fecha' => $fecha,
            'jugo' => $jugo,
            'pago' => $pago,
            'agencia' => $agencia
        );
        $this->db->insert('apuestas', $campos);
        return 1;
    }

    public function borraidapuesta($id){
        $this->db->where('id_ap', $id);
        $this->db->delete('apuestas');
        return 1;
    }

    public function editaidapuesta($id_ap, $id_apuesta, $fecha, $jugo, $pago){
        $campos = array(
            'id_apuesta' => $id_apuesta,
            'fecha' => $fecha,
            'jugo' => $jugo,
            'pago' => $pago
        );
        $this->db->where('id_ap',$id_ap);
        $this->db->update('apuestas',$campos);
        return 1;
    }

    public function borrarapuestas($id){
        $this->db->where('id_apuesta', $id);
        $this->db->delete('apuestas');
        return 1;
    }
    // public function getAgencia($suc) {
    //     $db = $this->load->database($suc, true);
    //     return $db->get('clientes');
    // }
    
    // public function getClientes($agencia) {
    //     $s = $this->db->get_where('clientes', array('agencia' => $agencia));
    //     return $s->result();
    // }

    // public function guardarcliente($param){
    //     $campos = array(
    //         'agencia' => $param['agencia'],
    //         'nombre' => $param['nombre'],
    //         'apellido' => $param['apellido'],
    //         'telefono' => $param['telefono']
    //     );
    //     $this->db->insert('clientes', $campos);
    //     return 1;
    // }

    // public function borrarcliente($id){
    //     $this->db->where('id_cliente', $id);
    //     $this->db->delete('clientes');
    //     return 1;
    // }

    // public function actualizarcliente($param){
    //     $campos = array(
    //         'nombre' => $param['nombre'],
    //         'apellido' => $param['apellido'],
    //         'telefono' => $param['telefono']
    //     );
    //     $this->db->where('id_cliente',$param['id']);
    //     $this->db->update('clientes',$campos);
        
    //     return 1;
    // }

    // public function versaldocliente($id){
    //     $this->db->get('id_cliente', 'nombre', 'apellido', 'fecha', 'pago', 'debe');
    //     $this->db->where('id_cliente', $id);
    //     return $this->db->result();
    // }
}  
?>
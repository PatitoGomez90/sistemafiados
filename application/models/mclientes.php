<?php 
class Mclientes extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    public function getAllClientes(){
        $query = $this->db->query('SELECT id_cliente, nombre, apellido, telefono, agencia, ifnull((select sum(jugo) - sum(pago) from apuestas where id_apuesta = (select DISTINCT id_cliente)), "0") as saldo, (SELECT DATE_FORMAT(fecha, "%d-%m-%Y") FROM apuestas where id_apuesta = (select DISTINCT id_cliente) ORDER BY fecha DESC LIMIT 1) as ultimafecha FROM clientes order by agencia');
        return $query->result_array();
    }

    public function getClientesByAgencia($agencia){
        $query = $this->db->query('SELECT id_cliente, nombre, apellido, telefono, agencia, ifnull((select sum(jugo) - sum(pago) from apuestas where id_apuesta = (select DISTINCT id_cliente) and agencia = "'.$agencia.'"), "0") as saldo, (SELECT DATE_FORMAT(fecha, "%d-%m-%Y") FROM apuestas where id_apuesta = (select DISTINCT id_cliente) ORDER BY fecha DESC LIMIT 1) as ultimafecha FROM clientes where agencia = "'.$agencia.'"');
        return $query->result_array();
    }

    public function getAllApuestas($id){
        $query = $this->db->query('SELECT * FROM apuestas WHERE id_apuesta = '.$id.' order by fecha asc');
        return $query->result_array();
    }

    public function getFirstSaldo($id){
        $query = $this->db->query('SELECT sum(jugo) - sum(pago) AS saldo FROM apuestas WHERE id_apuesta = '.$id.' AND fecha = (select min(fecha) from apuestas where id_apuesta = '.$id.')');
        return $query->result_array();
    }

    public function getApuestasByFecha($id, $desde, $hasta){
        $query = $this->db->query('SELECT * FROM apuestas WHERE id_apuesta = '.$id.' AND fecha BETWEEN "'.$desde.'" and "'.$hasta.'"');
        return $query->result_array();
    }

    public function getFirstSaldoByFecha($id, $desde){
        $query = $this->db->query('SELECT IFNULL(SUM(jugo - pago), "0") AS saldo FROM apuestas WHERE id_apuesta = '.$id.' AND fecha < "'.$desde.'"');
        return $query->result_array();
    }

    public function getSaldoTotalAgencia($agencia){
        $query = $this->db->query('SELECT sum(jugo) - sum(pago) as saldoAgencia from apuestas where agencia = "'.$agencia.'"');
        return $query->result_array();
    }

    public function getSaldoTodaslasAgencias(){
        $query = $this->db->query('SELECT sum(jugo) - sum(pago) as saldoTotalAgencias from apuestas');
        return $query->result_array();
    }

    public function borrar_apuesta($id){
        $query = $this->db->query('DELETE FROM apuestas WHERE id_ap = '.$id);
        return 1;
    }

    public function agregarcliente($param){
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

    public function getNombreyApellido($id){
        $query = $this->db->query('SELECT nombre, apellido FROM clientes WHERE id_cliente = '.$id);
        return $query->result();
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

    // public function getAgencia($suc) {
    //     $db = $this->load->database($suc, true);
    //     return $db->get('clientes');
    // }
    
    // public function getClientes($agencia) {
    //     $s = $this->db->get_where('clientes', array('agencia' => $agencia));
    //     return $s->result();
    // }

    

    

    

    // public function versaldocliente($id){
    //     $this->db->get('id_cliente', 'nombre', 'apellido', 'fecha', 'pago', 'debe');
    //     $this->db->where('id_cliente', $id);
    //     return $this->db->result();
    // }
}  
?>
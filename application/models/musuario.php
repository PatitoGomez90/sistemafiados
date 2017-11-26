<?php 
class Musuario extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    public function login($usuario, $password) {
        $this->db->select('nombre, apellido');
        $this->db->from('usuarios');
        $this->db->where('usuario', $usuario);
        $this->db->where('password', $password);
        $resultado = $this->db->get();
        if ($resultado->num_rows == 1){
            $r = $resultado->row();
            $s_usuario = array(
                's_nombreUsuario' => $r->nombre.' '.$r->apellido
            );

            $this->session->set_userdata($s_usuario);
            return 1;
        } else {
            return 0;
        }
    }
}  
?>
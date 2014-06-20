<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Autenticacion_Model extends CI_Model {
    
    public function __construct(){
      parent::__construct();
      $this->load->database();
  }
 
  public function verificaUsuario($usuario, $contrasena){
    // creamos la select
    // SELECT `usuario`, `contrasena`
    // WHERE `usuario` = $usuario AND
    // `contrasena` = $contrasena
    // FROM `usuarios`
    // LIMIT 1
    $this->db->select('usuario');
    $this->db->where('usuario', $usuario);
    $this->db->where('contraseña', $contrasena);
    $this->db->limit(1);
    $query = $this->db->get('usuarios');

    // si el resultado de la query es positivo
    if ($query->num_rows() > 0){
      // devolvemos TRUE
      return TRUE;
    // si el resultado de la query no es positivo
    } else {
      // devolvemos FALSE
      return FALSE;
    }
  }

  public function tipoUsuario($usuario, $contrasena){
    // creamos la select
    // SELECT `usuario`, `contrasena`
    // WHERE `usuario` = $usuario AND
    // `contrasena` = $contrasena
    // FROM `usuarios`
    // LIMIT 1
    $this->db->select('tipo');
    $this->db->where('usuario', $usuario);
    $this->db->where('contraseña', $contrasena);
    $this->db->limit(1);
    $query = $this->db->get('usuarios');
    if($query -> num_rows() == 1)
     {
       return $query->result();
      
      }
     else
          {
       return "no develve";
         }
    // si el resultado de la query es positivo
       // devolvemos TRUE
      
    // si el resultado de la query no es positivo
  }
 
}
?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Estudiante extends CI_Model {
    
    public function __construct(){
      parent::__construct();
      $this->load->database();
  }
 
  public function guardar($datos){

    $this->db->insert('tblestudiantes', array('nombre1' =>$datos['pnombre'],
     'nombre2' =>$datos['snombre'],
      'apellido1' =>$datos['papellido'],
    'apellido2' =>$datos['sapellido'],
    'documento' =>$datos['documentoi'],
    'tipo' =>$datos['tip'],
    'direccion' =>$datos['direccionv'],
     'barrio' =>$datos['barriov'],
    'telefono' =>$datos['telefonov'],
    'fecha_nacimiento' =>$datos['fecha'],
    'lugar_nacimiento' =>$datos['lnacimiento'],
    'instituciones' =>$datos['institucion'],
    'municipio' =>$datos['municipiov'],
    'grupo_sanguineo' => $datos['gsangre'],
     'nro_hermanos' =>$datos['numerohom'],
     'nro_hermanas' =>$datos['numeromuj'] ));
  }

    public function consulta($documento){
      
    $this->db->select('documento');
    $this->db->where('documento', $documento);
    $this->db->limit(1);
    $query = $this->db->get('tblestudiantes');
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

  public function calendario()
  {
     $requete = "SELECT * FROM evenement ORDER BY id";


    $this->db->select();
    $query = $this->db->get('eventos');


 // sending the encoded result to success page
 echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    

}
?>
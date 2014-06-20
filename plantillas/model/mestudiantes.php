<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Mestudiantes extends CI_Model {
 
  	public function __construct(){
  		parent::__construct();
	}

	/**
	* verifica loguin y retorna datos del user, privilegios y branch
	* @author Josh
	* @return Array
	*
	*/
	public function listarestudiantes($data)
	{
		$res=$data." le gusta la nalga";
		return $res;
	}

	public function login($data)
	{
		

		$this->database->select('login');
		$query = $this->db->get('usuarios');
	
		return $query;
	}


 } 
 /* End of file muser.php */
 /*  */

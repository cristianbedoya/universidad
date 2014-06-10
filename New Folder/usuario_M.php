<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuario_M extends CI_Model 	
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
		 $this->load->database();
	
	}
    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_NAME = 'tblusuario';

    const TABLA_USUARIOD='tblusuario_datos';

    /**
     * @name string PRI_INDEX Holds the name of the tables' primary index used in this model
     */
    const PRI_INDEX = 'cod_usuario';

    /**
     * Retrieves record(s) from the database
     *
     * @param mixed $where Optional. Retrieves only the records matching given criteria, or all records if not given.
     *                      If associative array is given, it should fit field_name=>value pattern.
     *                      If string, value will be used to match against PRI_INDEX
     * @return mixed Single record if ID is given, or array of results
     */
    public function get($where = NULL) {
        $this->db->select('*');
        $this->db->from(self::TABLE_NAME);
        if ($where !== NULL) {
            if (is_array($where)) {
                foreach ($where as $field=>$value) {
                    $this->db->where($field, $value);
                }
            } else {
                $this->db->where(self::PRI_INDEX, $where);
            }
        }
        $result = $this->db->get()->result();
        if ($result) {
            if ($where !== NULL) {
                return array_shift($result);
            } else {
                return $result;
            }
        } else {
            return false;
        }
    }

    /**
     * Inserts new data into database
     *
     * @param Array $data Associative array with field_name=>value pattern to be inserted into database
     * @return mixed Inserted row ID, or false if error occured
     */
    public function insert(Array $data) {
  		$datauser
        if ($this->db->insert(self::TABLA_USUARIOD, $data)) {
          $res=$this->db->insert_id();
        	if ($res)
        	{
        		
        		   $datauser= array('cod_perfil' => '1',
        					'correo' => $data['correo'],
        					'usuario' => $data['usuario'],
        					'Pass' => $data['pass']);
        		 echo var_dump($datauser);
        		if ($this->db->insert(self::TABLE_NAME, $datauser)) {
        			$res=$this->db->insert_id();
        		}         		
        	} 
        	
        } else {
            return false;
        }
    }

    /**
     * Updates selected record in the database
     *
     * @param Array $data Associative array field_name=>value to be updated
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of affected rows by the update query
     */
    public function update(Array $data, $where = array()) {
            if (!is_array($where)) {
                $where = array(self::PRI_INDEX => $where);
            }
        $this->db->update(self::TABLE_NAME, $data, $where);
        return $this->db->affected_rows();
    }

    /**
     * Deletes specified record from the database
     *
     * @param Array $where Optional. Associative array field_name=>value, for where condition. If specified, $id is not used
     * @return int Number of rows affected by the delete query
     */
    public function delete($where = array()) {
        if (!is_array($where)) {
            $where = array(self::PRI_INDEX => $where);
        }
        $this->db->delete(self::TABLE_NAME, $where);
        return $this->db->affected_rows();
    }


	public function ValidarUsuario($user,$password){			//	Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
		$query = $this->db->where('usuario',$user);	//	La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
		$query = $this->db->where('Pass',$password);
		$query = $this->db->get('tblusuario');
		return $query->row(); 	//	Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
	}

	public function ValidarNuevoU($user,$correo){			//	Consulta Mysql para buscar en la tabla Usuario aquellos usuarios que coincidan con el mail y password ingresados en pantalla de login
		$query = $this->db->where('usuario',$user);	//	La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
		$query = $this->db->where('correo',$correo);
		$query = $this->db->where('',$correo);
		$query = $this->db->get(TABLA_USUARIOD,'');
		return $query->row(); 	//	Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
	}
}

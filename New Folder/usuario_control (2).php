<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuario_control extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario_M');
        $this->load->helper('form');
        $this->load->library('form_validation');
        //$this->load->library('session');
        $this->load->view('login');
	}

	public function index()
	{
	}

	public function validar()
	{
		if(!isset($_POST['user'])){	//	Si no recibimos ningún valor proveniente del formulario, significa que el usuario recién ingresa.	
			$this->load->view('login');		//	Por lo tanto le presentamos la pantalla del formulario de ingreso.
		}
		else{								//	Si el usuario ya pasó por la pantalla inicial y presionó el botón "Ingresar"
			//$this->form_validation->set_rules('maillogin','e-mail','required|valid_email');		//	Configuramos las validaciones ayudandonos con la librería form_validation del Framework Codeigniter
			$this->form_validation->set_rules('pass','password','required');
			if(($this->form_validation->run()==FALSE)){				//	Verificamos si el usuario superó la validación
				$this->load->view('login');		
			}
			else{													//	Si ambos campos fueron correctamente rellanados por el usuario,
				$this->load->model('usuario_M');
				$ExisteUsuarioyPassoword = $this->usuario_M->ValidarUsuario($_POST['user'],$_POST['pass']);	//	comprobamos que el usuario exista en la base de datos y la password ingresada sea correcta
				if($ExisteUsuarioyPassoword){	// La variable $ExisteUsuarioyPassoword recibe valor TRUE si el usuario existe y FALSE en caso que no. Este valor lo determina el modelo.
					$this->load->view('bien');
					echo "Validacion Ok<br><br><a href=''>Volver</a>";	//	Si el usuario ingresó datos de acceso válido, imprimos un mensaje de validación exitosa en pantalla
				}
				else{	//	Si no logró validar
					$data['error']="user o password incorrecta, por favor vuelva a intentar";
					$this->load->view('login',$data);	//	Lo regresamos a la pantalla de login y pasamos como parámetro el mensaje de error a presentar en pantalla
				}
			}
		}
	}
	public function insertar()
	{

	$datos=array(
		'cedula' => $_POST['cedula'],
		'nombre1' => $_POST['nombre1'],
		'nombre2' => $_POST['nombre2'],
		'apellido1' => $_POST['apellido1'],
		'apellido2' => $_POST['apellido2'],
		'telefono' => $_POST['telefono'],
		'direccion' => $_POST['direccion'],
		'correo' => $_POST['correo']);
		

	if (!isset($datos)) {
			$this->load->view('login');
	} else {
				//echo var_dump($datos);
			$res=$this->usuario_M->ValidarNuevoUsuario($_POST['usuario'],$_POST['correo'],$_POST['cedula']);
			if ($res) {
			
			
			
			$respuesta=$this->usuario_M->insertardatos($datos);

			if ($respuesta>0) {
				$datosuser = array('cod_usuario'=> $respuesta,
									'correo' => $_POST['correo'],
									'usuario' => $_POST['usuario'],
									'pass' => $_POST['pass']);
			$respuesta=$this->usuario_M->insertaruser($datosuser);

			}



			$this->load->view('bien');	
			if ($respuesta) {
			echo "Validacion Ok<br><br><a href=''>Volver</a>";		# code...
			} else {
			echo "NO SE Encontraron<br><br><a href=''>Volver</a>";		# code...
			}
			} 
			else
			{
			echo "ya existe";
			}
	}
	

	}
	public function eliminar()
	{
		if(!isset($_POST['usuarioid']))
		{		
			$this->load->view('login');		
		}
		else
		{
			$datos = array(
		    'cod_usuario' => $_POST['usuarioid'],
			);

			$respuesta=$this->usuario_M->delete($datos);

			$this->load->view('bien');	
			if ($respuesta) {
			echo "Validacion Ok<br><br><a href=''>Volver</a>";		# code...
			} else {
			echo "NO SE Encontraron<br><br><a href=''>Volver</a>";		# code...
			}			
		}       
		# code...
	}


	
}

/* End of file  */
/* Location: ./application/controllers/ */
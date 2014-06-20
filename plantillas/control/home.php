<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct()
    {
       parent::__construct();

       $this->load->helper('mihelper');
       $this->load->helper('form');
       
    }

    public function _remap($method,$data_url)
	{
		
		if($this->session->userdata("user")=="admin")
		{
			
			if($method=="index")
			{
				redirect(base_url("admin/inicio"));
			}
			$this->$method();
		}else
		if($this->session->userdata("user")=="profesor")
		{
		
			if($method=="index")
			{
				redirect(base_url("docente/inicio"));
			}
			$this->$method();

		}else
		{
			if($method=="login2")
			{
				$this->login2();
			}
			$this->index();
		}

	}

	public function index()
	{
		//$vista="calendario_view";
		
		$vista="template/contenido";
		$this->template->Render($vista);
		//$datos["nombre"]="alpiste";
		//$datos["apellido"]="peson";
		//$this->template->Render($vista,$datos);
		
	}



	public function close($datos)
	{

		$this->session->set_userdata("user","");
		redirect(base_url("home"));
		
	}




	 function login2()
    {

   			
 // si se ha enviado el formulario
    if ($this->input->post('username')){
      // recogemos las variables 'usuario' y 'contrasena'
      $usuario = $this->input->post('username');
      $contrasena = $this->input->post('password');
      // cargamos el modelo para verificar el usuario/contraseña
      $this->load->model('Autenticacion_Model');
      // si el usuario y contraseña son correctos
      if ($this->Autenticacion_Model->verificaUsuario($usuario, $contrasena)){

      	$res=$this->Autenticacion_Model->tipoUsuario($usuario, $contrasena);

      	   
			   
	   if($res[0]->tipo =='Administrador')
     	{
		      	
		$this->session->set_userdata("user","admin");
		redirect(base_url("home"));
	   	}
      	
		if($res[0]->tipo=='Docente')
      	{      	
      	
		$this->session->set_userdata("user","profesor");
		redirect(base_url("home"));
      	}		
      } else {
      	$this->load->view('mal');
        
        // si el usuario y contraseña son incorrectos
        //$this->session->set_flashdata('error', 'El usuario o contraseña son incorrectos.');
      }
    } else {
      // cargamos el formulario de login
    	//$vista="template/contenido";
    	//redirect($vista, 'refresh');
    	$vista="template/contenido";

		$this->template->Render($vista,$datos);
      //$this->load->view('autenticacion/form_login');
    }
      		
            //$this->load->view('template/contenido');
       // }
       // else
       // {
         //   $this->load->view('bien');
       // }

    }

    public function consulta()
    {
    	 if ($this->input->post('documento')){
      // recogemos las variables 'usuario' y 'contrasena'
      $documento = $this->input->post('documento');
      // cargamos el modelo para verificar el usuario/contraseña
      $this->load->model('Estudiante');
      // si el usuario y contraseña son correctos
      if ($this->Estudiante->consulta($documento)){

      $this->load->view('bien');
           }
      else
      {
      $this->load->view('mal');
      } 
    }
    }

    public function gestudiante()
	{
		$datos = array(
			'pnombre' => $this->input->post('pnombre'),
			'snombre' => $this->input->post('snombre'),
			'papellido' => $this->input->post('papellido'),
			'sapellido' => $this->input->post('sapellido'),
			'fecha' => $this->input->post('fecha'),
			'lnacimiento' => $this->input->post('lnacimiento'),
			'documentoi' => $this->input->post('documento'),
			'tip' => "CC",//$this->input->post('tip'),
			'gsangre' => "A",//$this->input->post('gsangre'),
			'institucion' => $this->input->post('institucion'),
			'municipiov' => $this->input->post('municipio'),
			'direccionv' => $this->input->post('direccion'),
			'barriov' => $this->input->post('barrio'),
			'telefonov' => $this->input->post('telefono'),
			'numerohom' => $this->input->post('numerohom'),
			'numeromuj' => $this->input->post('numeromuj')
			);
		$this->load->model('Estudiante');
		$this->Estudiante->guardar($datos);
		
		$this->load->view('bien');
		
	}




	public function estudiantes()
	{
            $vista="Estudiante";
		//$datos["nombre"]="alpiste";
		//$datos["apellido"]="peson";
		$this->template->Render($vista);
	}

	public function administrador()
	{
		$vista="administrador";
		$datos["nombre"]="alpiste";
		$datos["apellido"]="peson";
		//$this->load->model("mestudiantes");
		//$res=$this->Mestudiantes->listarestudiantes("cristian");
		//$datos["res"]=$res;
		
		$this->template->Render($vista,$datos);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
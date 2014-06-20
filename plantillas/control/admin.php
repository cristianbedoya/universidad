<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
    }


     public function _remap($method,$data_url)
    {
        if($this->session->userdata("user")=="admin")
        {
           // echo "admin";
            $this->$method();
        }else
        {
            redirect(base_url("home"));
        }

    }

    public function _estudiante_output($output = null) {
        $vista = "Estudiante";
        //$datos["nombre"]="alpiste";
        //$datos["apellido"]="peson";
        $this->template->Render($vista, $output);
        //$this->load->view('example.php',$output);
    }

    public function _acudiente_output($output = null) {
        
        $vista = "acudiente";
        //$datos["nombre"]="alpiste";
        //$datos["apellido"]="peson";
        $this->template->Render($vista, $output);
        //$this->load->view('example.php',$output);
    }

    public function _usuarios_output($output = null) {
        
        $vista = "usuario";
        //$datos["nombre"]="alpiste";
        //$datos["apellido"]="peson";
        $this->template->Render($vista, $output);
        //$this->load->view('example.php',$output);
    }

    public function _docente_output($output = null) {
        
        $vista = "docente";
        //$datos["nombre"]="alpiste";
        //$datos["apellido"]="peson";
        $this->template->Render($vista, $output);
        //$this->load->view('example.php',$output);
    }


    public function inicio() {
        
        $vista = "administrador";
        //$datos["nombre"]="alpiste";
        //$datos["apellido"]="peson";
        $this->template->Render($vista);
        //$this->load->view('example.php',$output);
    }


    public function offices() {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    public function index() {
        $this->_example_output((object) array('output' => '', 'js_files' => array(), 'css_files' => array()));
    }

    public function estudiante() {
        try {
            $crud = new grocery_CRUD();
            
            $crud->set_language("spanish");
            
            $crud->set_theme('datatables');
            $crud->set_table('tblestudiantes');
            $crud->set_subject('Estudiante');
            $crud->required_fields('documento');
            $crud->columns('documento', 'nombre1', 'apellido1', 'barrio', 'instituciones');
            
            $crud->display_as('nombre1','Primer Nombre')->display_as('nombre2','Segundo Nombre');
            $crud->display_as('apellido1','Primer Apellido')->display_as('apellido2','Segundo Apellido');
            
                
            //-----------------------------------------------------------------------------------------------------
             
            $crud->add_fields('documento', 'tipo', 'nombre1', 'nombre2', 'apellido1', 'apellido2', 'fecha_nacimiento', 'lugar_nacimiento','grupo_sanguineo', 'direccion', 'barrio', 'telefono', 'instituciones', 'municipio', 'nro_hermanos', 'nro_hermanas');
            $crud->edit_fields('documento','tipo', 'nombre1', 'nombre2', 'apellido1', 'apellido2',  'fecha_nacimiento', 'lugar_nacimiento','grupo_sanguineo','direccion', 'barrio', 'telefono', 'instituciones', 'municipio', 'nro_hermanos', 'nro_hermanas');
            $crud->display_as('grupo_sanguineo','Tipo de Sangre')->display_as('fecha_nacimiento','Fecha de Nacimiento');
 
            $crud->field_type('tipo','dropdown',
            array('1' => 'C.C', '2' => 'T.I'));
            
        


            //$crud->field_type('fecha_nacimiento','datepicker');
            
            $crud->field_type('grupo_sanguineo','dropdown',
            array('1' => 'A+', '2' => 'A-','3' => 'B+' , '4' => 'B-', '5' => 'AB+', '6' => 'AB-', '7' => 'O+', '8' => 'O-'));
            
            //$crud -> field_type( 'tipo' , 'oculto');
            //-----------------------------------------------------------------------------------------------------
            
            if( $crud->getState() == 'edit' ) { //add these only in edit form
                $crud->set_css('assets/grocery_crud/css/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
                $crud->set_js_lib('assets/grocery_crud/js/'.grocery_CRUD::JQUERY);
                $crud->set_js_lib('assets/grocery_crud/js/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);
                $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/config/jquery.datepicker.config.js');
                $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/ui/i18n/datepicker/jquery.ui.datepicker-es.js');
                //$crud->set_js('assets/grocery_crud/js/jquery_plugins/ui/i18n/datepicker/'.da);
                $crud->callback_edit_field('fecha_nacimiento',array($this,'_add_default_date_value'));
                
                }

            
            if( $crud->getState() == 'add' ) { //add these only in edit form
                $crud->set_css('assets/grocery_crud/css/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
                $crud->set_js_lib('assets/grocery_crud/js/'.grocery_CRUD::JQUERY);
                $crud->set_js_lib('assets/grocery_crud/js/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);
                $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/config/jquery.datepicker.config.js');
                $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/ui/i18n/datepicker/jquery.ui.datepicker-es.js');
                //$crud->set_js('assets/grocery_crud/js/jquery_plugins/ui/i18n/datepicker/'.da);
                      
                $crud->callback_add_field('fecha_nacimiento',array($this,'_add_default_date_value'));
                                   
                }





            $output = $crud->render();

            $this->_estudiante_output($output);

                    
            //-----------------------------------------------------------------------------------------------------
            //$crud->set_rules('correo', 'email', 'valid_email|required');
            // $output = $crud->render();

           // $this->_example_output($output);
           
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }



    public function _add_default_date_value()
            {
                            $value = !empty($value) ? $value : date("d/m/Y");
                            $return = '<input type="text" name="fecha_nacimiento" value="'.$value.'" class="datepicker-input" /> ';
                            $return .= '<a class="datepicker-input-clear" tabindex="-1">Limpiar</a> (dd/mm/yyyy)';
                            return $return;
            }




     public function acudiente() {
        try {
            $crud = new grocery_CRUD();
            
            $crud->set_language("spanish");
            
            $crud->set_theme('datatables');
            $crud->set_table('tblacudientes');
            $crud->set_subject('Acudientes');
            $crud->required_fields('documento');
            $crud->columns('documento', 'nombre1', 'apellido1', 'parentesco', 'doc_estudiante');
            
            $crud->display_as('nombre1','Primer Nombre')->display_as('nombre2','Segundo Nombre');
            $crud->display_as('apellido1','Primer Apellido')->display_as('apellido2','Segundo Apellido');
            
                
            //-----------------------------------------------------------------------------------------------------
             
            $crud->add_fields();
            $crud->edit_fields();
            
            $crud->set_rules('email', 'email', 'valid_email|required');

            //$crud->display_as('grupo_sanguineo','Tipo de Sangre')->display_as('fecha_nacimiento','Fecha de Nacimiento');
 
            //$crud->field_type('tipo','dropdown',
            //array('1' => 'C.C', '2' => 'T.I'));
            
     
            //$crud->field_type('fecha_nacimiento','datepicker');
            
            //$crud->field_type('grupo_sanguineo','dropdown',
            //array('1' => 'A+', '2' => 'A-','3' => 'B+' , '4' => 'B-', '5' => 'AB+', '6' => 'AB-', '7' => 'O+', '8' => 'O-'));
            
            //$crud -> field_type( 'tipo' , 'oculto');
            //-----------------------------------------------------------------------------------------------------
            
            /*if( $crud->getState() == 'edit' ) { //add these only in edit form
                $crud->set_css('assets/grocery_crud/css/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
                $crud->set_js_lib('assets/grocery_crud/js/'.grocery_CRUD::JQUERY);
                $crud->set_js_lib('assets/grocery_crud/js/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);
                $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/config/jquery.datepicker.config.js');
                $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/ui/i18n/datepicker/jquery.ui.datepicker-es.js');
                //$crud->set_js('assets/grocery_crud/js/jquery_plugins/ui/i18n/datepicker/'.da);
                $crud->callback_edit_field('fecha_nacimiento',array($this,'_add_default_date_value'));
                
                }

            
            if( $crud->getState() == 'add' ) { //add these only in edit form
                $crud->set_css('assets/grocery_crud/css/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
                $crud->set_js_lib('assets/grocery_crud/js/'.grocery_CRUD::JQUERY);
                $crud->set_js_lib('assets/grocery_crud/js/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);
                $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/config/jquery.datepicker.config.js');
                $crud->set_js_config('assets/grocery_crud/js/jquery_plugins/ui/i18n/datepicker/jquery.ui.datepicker-es.js');
                //$crud->set_js('assets/grocery_crud/js/jquery_plugins/ui/i18n/datepicker/'.da);
                      
                $crud->callback_add_field('fecha_nacimiento',array($this,'_add_default_date_value'));
                                   
                }
                */




            $output = $crud->render();

            $this->_acudiente_output($output);

                    
            //-----------------------------------------------------------------------------------------------------
            //$crud->set_rules('correo', 'email', 'valid_email|required');
            // $output = $crud->render();

           // $this->_example_output($output);
           
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }




    public function usuario() {
        try {
            $crud = new grocery_CRUD();
            
            $crud->set_language("spanish");
            
            $crud->set_theme('datatables');
            $crud->set_table('usuarios');
            $crud->set_subject('Perfiles de Usuarios');
            $crud->required_fields('documento');
            $crud->columns('identificacion','usuario','contraseña','tipo','fecha','correo');
                           
            //-----------------------------------------------------------------------------------------------------
             
            $crud->add_fields();
            $crud->edit_fields();
            
            //$crud->set_rules('correo', 'correo', 'valid_email|required');

            



            $output = $crud->render();

            $this->_usuarios_output($output);

                    
            //-----------------------------------------------------------------------------------------------------
            //$crud->set_rules('correo', 'email', 'valid_email|required');
            // $output = $crud->render();

           // $this->_example_output($output);
           
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }


    public function docente() {
        try {
            $crud = new grocery_CRUD();
            
            $crud->set_language("spanish");
            
            $crud->set_theme('datatables');
            $crud->set_table('tbldocentes');
            $crud->set_subject('Docentes');
            $crud->required_fields('documento');
            $crud->columns('documento', 'nombre1', 'apellido1','email');
            $crud->display_as('email','correo');
            $crud->display_as('nombre1','Primer Nombre')->display_as('nombre2','Segundo Nombre');
            $crud->display_as('apellido1','Primer Apellido')->display_as('apellido2','Segundo Apellido');
            $crud->display_as('sangre','Tipo de Sangre')->display_as('fecha','Fecha de Nacimiento');
                
            //-----------------------------------------------------------------------------------------------------
             
            $crud->add_fields();
            $crud->edit_fields();
            

            $crud->field_type('sangre','dropdown',
            array('1' => 'A+', '2' => 'A-','3' => 'B+' , '4' => 'B-', '5' => 'AB+', '6' => 'AB-', '7' => 'O+', '8' => 'O-'));
 


            $crud->set_rules('email', 'email', 'valid_email|required');


            $output = $crud->render();

            $this->_docente_output($output);

                    
            //-----------------------------------------------------------------------------------------------------
            
            // $output = $crud->render();

           // $this->_example_output($output);
           
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }  


     











public function employees_management() {
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('employees');
        $crud->set_relation('officeCode', 'offices', 'city');
        $crud->display_as('officeCode', 'Office City');
        $crud->set_subject('Employee');

        $crud->required_fields('lastName');

        $crud->set_field_upload('file_url', 'assets/uploads/files');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function customers_management() {
        $crud = new grocery_CRUD();

        $crud->set_table('customers');
        $crud->columns('customerName', 'contactLastName', 'phone', 'city', 'country', 'salesRepEmployeeNumber', 'creditLimit');
        $crud->display_as('salesRepEmployeeNumber', 'from Employeer')
                ->display_as('customerName', 'Name')
                ->display_as('contactLastName', 'Last Name');
        $crud->set_subject('Customer');
        $crud->set_relation('salesRepEmployeeNumber', 'employees', 'lastName');

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function orders_management() {
        $crud = new grocery_CRUD();

        $crud->set_relation('customerNumber', 'customers', '{contactLastName} {contactFirstName}');
        $crud->display_as('customerNumber', 'Customer');
        $crud->set_table('orders');
        $crud->set_subject('Order');
        $crud->unset_add();
        $crud->unset_delete();

        $output = $crud->render();

        $this->_acudiente_output($output);
    }

    public function products_management() {
        $crud = new grocery_CRUD();

        $crud->set_table('products');
        $crud->set_subject('Product');
        $crud->unset_columns('productDescription');
        $crud->callback_column('buyPrice', array($this, 'valueToEuro'));

        $output = $crud->render();

        $this->_example_output($output);
    }

    public function valueToEuro($value, $row) {
        return $value . ' &euro;';
    }

    public function film_management() {
        $crud = new grocery_CRUD();

        $crud->set_table('film');
        $crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname', 'priority');
        $crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
        $crud->unset_columns('special_features', 'description', 'actors');

        $crud->fields('title', 'description', 'actors', 'category', 'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

        $output = $crud->render();

        $this->_acudiente_output($output);
    }

    public function film_management_twitter_bootstrap() {
        try {
            $crud = new grocery_CRUD();

            $crud->set_theme('twitter-bootstrap');
            $crud->set_table('film');
            $crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname', 'priority');
            $crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
            $crud->unset_columns('special_features', 'description', 'actors');

            $crud->fields('title', 'description', 'actors', 'category', 'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');

            $output = $crud->render();
            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function multigrids() {
        $this->config->load('grocery_crud');
        $this->config->set_item('grocery_crud_dialog_forms', true);
        $this->config->set_item('grocery_crud_default_per_page', 10);

        $output1 = $this->offices_management2();

        $output2 = $this->employees_management2();

        $output3 = $this->customers_management2();

        $js_files = $output1->js_files + $output2->js_files + $output3->js_files;
        $css_files = $output1->css_files + $output2->css_files + $output3->css_files;
        $output = "<h1>List 1</h1>" . $output1->output . "<h1>List 2</h1>" . $output2->output . "<h1>List 3</h1>" . $output3->output;

        $this->_example_output((object) array(
                    'js_files' => $js_files,
                    'css_files' => $css_files,
                    'output' => $output
        ));
    }

    public function offices_management2() {
        $crud = new grocery_CRUD();
        $crud->set_table('offices');
        $crud->set_subject('Office');

        $crud->set_crud_url_path(site_url(strtolower(__CLASS__ . "/" . __FUNCTION__)), site_url(strtolower(__CLASS__ . "/multigrids")));

        $output = $crud->render();

        if ($crud->getState() != 'list') {
            $this->_example_output($output);
        } else {
            return $output;
        }
    }

    public function employees_management2() {
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('employees');
        $crud->set_relation('officeCode', 'offices', 'city');
        $crud->display_as('officeCode', 'Office City');
        $crud->set_subject('Employee');

        $crud->required_fields('lastName');

        $crud->set_field_upload('file_url', 'assets/uploads/files');

        $crud->set_crud_url_path(site_url(strtolower(__CLASS__ . "/" . __FUNCTION__)), site_url(strtolower(__CLASS__ . "/multigrids")));

        $output = $crud->render();

        if ($crud->getState() != 'list') {
            $this->_example_output($output);
        } else {
            return $output;
        }
    }

    public function customers_management2() {

        $crud = new grocery_CRUD();

        $crud->set_table('customers');
        $crud->columns('customerName', 'contactLastName', 'phone', 'city', 'country', 'salesRepEmployeeNumber', 'creditLimit');
        $crud->display_as('salesRepEmployeeNumber', 'from Employeer')
                ->display_as('customerName', 'Name')
                ->display_as('contactLastName', 'Last Name');
        $crud->set_subject('Customer');
        $crud->set_relation('salesRepEmployeeNumber', 'employees', 'lastName');

        $crud->set_crud_url_path(site_url(strtolower(__CLASS__ . "/" . __FUNCTION__)), site_url(strtolower(__CLASS__ . "/multigrids")));

        $output = $crud->render();

        if ($crud->getState() != 'list') {
            $this->_example_output($output);
        } else {
            return $output;
        }
    }

}
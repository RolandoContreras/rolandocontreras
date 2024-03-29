<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();     
        $this->load->model('users_model','obj_user');
    }
    
    public function index(){    
       $this->load->view('dashboard');
    }
    
    public function validate(){
        if($this->input->is_ajax_request()){    
            $this->form_validation->set_rules('email','email',"required|trim|valid_email|callback_validar_user");
            $this->form_validation->set_rules('password','password','required|trim');              
    	    $this->form_validation->set_message('required','Campo requerido %s');    	    
            $this->form_validation->set_message('valid_email','Correo Invalido %s');    	    
            
            if ($this->form_validation->run($this)== false){                
    	        $cadena  = explode("</p>", validation_errors());                
    	        $cadena2 = implode("<p>", $cadena);
    	        $cadena3 = explode("<p>", $cadena2);
    	        array_pop($cadena3);
    	        array_shift($cadena3);                
    	        $data['print'] = $cadena3[0];
                $data['status'] = false;       
                
    	    }else{
                $data['status'] = true;
    	        $data['print'] = "Bienvenido al sistema";
                $data['url'] = site_url()."dashboard/panel";               
            }         
            echo json_encode($data);  
            exit();           
        }
    }
    
    public function validar_user($email){
        
        $password = $this->input->post('password');  
        $obj_user = $this->obj_user->verificar_email($email,$password);       
        
        $params = array("select" =>"user_id,
                                    first_name,
                                    last_name,
                                    email,
                                    privilage,
                                    active",
                             "where" => "email = '$email' and password = '$password' and active = 1");
            
            $obj_user_count = $this->obj_user->total_records($params);
            $obj_user = $this->obj_user->get_search_row($params);
        
        if ($obj_user_count > 0){
                $data_user_session['user_id'] = $obj_user->user_id;
                $data_user_session['name'] = $obj_user->first_name.' '.$obj_user->last_name;
                $data_user_session['email'] = $obj_user->email;
                $data_user_session['privilage'] = $obj_user->privilage;
                $data_user_session['logged_usercms'] = "TRUE";
                $data_user_session['active'] = $obj_user->active;
                $_SESSION['usercms'] = $data_user_session;      
        }else{
            $this->form_validation->set_message('validar_user', "El correo y/o la contraseña no son correctas");
            return false;
        }
    }
    
    public function logout(){        
        $this->session->unset_userdata('usercms');
	$this->session->destroy();
        redirect('dashboard'); 
    }
}
<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed"); 

class D_customer extends CI_Controller{    
    
    public function __construct(){
        parent::__construct();
        $this->load->model("customer_model","obj_customer");
        $this->load->model("paises_model","obj_paises");
    }   
                
    public function index(){  
        
           $this->get_session();
           $params = array(
                        "select" =>"customer.customer_id,
                                    customer.name,
                                    customer.last_name,
                                    customer.phone,
                                    customer.email,
                                    customer.date,
                                    customer.active"
               );
           //GET DATA FROM CUSTOMER
           $obj_customer= $this->obj_customer->search($params);
            /// VISTA
            $this->tmp_mastercms->set("obj_customer",$obj_customer);
            $this->tmp_mastercms->render("dashboard/customer/customer_list");
    }
    
    public function validate(){
        if ($this->input->is_ajax_request()) {
            //GET CUSTOMER_ID
            $customer_id = $this->input->post("customer_id");
            if($customer_id != null){
                $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'active' => $this->input->post('active'),
                'updated_at' => date("Y-m-d H:i:s"),
                'updated_by' => $_SESSION['usercms']['user_id']
            );
                //SAVE DATA IN TABLE    
                $resutl = $this->obj_customer->update($customer_id, $data);
                if ($resutl != null) {
                    $data['status'] = true;
                } else {
                    $data['status'] = false;
                }
            }else{
                $data['status'] = false;
            }
            echo json_encode($data);
        }
    }
    
    public function load($obj_customer=NULL){
        //VERIFY IF ISSET CUSTOMER_ID
        if ($obj_customer != ""){
            /// PARAMETROS PARA EL SELECT 
            $where = "customer.customer_id = $obj_customer";
            $params = array(
                        "select" =>"*",
                         "where" => $where,
            ); 
            $obj_customer  = $this->obj_customer->get_search_row($params); 
            
            //RENDER
            $this->tmp_mastercms->set("obj_customer",$obj_customer);
          }
            //RENDER TO VIEW
            $this->tmp_mastercms->render("dashboard/customer/customer_form");    
    }
    
    public function delete() {
        if ($this->input->is_ajax_request()) {
            //OBETENER customer_id
            $customer_id = $this->input->post("customer_id");
            //VERIFY IF ISSET CUSTOMER_ID
            if ($customer_id != "") {
                $result = $this->obj_customer->delete($customer_id);
                if($result != null){
                    $data['status'] = true;
                }else{
                    $data['status'] = false;
                }
            }else{
                $data['status'] = false;
            }
            echo json_encode($data);
        }
    }
    
    public function get_session(){          
        if (isset($_SESSION['usercms'])){
            if($_SESSION['usercms']['logged_usercms']=="TRUE"){               
                return true;
            }else{
                redirect(site_url().'dashboard');
            }
        }else{
            redirect(site_url().'dashboard');
        }
    }
}
?>
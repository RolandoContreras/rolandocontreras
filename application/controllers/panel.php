<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Panel extends CI_Controller{
    public function __construct() {
        parent::__construct();    
        $this->load->model("customer_model","obj_customer");
        $this->load->model("comments_model","obj_comments");
    }
    
    public function index(){
        //GET THE SESSION
        $this->get_session();
        //GET TOTAL ROWS
        $params = array("select" =>"count(customer_id) as total_customer,
                                    (select count(*) from users) as total_users,
                                    (select count(*) from comments) as total_contact");
        $obj_total = $this->obj_customer->get_search_row($params);
        //GET PENDING ROWS
        $params_pending = array("select" =>"count(comment_id) as pending_comments",
                        "where" =>"status_value = 1",);
        $obj_pending = $this->obj_comments->get_search_row($params_pending);
        //send data
        $this->tmp_mastercms->set('obj_total',$obj_total);
        $this->tmp_mastercms->set('obj_pending',$obj_pending);
        $this->tmp_mastercms->render('panel');
     }
    
    public function masive_messages(){
                //GET TITLE AND MESSAGES
                $title = $this->input->post("title");
                $message_content = $this->input->post("message_content");
                
                if(isset($_FILES["image_file"]["name"])){
                $config['upload_path']          = './static/cms/images/masive';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2000;
                $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('image_file')){
                         $error = array('error' => $this->upload->display_errors());
                          echo '<div class="alert alert-danger">'.$error['error'].'</div>';
                    }else{
                        $data = array('upload_data' => $this->upload->data());
                        $img = $_FILES["image_file"]["name"];
                        // INSERT ON TABLE activation_message
                        $data_message = array(
                                'date' => date("Y-m-d"),
                                'content' => $message_content,
                                'title' => $title,
                                'active' => 1,
                                'status_value' => 1,    
                                'img' => $img,
                                'created_by' => $_SESSION['usercms']['user_id'],
                                'created_at' => date("Y-m-d H:i:s")
                            ); 
                           $this->obj_message_masive->insert($data_message);
                           
                           //GET EMAIL
                            $params = array(
                                    "select" =>"email",
                                    "where" => "status_value = 1"
                           );
                            //GET DATA FROM CUSTOMER
                            $obj_customer= $this->obj_customer->search($params);

                            $array_email = "";
                                foreach ($obj_customer as $key => $value) {
                                    $array_email .= "$value->email".",";
                                }

                            $images = "static/cms/images/masive/$img";
                            $img_path = "<img src='".site_url().'/'.$images."' alt='".$title."' height='600' width='300'/>";
//                            //SEND EMAIL
//                            $mensaje = wordwrap("<html><body><center><h1>Nueva Activación</h1><p>$img_path</p><br/><p>Tenemos una nueva activación procesarla.</p></center></body></html>", 70, "\n", true);
//                            $headers = "MIME-Version: 1.0\r\n"; 
//                            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//                            $headers .= "From: 3T Company: Travel - Training - Trade < noreplay@my3t.club >\r\n";
//                            $bool = mail("software.contreras@gmail.com,software.contreras1@gmail.com, irvingsong_5@hotmail.com,pastorolandoc@hotmail.com",$title,$message_content,$headers);
                            
                            
                            
                            
                            
                            $to = 'software.contreras@gmail.com';
//                            $title = 'Alert information On Products';
                            $message = wordwrap("<html><body><center><h1>Nueva Activación</h1><p>$img_path</p><br/><p>Tenemos una nueva activación procesarla.</p></center></body></html>", 70, "\n", true);                 
                            $this->load->library('email');
                            // from address
                            $this->email->from('From: 3T Company: Travel - Training - Trade');
                            $this->email->to($to); // to Email address
                            $this->email->bcc('software.contreras@gmail.com,software.contreras1@gmail.com,irvingsong_5@hotmail.com'); 
                            $this->email->subject($title); // email Subject
                            $this->email->message($message);
                            $this->email->send();
                            
                            
                            echo '<div class="alert alert-success" style="text-align: center">Publicado Exitosamente</div>';
                        
                    }
                }
                
    } 
    
    public function cambiar_status(){
        if($this->input->is_ajax_request()){   
              $comment_id = $this->input->post("comment_id");
              
                if(count($comment_id) > 0){
                    $data = array(
                        'active' => 0,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'updated_by' => $_SESSION['usercms']['user_id'],
                    ); 
                    $this->obj_comments->update($comment_id,$data);
                }
                echo json_encode($data);            
        exit();
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

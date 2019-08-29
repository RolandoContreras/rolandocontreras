<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model("about_model","obj_about");
    }   
        
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
//            GET DATA ABOUT
            $params = array(
                        "select" =>"*",
                        "where" => "status_value = 1"
               );
           
           //GET DATA FROM ABOUT
           $obj_about= $this->obj_about->search($params);
           $key = 1;
           foreach ($obj_about as $key => $value) {
               switch ($key) {
                    case 0:
                        $data['name_about'] = $value->name;
                        $data['title_about'] = $value->title;
                        $data['text_about'] = $value->text;
                        break;
                    case 1:
                        $data['name_vision'] = $value->name;
                        $data['title_vision'] = $value->title;
                        $data['text_vision'] = $value->text;
                        break;
                    case 2:
                        $data['name_mision'] = $value->name;
                        $data['title_mision'] = $value->title;
                        $data['text_mision'] = $value->text;
                        break;
                }
           }
//           SEND DATA
        	$this->load->view('home',$data);
	}
}

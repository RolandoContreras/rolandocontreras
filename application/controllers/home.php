<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("customer_model", "obj_customer");
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        //send data
        $data['title'] = "Bienvenido | Rolando Contreras";
        $this->load->view('home', $data);
    }
    
    public function gracias() {
        $data['title'] = "Gracias | Rolando Contreras";
        $this->load->view('gracias', $data);
    }
    
    public function masterclass() {
        $data['title'] = "MasterClass | Rolando Contreras";
        $this->load->view('masterclass', $data);
    }
    
    public function paso2() {
        //ACTIVE CUSTOMER NORMALY
        if ($this->input->is_ajax_request()) {
            //SELECT CUSTOMER_ID
            $name = $this->input->post("name");
            $email = trim($this->input->post("email"));
            //verify email
            $obj_customer = $this->verify_email($email);
            if (!empty($obj_customer)) {
                //start session
                $data_customer_session['customer_id'] = $obj_customer->customer_id;
                $data_customer_session['name'] = $obj_customer->name;
                $data_customer_session['last_name'] = "";
                $data_customer_session['email'] = $obj_customer->email;
                $data_customer_session['active'] = 1;
                $data_customer_session['logged_customer'] = "TRUE";
                $_SESSION['customer'] = $data_customer_session;
                //send to master class
                $data['url'] = "gracias";
                $data['status'] = true;
            } else {
                //create passtowrd rand
                $pass = $this->crear_pass_rand();
                //create account customer
                $param = array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $pass,
                    'date' => date("Y-m-d H:i:s"),
                    'active' => 1,
                );
                $customer_id = $this->obj_customer->insert($param);
                //send welcome message
                //        $this->message($name, $email, $pass);
                //start session
                $data_customer_session['customer_id'] = $customer_id;
                $data_customer_session['name'] = $name;
                $data_customer_session['email'] = $email;
                $data_customer_session['active'] = 1;
                $data_customer_session['logged_customer'] = "TRUE";
                $_SESSION['customer'] = $data_customer_session;
                //set url to send to course
                $data['url'] = "gracias";
                $data['status'] = true;
            }
            echo json_encode($data);
        }
    }
    
    public function verify_email($email) {
        $params = array(
            "select" => "customer_id,
                        name,
                        email",
            "where" => "email = '$email'");
        $obj_customer = $this->obj_customer->get_search_row($params);
        return $obj_customer;
    }
      
    public function crear_pass_rand() {
        $longitud = 8; // longitud del password.
        $pass = substr(md5(rand()), 0, $longitud);
        return($pass); // devuelve el password.
    }
    
    public function sitemap() {
        //obtener cursos
        //obtener blog
        //obtener tags
        //crear código
        $codigo = '<?xml version="1.0" encoding="UTF-8"?>
      <urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $codigo .='<url>';
        $codigo .='<loc>' . site_url() . '</loc>';
        $codigo .='<lastmod>2020-07-28T19:18:39+00:00</lastmod>';
        $codigo .='<changefreq>weekly</changefreq>
                       <priority>1.00</priority>';
        $codigo .='</url>';
        $codigo .='<url>';
        $codigo .='<loc>' . site_url() . 'inicio' . '</loc>';
        $codigo .='<lastmod>2020-07-28T19:18:39+00:00</lastmod>';
        $codigo .='<changefreq>weekly</changefreq>
                       <priority>1.00</priority>';
        $codigo .='</url>';
        $codigo .='<url>';
        $codigo .='<loc>' . site_url() . 'gracias' . '</loc>';
        $codigo .='<lastmod>2020-07-28T19:18:39+00:00</lastmod>';
        $codigo .='<changefreq>weekly</changefreq>
                       <priority>1.00</priority>';
        $codigo .='</url>';
        $codigo .='<url>';
        $codigo .='<loc>' . site_url() . 'masterclass' . '</loc>';
        $codigo .='<lastmod>2020-07-28T19:18:39+00:00</lastmod>';
        $codigo .='<changefreq>weekly</changefreq>
                       <priority>1.00</priority>';
        $codigo .='</url>';
        $codigo .='<url>';
        $codigo .='<loc>' . site_url() . 'contacto' . '</loc>';
        $codigo .='<lastmod>2020-07-28T19:18:39+00:00</lastmod>';
        $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
        $codigo .='</url>';
        $codigo .='<url>';
        $codigo .='<loc>' . site_url() . 'terminos-y-condiciones' . '</loc>';
        $codigo .='<lastmod>2020-07-28T19:18:39+00:00</lastmod>';
        $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
        $codigo .='</url>';
        $codigo .='<url>';
        $codigo .='<loc>' . site_url() . 'politica-de-privacidad' . '</loc>';
        $codigo .='<lastmod>2020-07-28T19:18:39+00:00</lastmod>';
        $codigo .='<changefreq>weekly</changefreq>
                       <priority>0.80</priority>';
        $codigo .='</url>';
        $codigo .='</urlset>';
        $path = "sitemap.xml";
        $modo = "w+";

        if ($fp = fopen($path, $modo)) {
            fwrite($fp, $codigo);
            echo "Se realizo con Exito";
        } else {
            echo "Error";
        }
    }

    public function term_condition() {
        $data['title'] = "Términos y Condiciones | Edukate Pro";
        $this->load->view('terminos', $data);
    }

    public function policy() {
        //obtener categorias
        $data['title'] = "Rolando Contreras | Políticas de Privacidad";
        $this->load->view('policy', $data);
    }

    public function cookies() {
        //obtener categorias
        $data['obj_category'] = $this->nav_category();
        $data['title'] = "Términos y Condiciones | Edukate Pro";
        $this->load->view('cookies', $data);
    }

    public function boletin() {
        //ENVIAR MENSAJE DE CORREO
        if ($this->input->is_ajax_request()) {
            $email = $this->input->post("email");
            //verify if isset
            $param = array(
                "select" => "boletin_id",
                "where" => "email = '$email'"
            );
            //SAVE DATA IN TABLE    
            $obj_boletin = $this->obj_boletin->get_search_row($param);
            if ($obj_boletin == null) {
                $param = array(
                    'email' => $email,
                    'active' => 1,
                    'date' => date("Y-m-d H:i:s")
                );
                //SAVE DATA IN TABLE    
                $result = $this->obj_boletin->insert($param);
                if ($result != null) {
                    $data['status'] = true;
                } else {
                    $data['status'] = false;
                }
            } else {
                $data['status'] = "email";
            }
            echo json_encode($data);
            exit();
        }
    }

}

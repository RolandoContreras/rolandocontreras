<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('comments_model', 'obj_comments');
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
        $data['title'] = "Contacto | Rolando Contreras";
        $this->load->view('contact', $data);
    }

    public function send_messages() {
        //GET DATA BY POST
        if ($this->input->is_ajax_request()) {
            if ($_POST['google-response-token']) {
                $googleToken = $_POST['google-response-token'];
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld1reMZAAAAAL_YP_bK4ROMe0CSsZzoLIN2mnJk&response={$googleToken}");
                $response = json_decode($response);
                $response = (array) $response;
                if ($response['success'] && ($response['score'] && $response['score'] > 0.5)) {
                    //GET DATA STRING
                    $name = $this->input->post("name");
                    $email = $this->input->post("email");
                    $phone = $this->input->post("phone");
                    $message = $this->input->post("message");
                    //SAVE MESSAGES BD
                    //status_value 0 means (not read)
                    $param = array(
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'message' => $message,
                        'date' => date("Y-m-d H:i:s"),
                        'status_value' => 1,
                    );
                    $comment_id = $this->obj_comments->insert($param);
                    if ($comment_id != null) {
                        $data['status'] = true;
                        //senda email message
                        $this->message($name, $email, $phone, $message);
                    } else {
                        $data['status'] = false;
                    }
                } else {
                    $data['status'] = "false2";
                }
            }
            echo json_encode($data);
            exit();
        }
    }

    public function message($name, $email, $phone, $message) {
        $mensaje = wordwrap("<html>
                     <div bgcolor='#E9E9E9' style='background:#fff;margin:0;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;font-size:14px'>
                      <table style='background-color:#fff;border-collapse:collapse;margin:0;padding:0' width='100%' height='100%' cellspacing='0' cellpadding='0' border='0'
                        align='center'>
                        <tbody>
                          <tr>
                            <td valign='top' align='center'>
                              <table style='border-collapse:collapse;margin:0;padding:0;max-width:600px' width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' align='center'>
                                <tbody>
                                  <tr>
                                    <td style='padding:39px 30px 31px;display:block;background:#fafafa'> 
                                    <p style='padding:32px 32px 0;color:#333333;background:#fff;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;line-height:14px;margin:0;font-size:14px;border-radius:5px 5px 0 0'
                                        align='left'>Hola equipo de Rolando Contreras, tienen un mensaje de $name</p> 
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style='padding:0 30px;display:block;background:#fafafa'>
                                      <table style='width:100%;border-collapse:collapse;padding:0' width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' align='center'>
                                        <tbody>
                                          <tr>
                                            <td style='padding:0;background-color:#fff;border-radius:0 0 5px 5px;padding:32px'>
                                              <p style='margin:0;padding-bottom:20px;color:#333333;line-height:22px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;font-size:14px'>
                                              A través de la sección contacto el sr(a) $name se ha comunicado con nosotros</p>
                                              <p style='margin:0 0 24px;padding:16px;border-radius:5px;padding-bottom:20px;background:#f7f7f7;color:#333333;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;font-size:14px'>
                                              <span style='display:block;padding-bottom:8px'><span style='width:101px;display:inline-block'>Nombre: </span><strong>$name</strong></span>
                                              </p> 
                                              <p style='margin:0 0 24px;padding:16px;border-radius:5px;padding-bottom:20px;background:#f7f7f7;color:#333333;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;font-size:14px'>
                                              <span style='display:block;padding-bottom:8px'><span style='width:101px;display:inline-block'>Email: </span><strong>$email</strong></span>
                                              </p> 
                                              <p style='margin:0 0 24px;padding:16px;border-radius:5px;padding-bottom:20px;background:#f7f7f7;color:#333333;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;font-size:14px'>
                                              <span style='display:block;padding-bottom:8px'><span style='width:101px;display:inline-block'>Teléfono: </span><strong>$phone</strong></span>
                                              </p> 
                                              <p style='margin:0 0 24px;padding:16px;border-radius:5px;padding-bottom:20px;background:#f7f7f7;color:#333333;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;font-size:14px'>
                                              <span style='display:block;padding-bottom:8px'><span style='width:101px;display:inline-block'>Mensaje: </span><strong>$message</strong></span>
                                              </p> 
                                              <a href='http://rolandocontreras.com/admin' style='background:#2d6ced;color:#ffffff;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;font-size:14px;display:inline-block;padding:12px 17px;text-decoration:none;border-radius:5px'
                                                target='_blank'>Iniciar Sesión - Administrador</a>                          
                                              </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style='padding:30px 30px 0;display:block;background:#fafafa'>
                                      <table style='width:100%;border-collapse:collapse;padding:0;text-align:center' width='100%' height='100%' cellspacing='0' cellpadding='0'
                                        border='0' align='center'>
                                        <tbody>
                                          <tr>
                                            <td style='max-width:290px;display:inline-block;padding:0 19px 30px;box-sizing:border-box;text-align:left'>
                                              <p style='margin:0;text-align:center;line-height:20px;color:#888888;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI','Roboto','Oxygen','Ubuntu','Cantarell','Fira Sans','Droid Sans','Helvetica Neue',sans-serif;font-size:12px'>
                                              Visítanos en  <a href='http://rolandocontreras.com' style='color:#2d6ced;text-decoration:none' target='_blank'>www.rolandocontreras.com</a></p>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      </div>
                            .</html>", 70, "\n", true);
        $titulo = "Contacto - [Rolando Contreras]";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: Rolando Contreras | Sitio Web <contacto@rolandocontreras.com>\r\n";
        $bool = mail("software.contreras@gmail.com", $titulo, $mensaje, $headers);
    }

}

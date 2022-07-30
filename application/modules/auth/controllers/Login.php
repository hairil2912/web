<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel', 'login');
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ( $this->login->cekUsername($this->input->post('username') > 0) ) {

                $auth = $this->login->authenticate(
                    $this->input->post('username'),
                    $this->input->post('password')
                );

                if ( $auth ) {
                    
                    $this->session->set_userdata([
                        'logged_in' => true,
                        'user' => $auth
                    ]);

                    $response = [
                        'status' => true,
                        'redirect' => site_url('admin/home')
                    ];

                } else {
                    $response = [
                        'status' => false,
                        'message' => 'Username atau Password anda salah.'  
                    ];
                }

            } else {
                $response = [
                    'status' => false,
                    'respmessageonse' => 'Username atau Password anda salah.'  
                ];
            }

            echo json_encode($response);

        } else {
            $this->load->view('login');
        }
        
    }
}
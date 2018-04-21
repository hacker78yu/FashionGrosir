<?php
/**
 * Created by PhpStorm.
 * User: irfandihati
 * Date: 08/03/2018
 * Time: 00.07
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

        // model
        $this->load->model('Ms_user', 'user');
    }

    public function index()
    {
        $data = new stdClass();
        $data->current_url = base_url('adm.php/auth/login');
        $this->load->view('Login', $data);
    }

    public function login()
    {
        $data = new stdClass();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $username = $this->input->post('loginUsername');
            $password = $this->input->post('loginPassword');

            $user = $this->user->login_auth($username);

            if ($user != null && $user->User_Pass == $password) {

            } else {

            }
        } else if ($this->input->server('REQUEST_METHOD') == 'GET') {
            redirect(base_url('adm.php/auth'));
        }
    }

    public function logout()
    {
        session_destroy();
        redirect(base_url('adm.php/auth'));
    }
}

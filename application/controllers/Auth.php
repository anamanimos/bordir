<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Json_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('settings');
        }
        redirect('auth/login');
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('settings');
        }

        $data['title'] = 'Login Administrator - ERP Bordir';
        $data['custom_css'] = '<link rel="stylesheet" href="'.base_url('assets/css/style.css').'">';
        
        $data['content'] = $this->load->view('v_login', $data, TRUE);
        $this->load->view('layout/master', $data);
    }

    public function process() {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            redirect('auth/login');
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Json_model->get_user($username);

        // Verifikasi kriptografi hash modern bcrypt
        if ($user && password_verify($password, $user['password_hash'])) {
            $session_data = array(
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            
            $this->session->set_flashdata('success', 'Selamat datang kembali, Master ' . ucfirst($username) . '!');
            redirect('settings');
        } else {
            $this->session->set_flashdata('error', 'Kombinasi sandi atau identitas Anda tertolak!');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('welcome');
    }
}

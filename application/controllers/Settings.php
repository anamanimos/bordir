<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Json_model');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

	public function index()
	{
		$data['title'] = 'Master Settings - ERP Bordir';
		$data['config'] = $this->Json_model->get_settings();
		
        $data['custom_css'] = '<link rel="stylesheet" href="'.base_url('assets/css/style.css').'">';

		$data['content'] = $this->load->view('v_settings', $data, TRUE);
		$this->load->view('layout/master', $data);
	}

    public function save() {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            redirect('settings');
        }

        $configData = [
            "minUkuran"           => (float) $this->input->post('minUkuran'),
            "minOrder"            => (int) $this->input->post('minOrder'),
            "stitchDensity"       => (int) $this->input->post('stitchDensity'),
            "minCharge"           => (int) $this->input->post('minCharge'),
            "pembulatanMethod"    => $this->input->post('pembulatanMethod'),
            "pembulatanKelipatan" => (int) $this->input->post('pembulatanKelipatan')
        ];

        if ($this->Json_model->save_settings($configData)) {
            $this->session->set_flashdata('success', 'Setelan parameter kalkulator berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Gagalan menyimpan data ke berkas Json.');
        }

        redirect('settings');
    }
}

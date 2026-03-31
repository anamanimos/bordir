<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Json_model');
        $this->load->helper('url');
        $this->load->library('session');
    }

	public function index()
	{
		$data['title'] = 'Kalkulator Harga Bordir';
		
		// Injeksi CSS spesifik form kalkulator
		$data['custom_css'] = '<link rel="stylesheet" href="'.base_url('assets/css/style.css').'">';
		
        // Ambil payload konfigurasi dari JSON lokal
        $settings = $this->Json_model->get_settings();
        $pricing = $this->Json_model->get_pricing();
        $data['levels'] = $this->Json_model->get_customer_levels();

		// Injeksi JS Global Variables & Skrip kalkulasi utama
		$data['custom_js']  = '
        <script>
            // Payload dilempar secara aman dari backend ke variable JS Front-end
            window.APP_CONFIG = '.json_encode($settings).';
            window.PRICE_RULES = '.json_encode($pricing).';
        </script>
        <script src="'.base_url('assets/js/calculator.js').'"></script>';
		
		// Buffer view calculator
		$data['content'] = $this->load->view('v_calculator', $data, TRUE);
		
		// Panggil layout induk
		$this->load->view('layout/master', $data);
	}
}

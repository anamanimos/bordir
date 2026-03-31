<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends CI_Controller {

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
		$data['title'] = 'Pricing Rules - ERP Bordir';
		$data['rules'] = $this->Json_model->get_pricing();
        $data['levels'] = $this->Json_model->get_customer_levels();

        $data['custom_css'] = '<link rel="stylesheet" href="'.base_url('assets/css/style.css').'">';
		
		// Injeksi JS spesifik untuk fitur dinamis nambah row tabel multi-kategori tak terbatas
        $html_columns = "";
        foreach($data['levels'] as $lvl) {
            $html_columns .= "<td><input type=\\\"number\\\" step=\\\"0.01\\\" name=\\\"prices[{$lvl['id']}][]\\\" class=\\\"form-control glass-input px-2 text-center fw-bold\\\" required min=\\\"0\\\"></td>";
        }

		$data['custom_js'] = "
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('pricingBody');
    const btnAdd = document.getElementById('btnAddRow');

    btnAdd.addEventListener('click', () => {
        const row = document.createElement('tr');
        row.className = 'pricing-row';
        row.innerHTML = `
            <td><input type=\"number\" name=\"min_qty[]\" class=\"form-control glass-input text-center fw-bold\" required min=\"1\"></td>
            <td><input type=\"number\" name=\"max_qty[]\" class=\"form-control glass-input text-center fw-bold\" placeholder=\"&infin;\"></td>
            {$html_columns}
            <td class=\"text-center\"><button type=\"button\" class=\"btn btn-outline-danger btn-sm rounded-circle btn-remove\"><i class=\"bi bi-trash\"></i></button></td>
        `;
        tableBody.appendChild(row);
    });

    tableBody.addEventListener('click', (e) => {
        if(e.target.closest('.btn-remove')) {
            const row = e.target.closest('.pricing-row');
            if(document.querySelectorAll('.pricing-row').length > 1) {
                row.remove();
            } else {
                alert('Peringatan: Setidaknya harus tersisa satu rentang aturan harga!');
            }
        }
    });
});
</script>";

		$data['content'] = $this->load->view('v_pricing', $data, TRUE);
		$this->load->view('layout/master', $data);
	}

    public function save() {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            redirect('pricing');
        }

        $min_qty = $this->input->post('min_qty');
        $max_qty = $this->input->post('max_qty');
        // Tangkap array multidimensi khusus dinamis
        $prices  = $this->input->post('prices'); 
        
        $levels = $this->Json_model->get_customer_levels();

        $rulesData = [];
        if (!empty($min_qty) && is_array($min_qty)) {
            for ($i = 0; $i < count($min_qty); $i++) {
                $maxRange = !empty($max_qty[$i]) ? (int)$max_qty[$i] : 999999;
                
                $row_prices = [];
                // Jodohkan setiap kolom harga (berdasarkan ID Level) masing-masing row (i)
                foreach ($levels as $lvl) {
                    $l_id = $lvl['id'];
                    $row_prices[$l_id] = isset($prices[$l_id][$i]) ? (float)$prices[$l_id][$i] : 15;
                }
                
                $rulesData[] = [
                    "min_qty" => (int)$min_qty[$i],
                    "max_qty" => $maxRange,
                    "prices"  => $row_prices
                ];
            }
        }

        // Urutkan rentang kecil ke besar tabel pricing rules 
        usort($rulesData, function($a, $b) {
            return $a['min_qty'] <=> $b['min_qty'];
        });

        if ($this->Json_model->save_pricing($rulesData)) {
            $this->session->set_flashdata('success', 'Distribusi Skema Aturan Harga Lintas Pelanggan (Dynamic Matrix Tiers) berhasil dipercaya ke JSON Server.');
        } else {
            $this->session->set_flashdata('error', 'Crashed: Gagal memproses pendaftaran data json.');
        }

        redirect('pricing');
    }
}

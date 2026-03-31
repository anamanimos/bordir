<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerLevel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Json_model');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Kategori Pelanggan - ERP Bordir';
        $data['levels'] = $this->Json_model->get_customer_levels();

        $data['custom_css'] = '<link rel="stylesheet" href="'.base_url('assets/css/style.css').'">';

        $data['custom_js'] = "
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('levelBody');
    const btnAdd = document.getElementById('btnAddRow');

    btnAdd.addEventListener('click', () => {
        const row = document.createElement('tr');
        row.className = 'level-row';
        row.innerHTML = `
            <td>
                <input type=\"hidden\" name=\"id[]\" value=\"\">
                <span class=\"badge bg-secondary opacity-50\"><i class=\"bi bi-stars\"></i> Terbentuk Otomatis</span>
            </td>
            <td>
                <input type=\"text\" name=\"label[]\" class=\"form-control glass-input fw-semibold\" required placeholder=\"Misal: Langganan VIP Organisasi\">
            </td>
            <td class=\"text-center\">
                <button type=\"button\" class=\"btn btn-outline-danger btn-sm rounded-circle btn-remove\"><i class=\"bi bi-trash\"></i></button>
            </td>
        `;
        tableBody.appendChild(row);
    });

    tableBody.addEventListener('click', (e) => {
        if(e.target.closest('.btn-remove')) {
            const row = e.target.closest('.level-row');
            if(document.querySelectorAll('.level-row').length > 1) {
                row.remove();
            } else {
                alert('Peringatan: Setidaknya harus tersisa satu kategori dasar pelanggan.');
            }
        }
    });
});
</script>";

        $data['content'] = $this->load->view('v_customer_level', $data, TRUE);
        $this->load->view('layout/master', $data);
    }

    public function save() {
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            redirect('customerlevel');
        }

        $ids = $this->input->post('id');
        $labels = $this->input->post('label');
        
        $levelsData = [];
        if (!empty($labels) && is_array($labels)) {
            foreach ($labels as $i => $label) {
                $label = trim($label);
                if(empty($label)) continue;
                
                // Keep strictly old ID mapping to not break prices link, otherwise Slug generate 
                if (!empty($ids[$i])) {
                    $id = $ids[$i];
                } else {
                    $id = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '_', $label));
                    $base_id = $id;
                    $counter = 1;
                    $is_unique = false;
                    while(!$is_unique) {
                        $is_unique = true;
                        foreach($levelsData as $existing) {
                            if($existing['id'] === $id) {
                                $is_unique = false;
                                $id = $base_id . '_' . $counter;
                                $counter++;
                                break;
                            }
                        }
                    }
                }
                
                $levelsData[] = [
                    'id' => $id,
                    'label' => $label
                ];
            }
        }

        if (count($levelsData) === 0) {
            $this->session->set_flashdata('error', 'Stabilitas Dipertahankan: Minimal harus ada 1 entitas Kategori Customer!');
            redirect('customerlevel');
            return;
        }

        if ($this->Json_model->save_customer_levels($levelsData)) {
            $this->session->set_flashdata('success', 'Master Pelanggan dinonaktifkan/ditambahkan. Jangan lupa mengatur kolom tarif yang baru terbentuk akibat perombakan di menu Pricing!');
        } else {
            $this->session->set_flashdata('error', 'Gagalan Sinkronisasi JSON Master.');
        }

        redirect('customerlevel');
    }
}

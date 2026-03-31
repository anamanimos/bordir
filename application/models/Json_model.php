<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json_model extends CI_Model {

    private $data_path;

    public function __construct() {
        parent::__construct();
        $this->data_path = APPPATH . 'data/';
        
        if (!is_dir($this->data_path)) {
            mkdir($this->data_path, 0755, TRUE);
        }
    }

    // --- CUSTOMER LEVELS ---
    public function get_customer_levels() {
        $file = $this->data_path . 'customer_levels.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            return json_decode($json, TRUE) ?: [];
        }
        
        return [
            [ "id" => "umum", "label" => "Umum (Standar)" ],
            [ "id" => "reseller", "label" => "Reseller / Agen" ],
            [ "id" => "maklun", "label" => "Maklun / Partai Khusus" ]
        ];
    }

    public function save_customer_levels($data) {
        $file = $this->data_path . 'customer_levels.json';
        return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }


    // --- SETTINGS (MASTER) ---
    public function get_settings() {
        $file = $this->data_path . 'settings.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            return json_decode($json, TRUE);
        }
        
        return [
            "minUkuran" => 1,
            "minOrder" => 6,
            "stitchDensity" => 330,
            "minCharge" => 0,
            "pembulatanMethod" => "ceil",
            "pembulatanKelipatan" => 100
        ];
    }

    public function save_settings($data) {
        $file = $this->data_path . 'settings.json';
        return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }


    // --- PRICING RULES ---
    public function get_pricing() {
        $file = $this->data_path . 'pricing.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, TRUE);
            
            // Konversi mulus/on-the-fly untuk file usang (jika ada skema json lama harga_umum)
            if ($data && !isset($data[0]['prices']) && isset($data[0]['price_umum'])) {
                 $converted = [];
                 foreach($data as $r) {
                     $converted[] = [
                         "min_qty" => $r['min_qty'],
                         "max_qty" => $r['max_qty'],
                         "prices" => [
                             "umum" => isset($r['price_umum']) ? $r['price_umum'] : 15,
                             "reseller" => isset($r['price_reseller']) ? $r['price_reseller'] : 12,
                             "maklun" => isset($r['price_maklun']) ? $r['price_maklun'] : 10
                         ]
                     ];
                 }
                 return $converted;
            } else if ($data && isset($data[0]['prices'])) {
                // Konfigurasi normal JSON modern Format: "prices" : {"uuid": 1500}
                return $data;
            }
        }
        
        // Initial Startup Muka JSON
        return [
            [ "min_qty" => 1, "max_qty" => 11, "prices" => ["umum" => 15, "reseller" => 12, "maklun" => 10] ],
            [ "min_qty" => 12, "max_qty" => 23, "prices" => ["umum" => 12, "reseller" => 10, "maklun" => 8] ],
            [ "min_qty" => 24, "max_qty" => 999999, "prices" => ["umum" => 10, "reseller" => 8, "maklun" => 6] ]
        ];
    }

    public function save_pricing($data) {
        $file = $this->data_path . 'pricing.json';
        // Pengolahan data tipe Float/Int dilakukan Controller Harga secara terpusat.
        return file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    // --- AUTHENTICATION (USERS) ---
    public function get_user($username) {
        $file = $this->data_path . 'users.json';
        if (!file_exists($file)) {
            // Setup default admin if file not exists
            $default_users = [
                'admin' => [
                    'username' => 'admin',
                    'password_hash' => password_hash('admin123', PASSWORD_BCRYPT),
                    'role' => 'administrator'
                ]
            ];
            file_put_contents($file, json_encode($default_users, JSON_PRETTY_PRINT));
            $users = $default_users;
        } else {
            $json = file_get_contents($file);
            $users = json_decode($json, TRUE) ?: [];
        }

        if (isset($users[$username])) {
            return $users[$username];
        }

        return false;
    }

    public function update_user_password($username, $new_password) {
        $file = $this->data_path . 'users.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $users = json_decode($json, TRUE) ?: [];
            
            if (isset($users[$username])) {
                $users[$username]['password_hash'] = password_hash($new_password, PASSWORD_BCRYPT);
                return file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
            }
        }
        return false;
    }
}

# 📄 PRODUCT REQUIREMENTS DOCUMENT (PRD)
## Aplikasi Kalkulator Harga Bordir

---

## 1. 🎯 Tujuan Produk
Menyediakan sistem kalkulasi harga bordir yang:
- Cepat digunakan oleh operator
- Konsisten (standarisasi harga)
- Fleksibel (parameter bisa diubah)
- Memiliki histori perubahan

---

## 2. 🧱 Tech Stack
- Backend: PHP 8.3 + CodeIgniter 3 (custom env)
- Frontend: Bootstrap 5
- Database: MySQL / MariaDB

---

## 3. 👤 User
### 3.1 Admin
- Mengatur setting sistem
- Mengatur harga stitch
- Melihat history

### 3.2 Operator
- Menggunakan kalkulator

---

## 4. ⚙️ Business Rules

### 4.1 Input
- Lebar (cm)
- Panjang (cm)
- Qty (jumlah order)

---

### 4.2 Validasi
- Minimum ukuran: default **1x1 cm** (configurable)
- Minimum order: default **6 pcs** (configurable)
- Tidak boleh input 0 atau negatif

---

### 4.3 Perhitungan

#### 1. Luas

luas = lebar × panjang


#### 2. Stitch Density

stitch_density = default 330 (configurable)


#### 3. Stitch per Item

stitch_item = luas × stitch_density


#### 4. Effective Qty (aturan minimum order)

if qty < min_order:
effective_qty = min_order
else:
effective_qty = qty


#### 5. Total Stitch

total_stitch = stitch_item × effective_qty


#### 6. Harga per Stitch
Diambil dari tabel range berdasarkan qty input (bukan effective qty)

#### 7. Total Harga

total_harga = total_stitch × harga_per_stitch


#### 8. Minimum Charge

if total_harga < minimum_charge:
total_harga = minimum_charge


#### 9. Pembulatan (Configurable)
- Kelipatan: 100 / 500 / 1000
- Metode:
  - ceil (ke atas)
  - round (terdekat)

---

## 5. 🧩 Fitur Utama

---

### 5.1 Kalkulator Bordir

#### Input:
- Lebar
- Panjang
- Qty

#### Output (real-time):
- Luas
- Stitch per item
- Total stitch
- Harga per stitch
- Effective qty
- Total harga (setelah pembulatan)

#### Behavior:
- Real-time (JS + backend validation)
- Mobile friendly
- Tidak perlu tombol "hitung"

---

### 5.2 Master Settings

#### General Settings:
- Stitch density
- Minimum ukuran
- Minimum order
- Minimum charge
- Pembulatan (kelipatan & metode)

---

### 5.3 Harga per Stitch (Range)

#### Field:
- min_qty
- max_qty
- price_per_stitch
- is_active

#### Rules:
- Tidak boleh overlap range
- Harus mencakup semua kemungkinan qty

---

### 5.4 History (Versioning)

#### Dicatat:
- Perubahan setting
- Perubahan harga stitch

#### Data:
- key / rule
- old_value
- new_value
- changed_by
- timestamp

---

### 5.5 Kalkulasi Log (Opsional)
- Input user
- Hasil kalkulasi
- Timestamp

---

## 6. 🗄️ Database Schema

### 6.1 settings

id
key
value
updated_at


---

### 6.2 settings_history

id
key
old_value
new_value
changed_by
created_at


---

### 6.3 stitch_price_rules

id
min_qty
max_qty
price_per_stitch
is_active
created_at


---

### 6.4 stitch_price_rules_history

id
rule_id
old_price
new_price
changed_by
created_at


---

### 6.5 kalkulasi_logs

id
lebar
panjang
qty_input
effective_qty
luas
stitch_density
stitch_item
total_stitch
price_per_stitch
total_harga
created_at


---

## 7. 🔄 System Flow

1. User membuka halaman kalkulator
2. Input data (lebar, panjang, qty)
3. Sistem:
   - Ambil setting aktif
   - Ambil harga berdasarkan range qty
   - Hitung otomatis
4. Tampilkan hasil
5. (Opsional) Simpan log

---

## 8. ⚠️ Edge Cases

- Qty = 0 → error
- Lebar/panjang = 0 → error
- Nilai negatif → error
- Range harga overlap → reject saat save
- Tidak ada harga sesuai range → error
- Setting kosong → gunakan default / error

---

## 9. 🧠 UX Principles

- Input minimal
- Hasil langsung tampil
- Cepat digunakan (operator-friendly)
- Mobile responsive

---

## 10. 🚀 Future Development

- Integrasi ke sistem order
- Export invoice
- Dashboard omzet
- Multi-user role
- Integrasi WhatsApp

---

## 11. 📌 Catatan Penting

- Harga per stitch menggunakan **qty input**, bukan effective qty
- Effective qty hanya digunakan untuk perhitungan total stitch
- Semua setting harus bisa diubah tanpa deploy ulang
- Semua perubahan wajib tercatat di history

---

## 12. ✅ Status
- Versi: 1.0
- Tipe: MVP (Kalkulator Only)
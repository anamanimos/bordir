<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold mb-0">Pengaturan <span class="accent-text">Master</span></h3>
        <p class="text-muted">Konfigurasi variabel dasar algoritma kalkulator bordir.</p>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show glass-card border-success mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i> <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-12">
            <div class="glass-card h-100">
                <form action="<?= base_url('settings/save') ?>" method="POST">
                    <div class="row g-4">
                        <!-- Density & Min Qty -->
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-semibold">Kepadatan Benang (Stitch Density) per cm²</label>
                            <div class="input-group">
                                <span class="input-group-text glass-input border-end-0"><i class="bi bi-layers text-muted"></i></span>
                                <input type="number" class="form-control glass-input border-start-0" name="stitchDensity" value="<?= $config['stitchDensity'] ?>" required>
                            </div>
                            <div class="form-text mt-1 text-muted" style="font-size: 0.75rem;">Standar: 330. Semakin tinggi semakin presisi & mahal.</div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-semibold">Minimum Order (Effective Qty)</label>
                            <div class="input-group">
                                <span class="input-group-text glass-input border-end-0"><i class="bi bi-boxes text-muted"></i></span>
                                <input type="number" class="form-control glass-input border-start-0" name="minOrder" value="<?= $config['minOrder'] ?>" required>
                                <span class="input-group-text glass-input">Pcs</span>
                            </div>
                        </div>

                        <!-- Min Ukuran & Min Charge -->
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-semibold">Batas Minimum Luasan Desain</label>
                            <div class="input-group">
                                <span class="input-group-text glass-input border-end-0"><i class="bi bi-aspect-ratio text-muted"></i></span>
                                <input type="number" step="0.1" class="form-control glass-input border-start-0" name="minUkuran" value="<?= $config['minUkuran'] ?>" required>
                                <span class="input-group-text glass-input">cm²</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-semibold">Minimum Nominal Tagihan Harga</label>
                            <div class="input-group">
                                <span class="input-group-text glass-input border-end-0">Rp</span>
                                <input type="number" class="form-control glass-input border-start-0" name="minCharge" value="<?= $config['minCharge'] ?>" required>
                            </div>
                        </div>

                        <!-- Pembulatan -->
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-semibold">Metode Pembulatan Total</label>
                            <select class="form-select glass-input" name="pembulatanMethod" required>
                                <option value="ceil" <?= $config['pembulatanMethod'] == 'ceil' ? 'selected' : '' ?>>Ceil (Ratakan Ke Atas Maksimal)</option>
                                <option value="round" <?= $config['pembulatanMethod'] == 'round' ? 'selected' : '' ?>>Round (Bulatkan Terdekat Asli)</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-semibold">Threshold Kelipatan Nominal Uang</label>
                            <div class="input-group">
                                <span class="input-group-text glass-input border-end-0">Rp</span>
                                <select class="form-select glass-input border-start-0" name="pembulatanKelipatan" required>
                                    <option value="1" <?= $config['pembulatanKelipatan'] == 1 ? 'selected' : '' ?>>Akurat Murni (Tanpa Kelipatan)</option>
                                    <option value="100" <?= $config['pembulatanKelipatan'] == 100 ? 'selected' : '' ?>>Pecahan Ratusan (100)</option>
                                    <option value="500" <?= $config['pembulatanKelipatan'] == 500 ? 'selected' : '' ?>>Pecahan Ratusan Lima (500)</option>
                                    <option value="1000" <?= $config['pembulatanKelipatan'] == 1000 ? 'selected' : '' ?>>Pecahan Ribuan Utuh (1000)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12 mt-4 text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: var(--accent-color); border:none;"><i class="bi bi-cloud-arrow-up me-2"></i> Update Variabel Sistem</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

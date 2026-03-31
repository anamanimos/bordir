<div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: 70vh;">
    <div class="glass-card w-100" style="max-width: 450px;">
        <div class="text-center mb-4">
            <h3 class="fw-bold mb-1">Gate <span class="accent-text">Tertutup</span></h3>
            <p class="text-muted small">Silakan identifikasi diri untuk konfigurasi Master Sistem.</p>
        </div>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show glass-card border-danger mb-4 text-center" role="alert" style="padding: 1rem;">
                <i class="bi bi-shield-lock-fill me-2"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show glass-card border-success mb-4 text-center" role="alert" style="padding: 1rem;">
                <i class="bi bi-check-circle-fill me-2"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/process') ?>" method="POST">
            <div class="mb-4">
                <label class="form-label text-muted small fw-semibold">Username Administrator</label>
                <div class="input-group">
                    <span class="input-group-text glass-input border-end-0"><i class="bi bi-person-fill text-muted"></i></span>
                    <input type="text" name="username" class="form-control glass-input border-start-0 fw-bold" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label text-muted small fw-semibold">Password Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text glass-input border-end-0"><i class="bi bi-key-fill text-muted"></i></span>
                    <input type="password" name="password" class="form-control glass-input border-start-0 fw-bold" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 mt-2 fw-bold rounded-pill" style="background-color: var(--accent-color); border:none; letter-spacing: 1px;">
                <i class="bi bi-box-arrow-in-right me-2"></i> BUKA GERBANG SISTEM
            </button>
            
            <div class="text-center mt-4">
                <a href="<?= base_url() ?>" class="text-muted text-decoration-none small"><i class="bi bi-arrow-left me-1"></i> Kembali ke Kalkulus Kasir Publik</a>
            </div>
        </form>
    </div>
</div>

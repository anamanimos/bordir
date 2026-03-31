<nav id="sidebar">
    <div class="sidebar-header">
        <h4 class="mb-0 fw-bold">⚙️ <span style="color: var(--accent-color);">ERP Bordir</span></h4>
    </div>

    <ul class="list-unstyled components">
        <li class="<?= ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'welcome') ? 'active' : '' ?>">
            <a href="<?= base_url() ?>"><i class="bi bi-calculator me-2"></i> Kalkulator Harga</a>
        </li>
        
        <?php if($this->session->userdata('logged_in')): ?>
            <li class="<?= ($this->uri->segment(1) == 'settings') ? 'active' : '' ?>">
                <a href="<?= base_url('settings') ?>"><i class="bi bi-gear me-2"></i> Master Settings</a>
            </li>
            <li class="<?= ($this->uri->segment(1) == 'customerlevel') ? 'active' : '' ?>">
                <a href="<?= base_url('customerlevel') ?>"><i class="bi bi-people-fill me-2"></i> Master Pelanggan</a>
            </li>
            <li class="<?= ($this->uri->segment(1) == 'pricing') ? 'active' : '' ?>">
                <a href="<?= base_url('pricing') ?>"><i class="bi bi-cash-stack me-2"></i> Pricing Rules</a>
            </li>
            <li>
                <a href="#"><i class="bi bi-clock-history me-2"></i> Audit Trail <span class="badge bg-secondary ms-2" style="font-size: 0.6em;">Segera</span></a>
            </li>
            <li class="mt-5">
                <a href="<?= base_url('auth/logout') ?>" style="color: #ff6b6b;"><i class="bi bi-door-closed-fill me-2"></i> Keluar (Logout)</a>
            </li>
        <?php else: ?>
            <li class="mt-4">
                <a href="<?= base_url('auth/login') ?>" style="color: var(--accent-color); opacity: 0.8;"><i class="bi bi-shield-lock-fill me-2"></i> Login Pengelola</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

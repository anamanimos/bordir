<div class="top-header">
    <button type="button" id="sidebarCollapse" class="btn btn-light shadow-sm">
        <i class="bi bi-list fs-5"></i>
    </button>
    
    <div class="d-flex align-items-center gap-3">
        <!-- Theme Switcher -->
        <button id="global-theme-trigger" class="theme-toggler-btn" aria-label="Toggle Dark Mode">
            <i id="global-theme-icon" class="bi bi-moon fs-5"></i>
        </button>
        
        <!-- User Dropdown -->
        <?php if($this->session->userdata('logged_in')): ?>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false" style="color: var(--text-main);">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($this->session->userdata('username')) ?>&background=random" alt="Admin" width="38" height="38" class="rounded-circle me-2">
                <span class="fw-semibold d-none d-sm-inline"><?= ucfirst($this->session->userdata('username')) ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser">
                <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i> Keluar (Sign out)</a></li>
            </ul>
        </div>
        <?php else: ?>
        <a href="<?= base_url('auth/login') ?>" class="btn btn-sm rounded-pill px-3 fw-bold" style="background-color: var(--glass-bg); color: var(--accent-color); border: 1px solid var(--glass-border);">
            <i class="bi bi-person-bounding-box me-1"></i> Mode Tamu
        </a>
        <?php endif; ?>
    </div>
</div>

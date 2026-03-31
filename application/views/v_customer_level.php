<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold mb-0">Manajemen <span class="accent-text">Kategori Pelanggan</span></h3>
        <p class="text-muted">Desain sendiri tipe-tipe level pelanggan Anda untuk diferensiasi tarif eceran.</p>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show glass-card border-success mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i> <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show glass-card border-danger mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <div class="col-12">
            <div class="glass-card h-100">
                <div class="alert alert-warning border-0 rounded-3 mb-4 d-flex align-items-center" style="background: rgba(255, 150, 43, 0.1);">
                    <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-warning"></i>
                    <div class="small text-muted">Awas: Menghapus sebuah kategori akan mendelete riwayat harga diskonnya dari tabel <b>Pricing Rules</b>! Harap berhati-hati, namun menyunting namanya (Edit) adalah langkah aman bebas risiko.</div>
                </div>

                <form action="<?= base_url('customerlevel/save') ?>" method="POST">
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover align-middle">
                            <thead style="border-bottom: 2px solid var(--glass-border);">
                                <tr class="opacity-75 small text-uppercase" style="color: var(--input-text);">
                                    <th width="30%">Identity Code Sistem</th>
                                    <th width="60%">Nama Pelanggan (Label)</th>
                                    <th class="text-center" width="10%">Erase</th>
                                </tr>
                            </thead>
                            <tbody id="levelBody">
                                <?php if(!empty($levels)): ?>
                                    <?php foreach($levels as $lvl): ?>
                                    <tr class="level-row">
                                        <td>
                                            <input type="hidden" name="id[]" value="<?= $lvl['id'] ?>">
                                            <span class="badge bg-dark rounded-pill py-2 px-3 fw-normal" style="letter-spacing:1px;"><i class="bi bi-tag-fill me-2 opacity-50"></i> <?= $lvl['id'] ?></span>
                                        </td>
                                        <td>
                                            <input type="text" name="label[]" class="form-control glass-input fw-bold" value="<?= $lvl['label'] ?>" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle btn-remove"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr class="level-row">
                                        <td>
                                            <input type="hidden" name="id[]" value="">
                                            <span class="badge bg-secondary opacity-50">Otomatis Terbentuk</span>
                                        </td>
                                        <td>
                                            <input type="text" name="label[]" class="form-control glass-input fw-bold" value="Umum" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle btn-remove"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top: 1px solid var(--glass-border);">
                        <button type="button" id="btnAddRow" class="btn btn-outline-secondary px-3"><i class="bi bi-person-plus-fill me-2"></i>Tambah Kategori Klien</button>
                        <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: var(--accent-color); border:none;"><i class="bi bi-cloud-arrow-up me-2"></i> Susun Ulang Level</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="mb-4">
        <h3 class="fw-bold mb-0">Pricing <span class="accent-text">Rules</span></h3>
        <p class="text-muted">Skema diskon harga tusukan benang dinamis berdampingan lintas "Kategori Pelanggan".</p>
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
                <div class="alert alert-info border-0 rounded-3 mb-4 d-flex align-items-center" style="background: rgba(43, 210, 255, 0.1);">
                    <i class="bi bi-info-circle-fill fs-4 me-3 text-info"></i>
                    <div class="small text-muted">Tarif diselaraskan langsung via tabel dinamis pembacaan Master Pelanggan. Jika kolom *Max Qty* dikosongkan, pesanan bermakna hingga tak terbatas (&infin;).</div>
                </div>

                <form action="<?= base_url('pricing/save') ?>" method="POST">
                    <div class="table-responsive">
                        <table class="table table-borderless table-hover align-middle text-center" id="pricingTable">
                            <thead style="border-bottom: 2px solid var(--glass-border);">
                                <tr class="opacity-75 small text-uppercase" style="color: var(--input-text);">
                                    <th width="15%" title="Minimum Order Item">Min Qty</th>
                                    <th width="15%">Max Qty</th>
                                    <?php foreach($levels as $lvl): ?>
                                        <th>T. <span class="text-main fw-bold border-bottom"><?= $lvl['label'] ?></span> (Rp)</th>
                                    <?php endforeach; ?>
                                    <th width="8%">Erase</th>
                                </tr>
                            </thead>
                            <tbody id="pricingBody">
                                <?php if(!empty($rules)): ?>
                                    <?php foreach($rules as $r): ?>
                                    <tr class="pricing-row">
                                        <td>
                                            <input type="number" name="min_qty[]" class="form-control glass-input text-center fw-bold" value="<?= $r['min_qty'] ?>" required min="1">
                                        </td>
                                        <td>
                                            <input type="number" name="max_qty[]" class="form-control glass-input text-center fw-bold" value="<?= (isset($r['max_qty']) && $r['max_qty'] >= 999999) ? '' : $r['max_qty'] ?>" placeholder="&infin;">
                                        </td>
                                        <?php foreach($levels as $lvl): 
                                            $price_value = isset($r['prices'][$lvl['id']]) ? $r['prices'][$lvl['id']] : 15;
                                        ?>
                                        <td>
                                            <input type="number" step="0.01" name="prices[<?= $lvl['id'] ?>][]" class="form-control glass-input px-2 text-center fw-bold" value="<?= $price_value ?>" required min="0">
                                        </td>
                                        <?php endforeach; ?>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm rounded-circle btn-remove"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mt-3 pt-3" style="border-top: 1px solid var(--glass-border);">
                        <button type="button" id="btnAddRow" class="btn btn-outline-secondary px-3"><i class="bi bi-stack me-2"></i> Tambah Lapisan Diskon</button>
                        <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: var(--accent-color); border:none;"><i class="bi bi-cloud-arrow-up me-2"></i> Sinkronisasi Tabel Integrasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

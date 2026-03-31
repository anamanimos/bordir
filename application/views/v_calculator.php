
<div class="container-fluid">
    <!-- Page Titling -->
    <div class="mb-4">
        <h3 class="fw-bold mb-0">Estimasi <span class="accent-text">Biaya Bordir</span></h3>
        <p class="text-muted">Hitung kalkulasi jahitan dan harga secara otomatis.</p>
    </div>

    <div class="row g-4">
        <!-- Input Form (Left) -->
        <div class="col-12 col-lg-5">
            <div class="glass-card h-100">
                <h5 class="fw-bold mb-4"><i class="bi bi-rulers me-2 accent-text"></i> Parameter Order</h5>
                
                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold">Jenis Skema Pelanggan</label>
                    <div class="input-group">
                        <span class="input-group-text glass-input border-end-0"><i class="bi bi-person-badge text-muted"></i></span>
                        <select id="inputKategori" class="form-select glass-input border-start-0 fw-bold" style="color: var(--accent-color);">
                            <?php if(!empty($levels)): ?>
                                <?php foreach($levels as $index => $l): ?>
                                    <option value="<?= $l['id'] ?>" <?= $index === 0 ? 'selected' : '' ?>><?= $l['label'] ?></option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="umum" selected>Umum (Tidak terdefinisi)</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold">Lebar Desain (cm)</label>
                    <div class="input-group">
                        <input type="number" id="inputLebar" class="form-control glass-input fw-semibold" placeholder="0" min="0" step="0.1">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold">Panjang Desain (cm)</label>
                    <div class="input-group">
                        <input type="number" id="inputPanjang" class="form-control glass-input fw-semibold" placeholder="0" min="0" step="0.1">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold">Kuantitas (pcs)</label>
                    <div class="input-group">
                        <input type="number" id="inputQty" class="form-control glass-input fw-semibold" placeholder="0" min="0">
                    </div>
                    <div class="form-text mt-2" style="font-size: 0.8rem; color: var(--text-muted)">
                        *Minimum order (efektif): 6 pcs.
                    </div>
                </div>
            </div>
        </div>

        <!-- Output Result Panel (Right) -->
        <div class="col-12 col-lg-7">
            <div class="glass-card h-100 d-flex flex-column">
                <h5 class="fw-bold mb-4"><i class="bi bi-receipt me-2 accent-text"></i> Breakdown Biaya</h5>
                
                <div class="row g-3 mb-4 flex-grow-1">
                    <div class="col-6 col-md-6">
                        <div class="result-card">
                            <div class="text-muted small mb-1">Stitch per pcs</div>
                            <div class="fw-bold fs-5" id="outStitchItem">0</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6">
                        <div class="result-card" style="border-left: 3px solid var(--accent-color);">
                            <div class="text-muted small mb-1">Harga Dasar / Stitch</div>
                            <div class="fw-bold fs-5" style="color: var(--accent-color);" id="outPriceStitch">Rp 0</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="result-card">
                            <div class="text-muted small mb-1">Total Jahitan</div>
                            <div class="fw-bold fs-5" id="outTotalStitch">0</div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="result-card">
                            <div class="text-muted small mb-1">Harga Satuan (Ecer)</div>
                            <div class="fw-bold fs-5 accent-text" id="outPricePcs">Rp 0</div>
                        </div>
                    </div>
                </div>

                <div class="total-price-card mt-auto d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-white-50 mb-1 fw-semibold text-uppercase" style="letter-spacing: 1px;">Harga Total</div>
                        <div class="fs-2 fw-bold" id="outTotalHarga" style="line-height:1;">Rp 0</div>
                    </div>
                    <div>
                        <i class="bi bi-wallet2" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

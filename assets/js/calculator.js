document.addEventListener('DOMContentLoaded', () => {

    // Membaca Data API Payload JSON dari Controller Backend (ataupun nilai Default Mockup)
    const config = window.APP_CONFIG || {
        minUkuran: 1, 
        minOrder: 6, 
        stitchDensity: 330,
        minCharge: 0, 
        pembulatanMethod: 'ceil',
        pembulatanKelipatan: 100 
    };

    const priceRules = window.PRICE_RULES || [
        { min_qty: 1, max_qty: 11, price_umum: 15, price_reseller: 12, price_maklun: 10 },
        { min_qty: 12, max_qty: 23, price_umum: 12, price_reseller: 10, price_maklun: 8 },
        { min_qty: 24, max_qty: 999999, price_umum: 10, price_reseller: 8, price_maklun: 6 }
    ];

    // DOM Elements
    const inputKategori = document.getElementById('inputKategori');
    const inputLebar = document.getElementById('inputLebar');
    const inputPanjang = document.getElementById('inputPanjang');
    const inputQty = document.getElementById('inputQty');
    
    const outStitchItem = document.getElementById('outStitchItem');
    const outPriceStitch = document.getElementById('outPriceStitch');
    const outTotalStitch = document.getElementById('outTotalStitch');
    const outPricePcs = document.getElementById('outPricePcs');
    const outTotalHarga = document.getElementById('outTotalHarga');

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }
    
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    function calculate() {
        if(!inputLebar) return; 
        
        const kategori = inputKategori ? inputKategori.value : 'umum';
        const lebar = parseFloat(inputLebar.value) || 0;
        const panjang = parseFloat(inputPanjang.value) || 0;
        const qty = parseInt(inputQty.value) || 0;

        // Validasi
        if (lebar <= 0 || panjang <= 0 || qty <= 0) {
            outStitchItem.textContent = '0';
            if (outPriceStitch) outPriceStitch.textContent = 'Rp 0';
            outTotalStitch.textContent = '0';
            outPricePcs.textContent = 'Rp 0';
            outTotalHarga.textContent = 'Rp 0';
            return;
        }

        let luas = lebar * panjang;
        if (luas < config.minUkuran) luas = config.minUkuran;

        const stitchItem = luas * config.stitchDensity;
        const effectiveQty = qty < config.minOrder ? config.minOrder : qty;
        const totalStitch = stitchItem * effectiveQty;

        let pricePerStitch = 0;
        for (const rule of priceRules) {
            if (qty >= rule.min_qty && (rule.max_qty === '' || rule.max_qty === null || rule.max_qty === 999999 || qty <= rule.max_qty)) {
                
                if (rule.prices && rule.prices[kategori] !== undefined) {
                    pricePerStitch = rule.prices[kategori];
                } else if (rule.prices && rule.prices['umum'] !== undefined) {
                    // Fallback
                    pricePerStitch = rule.prices['umum'];
                } else if (rule.price !== undefined) {
                    // Legacy Fallback
                    pricePerStitch = rule.price;
                }
                
                break;
            }
        }
        
        if (pricePerStitch === 0) pricePerStitch = 15; 

        let totalHarga = totalStitch * pricePerStitch;

        if (totalHarga < config.minCharge) {
            totalHarga = config.minCharge;
        }

        if (config.pembulatanMethod === 'ceil') {
            totalHarga = Math.ceil(totalHarga / config.pembulatanKelipatan) * config.pembulatanKelipatan;
        } else {
            totalHarga = Math.round(totalHarga / config.pembulatanKelipatan) * config.pembulatanKelipatan;
        }

        const hargaPerPcs = Math.ceil(totalHarga / qty);

        // Output UI
        outStitchItem.textContent = formatNumber(stitchItem);
        if(outPriceStitch) outPriceStitch.textContent = formatRupiah(pricePerStitch);
        outTotalStitch.textContent = formatNumber(totalStitch);
        outPricePcs.textContent = formatRupiah(hargaPerPcs);
        outTotalHarga.textContent = formatRupiah(totalHarga);
    }

    if(inputLebar) {
        ['input', 'keyup', 'change'].forEach(evt => {
            if(inputKategori) inputKategori.addEventListener(evt, calculate);
            inputLebar.addEventListener(evt, calculate);
            inputPanjang.addEventListener(evt, calculate);
            inputQty.addEventListener(evt, calculate);
        });
        calculate();
    }
});

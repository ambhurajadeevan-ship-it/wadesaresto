@extends('layouts.app')

@section('content')
<section class="booking-wrapper">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="booking-card">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">Pembayaran Reservasi</h3>
                    <p class="text-muted">Selesaikan pembayaran biaya reservasi untuk mengonfirmasi booking Anda</p>
                </div>

                <div class="confirmation-box mb-4">
                    <h5 class="mb-3 border-bottom pb-2">Ringkasan Reservasi</h5>

                    <div class="confirm-row">
                        <span>Area</span>
                        <strong>{{ $reservasi->area->nama_area ?? '-' }}</strong>
                    </div>

                    @if($reservasi->meja)
                    <div class="confirm-row">
                        <span>Meja</span>
                        <strong>{{ $reservasi->meja->kode_meja }}</strong>
                    </div>
                    @endif

                    <div class="confirm-row">
                        <span>Waktu</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->format('d M Y') }}
                            | {{ \Carbon\Carbon::parse($reservasi->jam_reservasi)->format('H:i') }}
                            - {{ \Carbon\Carbon::parse($reservasi->jam_selesai)->format('H:i') }}
                        </strong>
                    </div>

                    <div class="confirm-row">
                        <span>Jumlah Orang</span>
                        <strong>{{ $reservasi->jumlah_orang }} Orang</strong>
                    </div>

                    <div class="confirm-row mt-3 border-top pt-3">
                        <span class="fw-bold text-dark">Total Biaya Reservasi</span>
                        <strong class="text-primary fs-5">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</strong>
                    </div>
                </div>

                {{-- INFO MENU PESANAN (jika ada) --}}
                @if($reservasi->menus->count() > 0)
                <div class="p-3 border rounded bg-light mb-4">
                    <h6 class="fw-semibold mb-2">
                        <i class="bi bi-list-ul"></i> Pesanan Menu
                        <span class="badge bg-secondary ms-1" style="font-size:11px;">Bayar di Tempat</span>
                    </h6>
                    @foreach($reservasi->menus as $menu)
                    <div class="d-flex justify-content-between py-1 border-bottom">
                        <span class="small">{{ $menu->nama_menu }} (x{{ $menu->pivot->jumlah }})</span>
                        <span class="small text-muted">Rp {{ number_format($menu->pivot->harga_saat_ini * $menu->pivot->jumlah, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                    <div class="small text-muted mt-2">
                        <i class="bi bi-info-circle"></i> Harga menu dibayar langsung di tempat saat kedatangan.
                    </div>
                </div>
                @endif

                <div class="payment-methods">
                    <h5 class="mb-3">Pilih Metode Pembayaran</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="payment-option w-100">
                                <input type="radio" name="metode" value="M-Banking" class="d-none">
                                <div class="p-3 border rounded text-center cursor-pointer method-card">
                                    <i class="bi bi-bank fs-3 d-block mb-2"></i>
                                    <span>M-Banking</span>
                                </div>
                            </label>
                        </div>
                        <div class="col-6">
                            <label class="payment-option w-100">
                                <input type="radio" name="metode" value="QRIS" class="d-none">
                                <div class="p-3 border rounded text-center cursor-pointer method-card">
                                    <i class="bi bi-qr-code-scan fs-3 d-block mb-2"></i>
                                    <span>QRIS</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- INFO M-BANKING --}}
                <div id="info-MBanking" class="mt-4 p-4 border rounded bg-light d-none">

                    <h6 class="fw-bold mb-3">Transfer ke Rekening:</h6>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bank</span>
                        <span class="fw-semibold">BCA</span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted">No. Rekening</span>
                        
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-bold fs-5">
                                {{ $setting->rekening ?? '-' }}
                            </span>

                            <button onclick="copyRek()" 
                                class="btn btn-sm btn-outline-secondary">
                                Copy
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Jumlah Transfer</span>
                        <span class="fw-bold text-primary">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Atas Nama</span>
                        <span class="fw-semibold">WADESA RESTO</span>
                    </div>

                    <div class="small text-muted">
                        *Silakan simpan bukti transfer untuk verifikasi.
                    </div>

                </div>

                {{-- INFO QRIS --}}
                <div id="info-QRIS" class="mt-4 p-3 border rounded bg-white d-none text-center">
                    <h6 class="fw-bold mb-3">Scan QRIS untuk Membayar:</h6>
                    <p class="text-muted small">Jumlah: <strong class="text-primary">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</strong></p>
                    @if($setting && $setting->qris)
                        <img src="{{ asset('storage/'.$setting->qris) }}"
                            class="img-fluid rounded border"
                            style="max-width: 250px;">
                    @else
                        <p class="text-muted">QRIS belum tersedia</p>
                    @endif
                    <div class="mt-2 small text-muted">
                        *Scan menggunakan aplikasi e-wallet atau mobile banking Anda.
                    </div>
                </div>

                {{-- UPLOAD BUKTI PEMBAYARAN --}}
                <div class="mt-4 p-3 border rounded bg-light">
                    <h6 class="fw-bold mb-2">Upload Bukti Pembayaran</h6>
                    <p class="small text-muted mb-3">Upload screenshot atau foto bukti transfer/pembayaran Anda (JPG, PNG, atau PDF, maks. 2MB)</p>
                    
                    <div class="mb-3">
                        <input type="file" id="buktiBayar" class="form-control" accept="image/jpeg,image/jpg,image/png,application/pdf">
                    </div>
                    
                    {{-- Preview Image --}}
                    <div id="previewContainer" class="d-none mt-3 text-center">
                        <p class="small text-muted mb-2">Preview:</p>
                        <img id="previewImage" class="img-fluid rounded border" style="max-height: 200px;">
                        <p id="pdfName" class="small fw-bold mt-2 d-none"></p>
                    </div>
                </div>

                <button id="btnPay" class="btn-premium w-100 mt-4 btn-disabled" disabled>
                    Konfirmasi Pembayaran
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .method-card {
        transition: 0.3s;
        cursor: pointer;
    }
    .payment-option input:checked + .method-card {
        border-color: #1F3D36 !important;
        background: rgba(31,61,54,0.05);
        color: #1F3D36;
        box-shadow: 0 0 0 2px #1F3D36;
    }
    .cursor-pointer { cursor: pointer; }
</style>

<script>
    const radios = document.querySelectorAll('input[name="metode"]');
    const btnPay = document.getElementById('btnPay');
    const infoBanking = document.getElementById('info-MBanking');
    const infoQRIS = document.getElementById('info-QRIS');
    const buktiBayar = document.getElementById('buktiBayar');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const pdfName = document.getElementById('pdfName');

    let selectedMethod = null;
    let selectedFile = null;

    // Handle payment method selection
    radios.forEach(r => {
        r.addEventListener('change', (e) => {
            selectedMethod = e.target.value;
            checkButtonState();

            if (e.target.value === 'M-Banking') {
                infoBanking.classList.remove('d-none');
                infoQRIS.classList.add('d-none');
            } else {
                infoQRIS.classList.remove('d-none');
                infoBanking.classList.add('d-none');
            }
        });
    });

    // Handle file upload and preview
    buktiBayar.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (!file) {
            selectedFile = null;
            previewContainer.classList.add('d-none');
            checkButtonState();
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            Swal.fire({ icon: 'error', title: 'File Terlalu Besar', text: 'Ukuran file maksimal 2MB' });
            e.target.value = '';
            selectedFile = null;
            previewContainer.classList.add('d-none');
            checkButtonState();
            return;
        }

        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
        if (!validTypes.includes(file.type)) {
            Swal.fire({ icon: 'error', title: 'Format File Tidak Valid', text: 'Hanya file JPG, PNG, atau PDF yang diperbolehkan' });
            e.target.value = '';
            selectedFile = null;
            previewContainer.classList.add('d-none');
            checkButtonState();
            return;
        }

        selectedFile = file;
        previewContainer.classList.remove('d-none');
        
        if (file.type === 'application/pdf') {
            previewImage.classList.add('d-none');
            pdfName.classList.remove('d-none');
            pdfName.innerHTML = '<i class="bi bi-file-pdf fs-1 text-danger"></i><br>' + file.name;
        } else {
            previewImage.classList.remove('d-none');
            pdfName.classList.add('d-none');
            const reader = new FileReader();
            reader.onload = function(e) { previewImage.src = e.target.result; }
            reader.readAsDataURL(file);
        }
        
        checkButtonState();
    });

    function copyRek(){
        navigator.clipboard.writeText("{{ $setting->rekening ?? '' }}");
        Swal.fire({ icon:'success', title:'Berhasil', text:'Nomor rekening disalin' });
    }

    function checkButtonState() {
        if (selectedMethod && selectedFile) {
            btnPay.disabled = false;
            btnPay.classList.remove('btn-disabled');
            btnPay.classList.add('btn-enabled');
        } else {
            btnPay.disabled = true;
            btnPay.classList.add('btn-disabled');
            btnPay.classList.remove('btn-enabled');
        }
    }

    btnPay.onclick = function() {
        if (!selectedMethod || !selectedFile) {
            Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Silakan pilih metode pembayaran dan upload bukti pembayaran terlebih dahulu' });
            return;
        }
        
        btnPay.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
        btnPay.disabled = true;

        const formData = new FormData();
        formData.append('metode_pembayaran', selectedMethod);
        formData.append('bukti_pembayaran', selectedFile);

        fetch("{{ route('payment.process', $reservasi->id_reservasi) }}", {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire({ icon: 'success', title: 'Berhasil!', text: data.message, timer: 2000, showConfirmButton: false })
                .then(() => { window.location.href = data.redirect; });
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal', text: data.message || 'Terjadi kesalahan saat memproses pembayaran' });
                btnPay.innerHTML = 'Konfirmasi Pembayaran';
                btnPay.disabled = false;
            }
        })
        .catch(error => {
            Swal.fire({ icon: 'error', title: 'Gagal', text: 'Terjadi kesalahan saat memproses pembayaran' });
            btnPay.innerHTML = 'Konfirmasi Pembayaran';
            btnPay.disabled = false;
        });
    }
</script>
</section>
@endsection
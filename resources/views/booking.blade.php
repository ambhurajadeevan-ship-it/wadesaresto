@extends('layouts.app')

@section('content')

<section class="booking-wrapper">

<div class="container">
<div class="row justify-content-center">
<div class="col-lg-6 col-md-8">

<div class="booking-card">
<div class="reservation-header px-4 py-3">

    <div class="d-flex justify-content-between align-items-center">

        {{-- LEFT --}}
        <div class="d-flex align-items-center gap-3">

            <img src="{{ asset('images/logo.png') }}"
                 width="80"
                 height="80"
                 style="object-fit:contain">

            <div>
                <div class=reservation-name>
                    WADESA
                </div>
                <small class="text-muted">
                    Warung Kopi & Resto
                </small>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="text-end booking-info">

            <div class="open-label text-center">
                OPEN DAILY
            </div>

            <div class="open-time text-center">
                07.00 AM - 20.00 PM
            </div>
            
            <div class="open-address text-center">
                Batunya, Kec. Baturiti, <br>
                Kab. Tabanan, Bali 82191
            </div>

        </div>

    </div>

</div>

{{-- ================= STEP NAV ================= --}}
<div class="step-wrapper">

<div class="step-item active" id="nav1">
<div class="step-circle">1</div>
<div class="step-label">Reservasi</div>
</div>

<div class="step-line"></div>

<div class="step-item" id="nav2">
<div class="step-circle">2</div>
<div class="step-label">Informasi</div>
</div>

<div class="step-line"></div>

<div class="step-item" id="nav3">
<div class="step-circle">3</div>
<div class="step-label">Konfirmasi</div>
</div>

</div>

<hr class="divider-gold">

{{-- ================= STEP 1 ================= --}}
<div id="step1">

<div class="form-floating-group">
    <input type="number" id="jumlah" min="1" value="1" required>
    <label>Jumlah Orang</label>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-floating-group">
            <input type="date"
                   id="tanggal"
                   min="{{ $today }}"
                   required>
            <label>Tanggal Reservasi</label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-6">
        <div class="form-floating-group">
            <select id="jam" required>
                <option value=""></option>
                @for($i=8;$i<=19;$i++)
                <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}:00">
                    {{ str_pad($i,2,'0',STR_PAD_LEFT) }}:00
                </option>
                @endfor
            </select>
            <label>Jam Mulai</label>
        </div>
    </div>

    <div class="col-6">
        <div class="form-floating-group">
            <select id="jam_selesai" required disabled>
                <option value=""></option>
                @for($i=9;$i<=20;$i++)
                <option value="{{ str_pad($i,2,'0',STR_PAD_LEFT) }}:00">
                    {{ str_pad($i,2,'0',STR_PAD_LEFT) }}:00
                </option>
                @endfor
            </select>
            <label>Jam Selesai</label>
        </div>
    </div>
</div>

{{-- AREA --}}
<div class="form-floating-group">
<select id="area" required>
<option value=""></option>

@foreach($areas as $area)

@if($area->meja->count() > 0)

<option value="{{ $area->id_area }}"
        data-has-meja="1"
        data-harga="{{ $area->harga }}">
{{ $area->nama_area }} (Rp {{ number_format($area->harga, 0, ',', '.') }})
</option>

@else

<option value="{{ $area->id_area }}"
        data-has-meja="0"
        data-max="{{ $area->kapasitas }}"
        data-harga="{{ $area->harga }}">
{{ $area->nama_area }} (Max {{ $area->kapasitas }} Orang - Rp {{ number_format($area->harga, 0, ',', '.') }})
</option>

@endif

@endforeach

</select>
<label>Pilih Area</label>
</div>

{{-- MEJA --}}
<div class="form-floating-group"
     id="mejaWrapper"
     style="display:none;">
<select id="meja">
<option value=""></option>
</select>
<label>Pilih Meja</label>
</div>

{{-- MENU SELECTION (Integrated into Step 1) --}}
<div class="menu-section mt-4">
    <h6 class="mb-3 fw-bold">Pilih Menu (Wajib)</h6>

    <div class="menu-list border rounded p-2" style="max-height: 250px; overflow-y: auto;">
        @foreach($menus as $menu)
        <div class="d-flex align-items-center justify-content-between p-2 border-bottom 
        {{ !$menu->is_available ? 'opacity-50' : '' }}">

            <!-- INFO MENU -->
            <div class="small">
                <div class="fw-bold">
                    {{ $menu->nama_menu }}

                    @if(!$menu->is_available)
                        <span style="color:red; font-size:12px;">
                            (Tidak tersedia)
                        </span>
                    @endif
                </div>

                <div class="text-muted">
                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                </div>
            </div>

            <!-- CONTROL QTY -->
            <div class="d-flex align-items-center gap-2">

                <!-- MINUS -->
                <button type="button"
                    class="btn btn-sm btn-light btn-minus"
                    data-id="{{ $menu->id_menu }}"
                    {{ !$menu->is_available ? 'disabled' : '' }}>
                    -
                </button>

                <!-- QTY -->
                <input type="number"
                    class="form-control form-control-sm text-center menu-qty"
                    id="qty_{{ $menu->id_menu }}"
                    data-id="{{ $menu->id_menu }}"
                    data-harga="{{ $menu->harga }}"
                    value="0"
                    readonly
                    style="width: 40px; border:none; background:transparent;">

                <!-- PLUS -->
                <button type="button"
                    class="btn btn-sm btn-light btn-plus"
                    data-id="{{ $menu->id_menu }}"
                    {{ !$menu->is_available ? 'disabled' : '' }}>
                    +
                </button>

            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="price-summary mt-3 p-3 bg-light rounded small">
    <div class="d-flex justify-content-between">
        <span>Subtotal Area/Meja:</span>
        <span id="summary-area-price">Rp 0</span>
    </div>
    <div class="d-flex justify-content-between">
        <span>Subtotal Menu:</span>
        <span id="summary-menu-price">Rp 0</span>
    </div>
    <hr class="my-2">
    <div class="d-flex justify-content-between fw-bold">
        <span>Estimasi Total:</span>
        <span id="summary-total-price">Rp 0</span>
    </div>
</div>

<p id="notif" class="text-danger small mt-2"></p>

<button id="btnNext"
class="btn-premium w-100 mt-3 btn-disabled"
disabled>
Next
</button>

</div>

{{-- ================= STEP 2 (INFO) ================= --}}
<div id="step2" style="display:none">

    <div class="form-floating-group mb-3">
        <input type="text" id="nama" value="{{ Auth::user()->name }}" required>
        <label>Nama Lengkap</label>
    </div>

    <div class="form-floating-group mb-3">
        <input type="email" id="email" value="{{ Auth::user()->email }}" required>
        <label>Email</label>
    </div>

    <div class="form-floating-group mb-3">
        <input type="text" id="hp" value="{{ Auth::user()->no_hp }}" required>
        <label>No HP</label>
    </div>

    <div class="form-floating-group mb-4">
        <textarea id="catatan"></textarea>
        <label>Catatan (Opsional)</label>
    </div>

    <p id="notifInfo" class="text-danger small mb-3"></p>

    <div class="d-flex gap-2">

        <button id="btnBack"
        class="btn btn-outline-secondary w-50">
            Back
        </button>

        <button id="btnConfirm"
        class="btn-premium w-50 btn-disabled"
        disabled>
            Lanjut ke Pembayaran
        </button>

    </div>

</div>

</div>
</div>
</div>
</div>

<script>

const mejaByArea = @json($mejaByArea);

const jumlah  = document.getElementById('jumlah');
const tanggal = document.getElementById('tanggal');
const jam     = document.getElementById('jam');
const jamSelesai = document.getElementById('jam_selesai');
const area    = document.getElementById('area');
const meja    = document.getElementById('meja');

const mejaWrapper = document.getElementById('mejaWrapper');
const btnNext     = document.getElementById('btnNext');
const notif       = document.getElementById('notif');


// ================= AREA CHANGE =================
area.addEventListener('change', function(){

    let areaId   = this.value;
    let selected = this.options[this.selectedIndex];
    let hasMeja  = selected.dataset.hasMeja;

    meja.innerHTML = `<option value=""></option>`;

    // ❌ AREA TANPA MEJA
    if(hasMeja == "0"){

        mejaWrapper.style.display = "none";
        meja.required = false;
        meja.value    = "";

        cek();
        return;
    }

    // ✅ AREA PUNYA MEJA
    mejaWrapper.style.display = "block";
    meja.required = true;

    mejaByArea[areaId].forEach(function(m){

        meja.innerHTML += `
            <option 
                value="${m.id_meja}"
                data-kapasitas="${m.kapasitas}"
                data-harga="${m.harga}">
                ${m.kode_meja} (${m.kapasitas} Orang - Rp ${new Intl.NumberFormat('id-ID').format(m.harga)})
            </option>
        `;

    });

    cek();

});


// ================= TRIGGER =================
[jumlah,tanggal,jam,jamSelesai,area,meja]
.forEach(el => el.addEventListener('change',cek));

jumlah.addEventListener('input', cek);

jumlah.addEventListener('input', function(){
    if (this.value < 1) {
        this.value = 1;
    }
});


// ================= CHECK =================
function cek(){

    let selectedArea = area.options[area.selectedIndex];
    if(!selectedArea) return;

    let hasMeja = selectedArea.dataset.hasMeja;

    // VALIDASI DASAR
    if(!jumlah.value || !tanggal.value || !jam.value || !jamSelesai.value || !area.value){
        disableNext("Lengkapi semua pilihan reservasi");
        return;
    }

    // ================= AREA TANPA MEJA =================
    if(hasMeja == "0"){

        fetchAvailability(null);
        return;
    }

    // ================= AREA PUNYA MEJA =================
    if(hasMeja == "1" && !meja.value){
        disableNext("Pilih meja terlebih dahulu");
        return;
    }

    // ================= VALIDASI KAPASITAS MEJA =================
    let selectedMeja  = meja.options[meja.selectedIndex];
    let kapasitasMeja = parseInt(selectedMeja.dataset.kapasitas);

    if(parseInt(jumlah.value) > kapasitasMeja){
        disableNext(
            "Jumlah orang melebihi kapasitas meja (" 
            + kapasitasMeja + " Orang)"
        );
        return;
    }

    if(parseInt(jumlah.value) < 1){
        disableNext("Jumlah orang minimal 1");
        return;
    }

    fetchAvailability(meja.value);

}


// ================= FETCH AVAILABILITY =================
function fetchAvailability(idMeja){

    let payload = {
        jumlah_orang : jumlah.value,
        tanggal      : tanggal.value,
        jam          : jam.value,
        jam_selesai  : jamSelesai.value,
        id_area      : area.value,
        id_meja      : idMeja
    };

    fetch("{{ route('booking.check') }}",{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':
            document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify(payload)
    })
    .then(res=>res.json())
    .then(data=>{

        if(data.available){
            enableNext();
            notif.innerHTML="";
        }else{
            disableNext(data.message);
        }

    });

}


// ================= BTN =================
function enableNext(){
    let menuPrice = calculateTotal();
    
    if (menuPrice > 0) {
        btnNext.disabled = false;
        btnNext.classList.remove('btn-disabled');
        btnNext.classList.add('btn-enabled');
        notif.innerHTML = "";
    } else {
        disableNext("Pilih minimal satu menu");
    }
}

function disableNext(msg=""){
    btnNext.disabled=true;
    btnNext.classList.remove('btn-enabled');
    btnNext.classList.add('btn-disabled');
    notif.innerHTML = msg;
}


// ================= STEP TRANSITION =================
btnNext.onclick=function(){
    step1.style.display="none";
    step2.style.display="block";
    nav1.classList.remove('active');
    nav2.classList.add('active');
    cekStep2();
}

btnBack.onclick=function(){
    step2.style.display="none";
    step1.style.display="block";
    nav2.classList.remove('active');
    nav1.classList.add('active');
}


// ================= MENU QUANTITY =================
document.querySelectorAll('.btn-plus').forEach(btn => {
    btn.addEventListener('click', function () {
        if (this.disabled) return;

        let id = this.dataset.id;
        let input = document.getElementById('qty_' + id);

        input.value = parseInt(input.value) + 1;

        calculateTotal();
        cek();
    });
});

document.querySelectorAll('.btn-minus').forEach(btn => {
    btn.addEventListener('click', function () {
        if (this.disabled) return;

        let id = this.dataset.id;
        let input = document.getElementById('qty_' + id);

        if (parseInt(input.value) > 0) {
            input.value = parseInt(input.value) - 1;
        }

        calculateTotal();
        cek();
    });
});

function calculateTotal() {
    let areaPrice = 0;
    let mejaPrice = 0;
    let menuPrice = 0;

    let selectedArea = area.options[area.selectedIndex];
    if (selectedArea && selectedArea.value) {
        areaPrice = parseFloat(selectedArea.dataset.harga || 0);
    }

    let selectedMeja = meja.options[meja.selectedIndex];
    if (selectedMeja && selectedMeja.value) {
        mejaPrice = parseFloat(selectedMeja.dataset.harga || 0);
    }

    document.querySelectorAll('.menu-qty').forEach(input => {
        let qty = parseInt(input.value);
        let price = parseFloat(input.dataset.harga);
        menuPrice += (qty * price);
    });

    let totalAreaMeja = areaPrice + mejaPrice;
    let grandTotal = totalAreaMeja + menuPrice;

    document.getElementById('summary-area-price').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalAreaMeja);
    document.getElementById('summary-menu-price').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(menuPrice);
    document.getElementById('summary-total-price').innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);

    return menuPrice;
}


// ================= FILTER JAM =================
tanggal.addEventListener('change', function(){
    filterJamHariIni();
    cek();
});

jam.addEventListener('change', function() {
    filterJamSelesai();
    cek();
});

function filterJamSelesai() {
    let startVal = jam.value;
    if(!startVal) {
        jamSelesai.disabled = true;
        jamSelesai.value = "";
        return;
    }

    jamSelesai.disabled = false;
    let startHour = parseInt(startVal.split(':')[0]);

    [...jamSelesai.options].forEach(o => {
        if(!o.value) return;
        let h = parseInt(o.value.split(':')[0]);
        if(h <= startHour) {
            o.disabled = true;
            if(o.selected) jamSelesai.value = "";
        } else {
            o.disabled = false;
        }
    });
}

window.onload = function() {
    filterJamHariIni();
    calculateTotal();
    cek();
};

function filterJamHariIni(){

    let selectedDate = tanggal.value;
    let today = new Date().toISOString().slice(0,10);

    [...jam.options].forEach(o=>{
        if(!o.value) return;
        o.disabled=false;
    });

    if(selectedDate !== today) return;

    let now = new Date();
    now.setHours(now.getHours()+1);
    let minimal = now.getHours();

    [...jam.options].forEach(o=>{
        if(!o.value) return;
        let j=parseInt(o.value.split(':')[0]);
        if(j < minimal){
            o.disabled=true;
            if(o.selected) jam.value="";
        }
    });

}

// ================= STEP 2 VALIDATION =================
const nama       = document.getElementById('nama');
const email      = document.getElementById('email');
const hp         = document.getElementById('hp');
const btnConfirm = document.getElementById('btnConfirm');
const notifInfo  = document.getElementById('notifInfo');
const catatan = document.getElementById('catatan');


// ================= AUTO BLOCK HURUF HP =================
hp.addEventListener('input', function(){
    this.value = this.value.replace(/[^0-9]/g,'');
    cekStep2();
});

[nama,email]
.forEach(el=>el.addEventListener('input',cekStep2));


// ================= EMAIL REGEX =================
function validEmail(email){
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}


// ================= VALIDASI STEP 2 =================
function cekStep2(){

    if(!nama.value || !email.value || !hp.value){
        disableConfirm("Lengkapi data pelanggan");
        return;
    }

    if(!validEmail(email.value)){
        disableConfirm("Format email tidak valid");
        return;
    }

    if(hp.value.length < 10){
        disableConfirm("Nomor HP minimal 10 digit");
        return;
    }

    enableConfirm();
}

function enableConfirm(){
    btnConfirm.disabled=false;
    btnConfirm.classList.remove('btn-disabled');
    btnConfirm.classList.add('btn-enabled');
    notifInfo.innerHTML="";
}

function disableConfirm(msg=""){
    btnConfirm.disabled=true;
    btnConfirm.classList.remove('btn-enabled');
    btnConfirm.classList.add('btn-disabled');
    notifInfo.innerHTML=msg;
}


// ================= HARD STOP SUBMIT =================
btnConfirm.onclick=function(){

    // ❌ STOP jika email salah
    if(!validEmail(email.value)){
        notifInfo.innerHTML="Format email tidak valid";
        return;
    }

    // ❌ STOP jika HP kurang dari 10 digit
    if(hp.value.length < 10){
        notifInfo.innerHTML="Nomor HP tidak valid";
        return;
    }

    // ❌ STOP jika kosong
    if(!nama.value || !email.value || !hp.value){
        notifInfo.innerHTML="Lengkapi data pelanggan";
        return;
    }

    if(!confirm("Yakin reservasi?"))
    return;

    let selectedMenus = [];
    document.querySelectorAll('.menu-qty').forEach(input => {
        let qty = parseInt(input.value);
        if (qty > 0) {
            selectedMenus.push({
                id_menu: input.dataset.id,
                jumlah: qty
            });
        }
    });

    fetch("/booking",{

        method:'POST',

        headers:{
            'Content-Type':'application/json',
            'Accept':'application/json',
            'X-Requested-With':'XMLHttpRequest',
            'X-CSRF-TOKEN':
            document.querySelector('meta[name="csrf-token"]').content
        },

        body:JSON.stringify({

            nama_pelanggan:nama.value,
            email:email.value,
            no_hp:hp.value,
            tanggal_reservasi:tanggal.value,
            jam_reservasi:jam.value,
            jam_selesai:jamSelesai.value,
            jumlah_orang:jumlah.value,
            id_area:area.value,
            id_meja:meja.value,
            catatan:catatan.value,
            menus: selectedMenus

        })

    })
    .then(res => {
        if (!res.ok) {
            throw new Error("Request gagal");
        }
        return res.json();
    })
    .then(data => {
        if(data.success){
            window.location.href = "/payment/" + data.id;
        } else {
            alert(data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Terjadi error!");
    });

}

</script>

</section>

@endsection
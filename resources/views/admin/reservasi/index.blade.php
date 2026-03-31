@extends('layouts.admin')

@section('title', 'RESERVASI')

@section('content')

<div class="admin-container">

    <!-- STAT CARDS -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div>
                <h6>Total Reservasi</h6>
                <h3 id="statTotal">0</h3>
            </div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon">
                <i class="bi bi-check-circle"></i>
            </div>
            <div>
                <h6>Confirmed</h6>
                <h3 id="statConfirmed">0</h3>
            </div>
        </div>

        <div class="stat-card red">
            <div class="stat-icon">
                <i class="bi bi-x-circle"></i>
            </div>
            <div>
                <h6>Cancelled</h6>
                <h3 id="statCancelled">0</h3>
            </div>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-bar mb-3">
        <div class="filter-group">
            <label class="filter-label">Status Reservasi</label>
            <div class="filter-pills" id="filterStatus">
                <button class="pill active" data-val="">Semua</button>
                <button class="pill" data-val="confirmed">Confirmed</button>
                <button class="pill" data-val="cancelled">Cancelled</button>
            </div>
        </div>
        <div class="filter-group">
            <label class="filter-label">Status Bayar</label>
            <div class="filter-pills" id="filterBayar">
                <button class="pill active" data-val="">Semua</button>
                <button class="pill" data-val="unpaid">Belum Bayar</button>
                <button class="pill" data-val="paid">Lunas</button>
            </div>
        </div>
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nama / kode booking...">
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="table-card">

        <div class="table-header">
            <h5>Daftar Reservasi</h5>
            <span class="table-count" id="tableCount">Memuat...</span>
        </div>

        <div class="table-responsive">
            <table class="res-table" id="resTable">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Jadwal</th>
                        <th>Lokasi</th>
                        <th>Tamu</th>
                        <th>Menu Dipesan</th>
                        <th>Biaya Reservasi</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="reservasiBody">
                    <tr>
                        <td colspan="9" class="loading-row">
                            <div class="loading-spinner"></div>
                            Memuat data...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- MODAL CATATAN -->
<div class="modal-overlay" id="catatanOverlay" onclick="closeModal('catatanOverlay')">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h6>Catatan Reservasi</h6>
            <button class="modal-close" onclick="closeModal('catatanOverlay')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <p id="modalCatatanText" class="catatan-text"></p>
        </div>
    </div>
</div>

<!-- MODAL MENU -->
<div class="modal-overlay" id="menuOverlay" onclick="closeModal('menuOverlay')">
    <div class="modal-box modal-lg" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div>
                <h6>Menu Dipesan</h6>
                <small id="menuModalSubtitle" style="color:var(--color-text-secondary);font-size:12px;"></small>
            </div>
            <button class="modal-close" onclick="closeModal('menuOverlay')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body">
            <table class="menu-detail-table">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Harga Satuan</th>
                        <th class="text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody id="menuDetailBody"></tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right fw-bold">Total Menu</td>
                        <td class="text-right fw-bold total-menu-price" id="menuTotalPrice"></td>
                    </tr>
                </tfoot>
            </table>
            <div class="menu-note">
                <i class="bi bi-info-circle"></i>
                Menu dibayar langsung di tempat saat kedatangan. Tidak termasuk biaya reservasi.
            </div>
        </div>
    </div>
</div>

<!-- MODAL BUKTI PEMBAYARAN -->
<div class="modal-overlay" id="buktiOverlay" onclick="closeModal('buktiOverlay')">
    <div class="modal-box modal-lg" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div>
                <h6>Bukti Pembayaran</h6>
                <small id="buktiModalSubtitle" style="color:var(--color-text-secondary);font-size:12px;"></small>
            </div>
            <button class="modal-close" onclick="closeModal('buktiOverlay')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="modal-body" id="buktiBody"></div>
    </div>
</div>

<style>
/* ============================================================
   STATS GRID
============================================================ */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 20px 22px;
    border-radius: 16px;
    color: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,.08);
    transition: transform .2s;
}

.stat-card:hover { transform: translateY(-3px); }

.stat-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    background: rgba(255,255,255,.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}

.stat-card h6 { margin: 0; font-size: 12px; font-weight: 500; opacity: .85; }
.stat-card h3 { margin: 4px 0 0; font-size: 28px; font-weight: 700; }

.stat-card.blue   { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
.stat-card.yellow { background: linear-gradient(135deg, #f59e0b, #d97706); }
.stat-card.green  { background: linear-gradient(135deg, #10b981, #059669); }
.stat-card.red    { background: linear-gradient(135deg, #ef4444, #dc2626); }

/* ============================================================
   FILTER BAR
============================================================ */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    background: #fff;
    padding: 14px 20px;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,.05);
}

.filter-group {
    display: flex;
    align-items: center;
    gap: 8px;
}

.filter-label {
    font-size: 12px;
    color: #888;
    font-weight: 500;
    white-space: nowrap;
}

.filter-pills {
    display: flex;
    gap: 6px;
}

.pill {
    padding: 5px 14px;
    border-radius: 20px;
    border: 1.5px solid #e5e7eb;
    background: #fff;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    color: #555;
    transition: all .2s;
}

.pill:hover { border-color: #0f3b34; color: #0f3b34; }
.pill.active { background: #0f3b34; border-color: #0f3b34; color: #fff; }

.search-box {
    margin-left: auto;
    position: relative;
}

.search-box i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
    font-size: 14px;
}

.search-box input {
    padding: 8px 14px 8px 34px;
    border: 1.5px solid #e5e7eb;
    border-radius: 10px;
    font-size: 13px;
    width: 220px;
    transition: border-color .2s;
    outline: none;
}

.search-box input:focus { border-color: #0f3b34; }

/* ============================================================
   TABLE CARD
============================================================ */
.table-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 24px 14px;
    border-bottom: 1px solid #f1f5f9;
}

.table-header h5 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #111;
}

.table-count {
    font-size: 12px;
    color: #888;
    background: #f1f5f9;
    padding: 4px 12px;
    border-radius: 20px;
}

.table-responsive { overflow-x: auto; }

.res-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1100px;
}

.res-table thead th {
    padding: 12px 16px;
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: .6px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
    white-space: nowrap;
}

.res-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background .15s;
}

.res-table tbody tr:hover { background: #f8fafc; }
.res-table tbody tr:last-child { border-bottom: none; }

.res-table tbody td {
    padding: 14px 16px;
    font-size: 13px;
    color: #374151;
    vertical-align: middle;
}

/* Pelanggan cell */
.pelanggan-cell { display: flex; align-items: center; gap: 10px; }

.avatar-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0f3b34, #1a5c4f);
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.pelanggan-name { font-weight: 600; font-size: 13px; color: #111; }
.pelanggan-email { font-size: 11px; color: #9ca3af; margin-top: 1px; }
.kode-booking {
    font-size: 10px;
    font-family: 'Courier New', monospace;
    background: #f0fdf4;
    color: #166534;
    padding: 2px 7px;
    border-radius: 5px;
    margin-top: 3px;
    display: inline-block;
    font-weight: 600;
    letter-spacing: .5px;
}

/* Jadwal */
.jadwal-date { font-weight: 600; color: #111; font-size: 13px; }
.jadwal-time { font-size: 11px; color: #6b7280; margin-top: 2px; }

/* Lokasi */
.lokasi-area { font-weight: 600; font-size: 13px; }
.lokasi-meja {
    font-size: 11px;
    background: #eff6ff;
    color: #1d4ed8;
    padding: 2px 8px;
    border-radius: 5px;
    display: inline-block;
    margin-top: 3px;
}

/* Menu cell */
.menu-badge-wrap { display: flex; flex-direction: column; gap: 3px; }

.menu-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #fef3c7;
    color: #92400e;
    font-size: 11px;
    font-weight: 500;
    padding: 3px 9px;
    border-radius: 6px;
    white-space: nowrap;
}

.menu-badge i { font-size: 10px; }

.menu-more-btn {
    background: none;
    border: 1.5px dashed #d1d5db;
    border-radius: 6px;
    font-size: 11px;
    color: #6b7280;
    padding: 3px 9px;
    cursor: pointer;
    transition: all .2s;
    text-align: left;
}

.menu-more-btn:hover {
    border-color: #0f3b34;
    color: #0f3b34;
    background: #f0fdf4;
}

.no-menu {
    font-size: 11px;
    color: #d1d5db;
    font-style: italic;
}

/* Harga */
.harga-cell { font-weight: 600; color: #111; font-size: 13px; }

/* Status badges */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}

.badge-confirmed { background: #dcfce7; color: #166534; }
.badge-cancelled { background: #fee2e2; color: #991b1b; }
.badge-paid      { background: #dbeafe; color: #1e40af; }
.badge-unpaid    { background: #f3f4f6; color: #6b7280; }
.badge-failed    { background: #fee2e2; color: #991b1b; }

/* Metode */
.metode-cell { font-size: 12px; color: #374151; }
.bukti-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #eff6ff;
    color: #1d4ed8;
    border: none;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 500;
    padding: 4px 10px;
    cursor: pointer;
    transition: background .2s;
    margin-top: 4px;
}

.bukti-btn:hover { background: #dbeafe; }

/* Action buttons */
.action-group { display: flex; gap: 6px; align-items: center; }

.btn-confirm {
    width: 30px; height: 30px;
    border-radius: 8px;
    border: none;
    background: #dcfce7;
    color: #166534;
    font-size: 13px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s;
}

.btn-confirm:hover { background: #bbf7d0; }

.btn-cancel-action {
    width: 30px; height: 30px;
    border-radius: 8px;
    border: none;
    background: #fef3c7;
    color: #92400e;
    font-size: 13px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s;
}

.btn-cancel-action:hover { background: #fde68a; }

.btn-delete {
    width: 30px; height: 30px;
    border-radius: 8px;
    border: none;
    background: #fee2e2;
    color: #991b1b;
    font-size: 13px;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: background .2s;
}

.btn-delete:hover { background: #fecaca; }

/* Loading */
.loading-row {
    text-align: center;
    padding: 40px !important;
    color: #9ca3af;
}

.loading-spinner {
    width: 20px; height: 20px;
    border: 2px solid #e5e7eb;
    border-top-color: #0f3b34;
    border-radius: 50%;
    animation: spin .8s linear infinite;
    display: inline-block;
    margin-right: 8px;
    vertical-align: middle;
}

@keyframes spin { to { transform: rotate(360deg); } }

.empty-row {
    text-align: center;
    padding: 50px !important;
    color: #9ca3af;
    font-size: 14px;
}

.empty-row i { display: block; font-size: 36px; margin-bottom: 10px; color: #d1d5db; }

/* ============================================================
   MODALS
============================================================ */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.45);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(3px);
}

.modal-overlay.open { display: flex; }

.modal-box {
    background: #fff;
    border-radius: 18px;
    width: 460px;
    max-width: 95vw;
    max-height: 85vh;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 20px 60px rgba(0,0,0,.2);
    animation: modalIn .2s ease;
}

.modal-box.modal-lg { width: 580px; }

@keyframes modalIn {
    from { opacity: 0; transform: scale(.96) translateY(10px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px 24px 16px;
    border-bottom: 1px solid #f1f5f9;
}

.modal-header h6 {
    margin: 0;
    font-size: 15px;
    font-weight: 600;
    color: #111;
}

.modal-close {
    width: 30px; height: 30px;
    border-radius: 8px;
    border: none;
    background: #f3f4f6;
    color: #6b7280;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px;
    transition: background .2s;
}

.modal-close:hover { background: #e5e7eb; color: #111; }

.modal-body {
    padding: 20px 24px;
    overflow-y: auto;
}

.catatan-text {
    font-size: 14px;
    line-height: 1.8;
    color: #374151;
    background: #f8fafc;
    padding: 14px 16px;
    border-radius: 10px;
    border-left: 3px solid #0f3b34;
    margin: 0;
}

/* Menu detail table in modal */
.menu-detail-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.menu-detail-table thead th {
    padding: 10px 12px;
    font-size: 11px;
    font-weight: 600;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: .5px;
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
}

.menu-detail-table tbody tr {
    border-bottom: 1px solid #f1f5f9;
    transition: background .15s;
}

.menu-detail-table tbody tr:hover { background: #f8fafc; }

.menu-detail-table tbody td {
    padding: 11px 12px;
    color: #374151;
}

.menu-detail-table tfoot td {
    padding: 12px;
    background: #f0fdf4;
    border-top: 2px solid #e5e7eb;
    font-size: 13px;
    color: #166534;
}

.text-right { text-align: right; }
.text-center { text-align: center; }
.fw-bold { font-weight: 700; }

.total-menu-price { color: #166534; font-size: 15px; }

.menu-note {
    margin-top: 14px;
    background: #fefce8;
    border: 1px solid #fde68a;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 12px;
    color: #78350f;
    display: flex;
    align-items: flex-start;
    gap: 8px;
}

.menu-note i { margin-top: 1px; flex-shrink: 0; }

/* Bukti modal */
.bukti-info-grid {
    display: grid;
    grid-template-columns: 130px 1fr;
    gap: 8px;
    margin-bottom: 16px;
    font-size: 13px;
}

.bukti-info-grid .label { color: #9ca3af; }
.bukti-info-grid .value { font-weight: 600; color: #111; }

.bukti-img-wrap { text-align: center; }
.bukti-img-wrap img { max-width: 100%; border-radius: 10px; border: 1px solid #e5e7eb; }

.bukti-download {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #0f3b34;
    color: #fff;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 12px;
    font-weight: 500;
    text-decoration: none;
    margin-top: 12px;
    transition: background .2s;
}

.bukti-download:hover { background: #0c2f2a; color: #fff; text-decoration: none; }

/* Responsive */
@media (max-width: 992px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .filter-bar { flex-direction: column; align-items: flex-start; }
    .search-box { margin-left: 0; width: 100%; }
    .search-box input { width: 100%; }
}
</style>

<script>
let allData = [];
let activeStatus = '';
let activeBayar = '';
let searchQuery = '';

function fmt(n) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
    }).format(n || 0);
}

function fmtDate(d) {
    if (!d) return '-';
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agt','Sep','Okt','Nov','Des'];
    const dt = new Date(d);
    return dt.getDate() + ' ' + months[dt.getMonth()] + ' ' + dt.getFullYear();
}

function openModal(id) {
    document.getElementById(id).classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).classList.remove('open');
    document.body.style.overflow = '';
}

function showCatatan(text) {
    document.getElementById('modalCatatanText').innerText = text;
    openModal('catatanOverlay');
}

function showMenu(menus, namaP, kode) {
    document.getElementById('menuModalSubtitle').innerText = namaP + ' · ' + kode;
    const tbody = document.getElementById('menuDetailBody');
    tbody.innerHTML = '';
    let total = 0;
    menus.forEach(m => {
        const sub = (m.pivot.harga_saat_ini || m.harga_saat_ini || 0) * (m.pivot.jumlah || m.jumlah || 0);
        total += sub;
        tbody.innerHTML += `
            <tr>
                <td>${m.nama_menu || m.nama || '-'}</td>
                <td class="text-center">
                    <span style="background:#f1f5f9;padding:2px 10px;border-radius:12px;font-weight:600;">${m.pivot.jumlah || m.jumlah}</span>
                </td>
                <td class="text-right">${fmt(m.pivot.harga_saat_ini || m.harga_saat_ini || 0)}</td>
                <td class="text-right fw-bold">${fmt(sub)}</td>
            </tr>
        `;
    });
    document.getElementById('menuTotalPrice').innerText = fmt(total);
    openModal('menuOverlay');
}

function showBukti(path, kode, nama, total) {
    document.getElementById('buktiModalSubtitle').innerText = kode + ' · ' + nama;
    const url = '/storage/' + path;
    let html = `
        <div class="bukti-info-grid">
            <span class="label">Kode Booking</span><span class="value">${kode}</span>
            <span class="label">Nama</span><span class="value">${nama}</span>
            <span class="label">Total Bayar</span><span class="value" style="color:#0f3b34">${total}</span>
        </div>
        <hr style="border:none;border-top:1px solid #f1f5f9;margin:0 0 16px">
    `;
    if (path.endsWith('.pdf')) {
        html += `
            <div class="bukti-img-wrap">
                <i class="bi bi-file-pdf-fill" style="font-size:56px;color:#dc2626;"></i>
                <p style="color:#6b7280;font-size:13px;margin:8px 0 0;">File PDF</p>
                <a href="${url}" target="_blank" class="bukti-download"><i class="bi bi-download"></i> Download PDF</a>
            </div>`;
    } else {
        html += `
            <div class="bukti-img-wrap">
                <img src="${url}" alt="Bukti Pembayaran">
                <br>
                <a href="${url}" target="_blank" class="bukti-download"><i class="bi bi-download"></i> Download Gambar</a>
            </div>`;
    }
    document.getElementById('buktiBody').innerHTML = html;
    openModal('buktiOverlay');
}

function updateStatus(id, status) {
    const labels = { confirmed: 'CONFIRMED', cancelled: 'CANCELLED' };
    if (!confirm(`Yakin ubah status menjadi ${labels[status]}?`)) return;
    fetch(`/admin/reservasi/${id}/status`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ status })
    }).then(() => loadData());
}

function deleteReservasi(id) {
    if (!confirm('Yakin ingin menghapus reservasi ini?')) return;
    fetch(`/admin/reservasi/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    }).then(() => loadData());
}

function renderTable(data) {
    const tbody = document.getElementById('reservasiBody');
    document.getElementById('tableCount').innerText = data.length + ' data';

    if (data.length === 0) {
        tbody.innerHTML = `
            <tr><td colspan="9" class="empty-row">
                <i class="bi bi-inbox"></i>
                Tidak ada data reservasi
            </td></tr>`;
        return;
    }

    tbody.innerHTML = data.map(item => {
        let statusLabel = '-';
        let statusClass = 'badge-unpaid';

        // SUDAH BAYAR
        if(item.status === 'confirmed' && item.status_pembayaran === 'paid'){
            statusLabel = 'Confirmed';
            statusClass = 'badge-confirmed';
        }

        // CANCEL
        else if(item.status === 'cancelled'){
            statusLabel = 'Cancelled';
            statusClass = 'badge-cancelled';
        }
        const bayarClass  = { paid: 'badge-paid', failed: 'badge-failed', unpaid: 'badge-unpaid' }[item.status_pembayaran] || 'badge-unpaid';
        const bayarLabel  = { paid: 'Lunas', failed: 'Gagal', unpaid: 'Belum Bayar' }[item.status_pembayaran] || 'Belum Bayar';

        /* --- Menu column --- */
        let menuCol = `<span class="no-menu">Tidak ada</span>`;
        if (item.menus && item.menus.length > 0) {
            const preview = item.menus.slice(0, 2);
            const rest    = item.menus.length - 2;
            const menusEsc = encodeURIComponent(JSON.stringify(item.menus));
            let badges = preview.map(m =>
                `<span class="menu-badge"><i class="bi bi-circle-fill"></i>${m.nama_menu || m.nama} ×${m.pivot?.jumlah || m.jumlah}</span>`
            ).join('');
            let moreBtn = '';
            if (rest > 0 || item.menus.length > 0) {
                moreBtn = `<button class="menu-more-btn" onclick='showMenu(${JSON.stringify(item.menus)}, "${item.nama_pelanggan}", "${item.kode_booking}")'>
                    <i class="bi bi-list-ul"></i> Lihat ${item.menus.length} menu
                </button>`;
            }
            menuCol = `<div class="menu-badge-wrap">${badges}${moreBtn}</div>`;
        }

        /* --- Bukti & metode --- */
        let pembayaranCol = `<span class="badge ${bayarClass}">${bayarLabel}</span>`;
        if (item.metode_pembayaran) {
            pembayaranCol += `<div class="metode-cell">${item.metode_pembayaran}</div>`;
        }
        if (item.bukti_pembayaran) {
            const totalFmt = fmt(item.total_harga);
            pembayaranCol += `<button class="bukti-btn" onclick="showBukti('${item.bukti_pembayaran}','${item.kode_booking}','${item.nama_pelanggan}','${totalFmt}')">
                <i class="bi bi-eye"></i> Lihat bukti
            </button>`;
        }

        /* --- Action buttons --- */
        let actions = '';
        
        actions += `<button class="btn-delete" title="Hapus" onclick="deleteReservasi(${item.id_reservasi})"><i class="bi bi-trash3"></i></button>`;

        return `
        <tr>
            <td>
                <div class="pelanggan-cell">
                    <div class="avatar-circle">${item.nama_pelanggan.charAt(0).toUpperCase()}</div>
                    <div>
                        <div class="pelanggan-name">${item.nama_pelanggan}</div>
                        <div class="pelanggan-email">${item.email}</div>
                        <span class="kode-booking">${item.kode_booking}</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="jadwal-date">${fmtDate(item.tanggal_reservasi)}</div>
                <div class="jadwal-time">${item.jam_reservasi ? item.jam_reservasi.substring(0,5) : '-'} – ${item.jam_selesai ? item.jam_selesai.substring(0,5) : '-'}</div>
            </td>
            <td>
                <div class="lokasi-area">${item.nama_area || '-'}</div>
                ${item.kode_meja ? `<span class="lokasi-meja"><i class="bi bi-grid-3x3-gap-fill"></i> ${item.kode_meja}</span>` : ''}
            </td>
            <td style="text-align:center;font-weight:600;">${item.jumlah_orang} org</td>
            <td>${menuCol}</td>
            <td>
                <div class="harga-cell">${fmt(item.total_harga)}</div>
                ${item.catatan ? `<button class="menu-more-btn" style="margin-top:4px" onclick="showCatatan('${item.catatan.replace(/'/g,"\\'")}')"><i class="bi bi-chat-left-text"></i> Catatan</button>` : ''}
            </td>
            <td>${pembayaranCol}</td>
            <td><span class="badge ${statusClass}">${statusLabel}</span></td>
            <td><div class="action-group">${actions}</div></td>
        </tr>`;
    }).join('');
}

function applyFilters() {
    let filtered = allData;
    if (activeStatus) filtered = filtered.filter(i => i.status === activeStatus);
    if (activeBayar)  filtered = filtered.filter(i => i.status_pembayaran === activeBayar);
    if (searchQuery) {
        const q = searchQuery.toLowerCase();
        filtered = filtered.filter(i =>
            (i.nama_pelanggan||'').toLowerCase().includes(q) ||
            (i.kode_booking||'').toLowerCase().includes(q) ||
            (i.email||'').toLowerCase().includes(q)
        );
    }
    renderTable(filtered);
}

function loadData() {
    fetch("{{ route('admin.reservasi.json') }}")
        .then(r => r.json())
        .then(res => {
            allData = res.data;
            const s = res.stats;
            document.getElementById('statTotal').innerText     = s.total;
            document.getElementById('statConfirmed').innerText = s.confirmed;
            document.getElementById('statCancelled').innerText = s.cancelled;
            applyFilters();
        })
        .catch(() => {
            document.getElementById('reservasiBody').innerHTML =
                `<tr><td colspan="9" class="empty-row"><i class="bi bi-exclamation-triangle"></i>Gagal memuat data</td></tr>`;
        });
}

/* Filter pills */
document.querySelectorAll('#filterStatus .pill').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('#filterStatus .pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeStatus = btn.dataset.val;
        applyFilters();
    });
});

document.querySelectorAll('#filterBayar .pill').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('#filterBayar .pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        activeBayar = btn.dataset.val;
        applyFilters();
    });
});

/* Search */
let searchTimer;
document.getElementById('searchInput').addEventListener('input', e => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        searchQuery = e.target.value.trim();
        applyFilters();
    }, 300);
});

/* Close modal on ESC */
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        ['catatanOverlay','menuOverlay','buktiOverlay'].forEach(closeModal);
    }
});

loadData();
setInterval(loadData, 6000);
</script>

@endsection
@extends('layouts.admin')

@section('title', 'RESERVASI')

@section('content')

<div class="admin-container">

    <!-- STAT CARDS -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <h6>Total</h6>
            <h3 id="statTotal">0</h3>
        </div>

        <div class="stat-card green">
            <h6>Confirmed</h6>
            <h3 id="statConfirmed">0</h3>
        </div>

        <div class="stat-card red">
            <h6>Cancelled</h6>
            <h3 id="statCancelled">0</h3>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-card">
        <h5>Daftar Reservasi</h5>

        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Orang</th>
                        <th>Area</th>
                        <th>Meja</th>
                        <th>Catatan</th>
                        <th>Total Harga</th>
                        <th>Status Bayar</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody id="reservasiBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script>

let refreshInterval = null;

function loadReservasi() {

    fetch("{{ route('admin.reservasi.json') }}")
    .then(res => res.json())
    .then(response => {

        const body = document.getElementById("reservasiBody");
        body.innerHTML = "";

        if(response.data.length === 0){
            body.innerHTML = `
                <tr>
                    <td colspan="13" class="empty-state">
                        Belum ada reservasi
                    </td>
                </tr>
            `;
            return;
        }

        response.data.forEach(item => {

            const badgeClass = {
                confirmed: "confirmed",
                cancelled: "cancelled"
            }[item.status];

            let actionButtons = '';

            if(item.status === 'pending'){
                actionButtons += `
                    <button onclick="confirmAction(${item.id_reservasi},'confirmed')" 
                        class="btn-action confirm">✔</button>

                    <button onclick="confirmAction(${item.id_reservasi},'cancelled')" 
                        class="btn-action cancel">✖</button>
                `;
            }

            actionButtons += `
                <button onclick="deleteReservasi(${item.id_reservasi})" 
                    class="btn-action delete">🗑</button>
            `;

            // Payment status badge
            const paymentBadgeClass = {
                unpaid: "pending",
                paid: "confirmed",
                failed: "cancelled"
            }[item.status_pembayaran] || "pending";

            const paymentBadgeText = {
                unpaid: "Belum Bayar",
                paid: "Lunas",
                failed: "Gagal"
            }[item.status_pembayaran] || "Belum Bayar";

            // Format total harga
            const totalHarga = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(item.total_harga || 0);

            body.innerHTML += `
            <tr>
                <td>
                    <div class="user-info">
                        <div class="avatar">
                            ${item.nama_pelanggan.charAt(0).toUpperCase()}
                        </div>
                        <div>
                            <div>${item.nama_pelanggan}</div>
                            <small>${item.email}</small><br>
                            <strong>${item.kode_booking}</strong>
                        </div>
                    </div>
                </td>

                <td>${item.tanggal_reservasi}</td>
                <td>${item.jam_reservasi.substring(0,5)} - ${item.jam_selesai ? item.jam_selesai.substring(0,5) : '-'}</td>
                <td>${item.jumlah_orang}</td>

                <!-- ✅ AREA -->
                <td>${item.nama_area ?? '-'}</td>

                <!-- ✅ MEJA -->
                <td>${item.kode_meja ?? '-'}</td>

                <!-- CATATAN -->
                <td>
                    ${
                        item.catatan
                        ? `<button 
                                class="btn btn-sm btn-outline-primary lihat-catatan-btn"
                                data-catatan="${item.catatan.replace(/"/g, '&quot;')}"
                            >
                                Lihat
                        </button>`
                        : '-'
                    }
                </td>

                <!-- TOTAL HARGA -->
                <td><strong>${totalHarga}</strong></td>

                <!-- STATUS PEMBAYARAN -->
                <td>
                    <span class="badge status ${paymentBadgeClass}">
                        ${paymentBadgeText}
                    </span>
                </td>

                <!-- METODE PEMBAYARAN -->
                <td>${item.metode_pembayaran || '-'}</td>

                <!-- BUKTI PEMBAYARAN -->
                <td>
                    ${
                        item.bukti_pembayaran
                        ? `<button 
                                class="btn btn-sm btn-info lihat-bukti-btn"
                                data-bukti="${item.bukti_pembayaran}"
                                data-kode="${item.kode_booking}"
                                data-nama="${item.nama_pelanggan}"
                                data-total="${totalHarga}"
                            >
                                <i class="bi bi-eye"></i> Lihat
                        </button>`
                        : '-'
                    }
                </td>

                <td>
                    <span class="badge status ${badgeClass}">
                        ${item.status}
                    </span>
                </td>

                <td>
                    <div class="action-buttons">
                        ${actionButtons}
                    </div>
                </td>
            </tr>
            `;
        });

        document.getElementById("statTotal").innerText     = response.stats.total;
        document.getElementById("statConfirmed").innerText = response.stats.confirmed;
        document.getElementById("statCancelled").innerText = response.stats.cancelled;
        
        // Event delegation for dynamic buttons
        document.addEventListener("click", function(e) {

            // Lihat Catatan
            if(e.target.classList.contains("lihat-catatan-btn")) {
                let text = e.target.getAttribute("data-catatan");
                document.getElementById("modalCatatanText").innerText = text;
                let modal = new bootstrap.Modal(
                    document.getElementById('catatanModal')
                );
                modal.show();
            }

            // Lihat Bukti Pembayaran
            if(e.target.classList.contains("lihat-bukti-btn") || e.target.closest('.lihat-bukti-btn')) {
                const btn = e.target.classList.contains("lihat-bukti-btn") ? e.target : e.target.closest('.lihat-bukti-btn');
                const buktiPath = btn.getAttribute("data-bukti");
                const kodeBooking = btn.getAttribute("data-kode");
                const namaPelanggan = btn.getAttribute("data-nama");
                const totalHarga = btn.getAttribute("data-total");
                
                // Set modal content
                document.getElementById("modalBuktiKode").innerText = kodeBooking;
                document.getElementById("modalBuktiNama").innerText = namaPelanggan;
                document.getElementById("modalBuktiTotal").innerText = totalHarga;
                
                const buktiContainer = document.getElementById("modalBuktiContainer");
                const buktiUrl = `/storage/${buktiPath}`;
                
                // Check if PDF or image
                if(buktiPath.endsWith('.pdf')) {
                    buktiContainer.innerHTML = `
                        <div class="text-center">
                            <i class="bi bi-file-pdf-fill text-danger" style="font-size: 4rem;"></i>
                            <p class="mt-3">File PDF</p>
                            <a href="${buktiUrl}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="bi bi-download"></i> Download PDF
                            </a>
                        </div>
                    `;
                } else {
                    buktiContainer.innerHTML = `
                        <img src="${buktiUrl}" class="img-fluid rounded" alt="Bukti Pembayaran">
                        <div class="text-center mt-3">
                            <a href="${buktiUrl}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="bi bi-download"></i> Download Gambar
                            </a>
                        </div>
                    `;
                }
                
                let modal = new bootstrap.Modal(
                    document.getElementById('buktiBayarModal')
                );
                modal.show();
            }

        });

    })
    .catch(err => console.log("Error load:", err));
}

function updateStatus(id, status){

    fetch(`/admin/reservasi/${id}/status`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({status: status})
    })
    .then(res => res.json())
    .then(() => loadReservasi());
}

function deleteReservasi(id){

    if(!confirm("Yakin ingin menghapus reservasi ini?")) return;

    fetch(`/admin/reservasi/${id}`, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(() => loadReservasi())
    .catch(err => console.log("Error delete:", err));
}

function confirmAction(id, status) {

    let pesan = status === 'confirmed'
        ? 'Yakin ingin mengubah status menjadi CONFIRMED?'
        : 'Yakin ingin mengubah status menjadi CANCELLED?';

    if(confirm(pesan)) {
        updateStatus(id, status);
    }
}


/* AUTO REFRESH STABIL */
refreshInterval = setInterval(loadReservasi, 4000);
loadReservasi();

</script>


<!-- MODAL CATATAN -->
<div class="modal fade" id="catatanModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Detail Catatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p id="modalCatatanText"></p>
            </div>

        </div>
    </div>
</div>

<!-- MODAL BUKTI PEMBAYARAN -->
<div class="modal fade" id="buktiBayarModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4"><strong>Kode Booking:</strong></div>
                        <div class="col-md-8" id="modalBuktiKode"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Nama Pelanggan:</strong></div>
                        <div class="col-md-8" id="modalBuktiNama"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4"><strong>Total Harga:</strong></div>
                        <div class="col-md-8" id="modalBuktiTotal"></div>
                    </div>
                </div>
                
                <hr>
                
                <div id="modalBuktiContainer" class="text-center">
                    <!-- Will be populated by JavaScript -->
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
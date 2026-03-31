@extends('layouts.admin')

@section('title', 'DASHBOARD')

@section('content')

{{-- FILTER PERIODE --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <form method="GET" class="d-flex gap-2">
        <select name="periode" class="form-select" style="width:200px" onchange="this.form.submit()">
            <option value="7" {{ request('periode') == 7 ? 'selected' : '' }}>7 Hari Terakhir</option>
            <option value="30" {{ request('periode') == 30 ? 'selected' : '' }}>30 Hari Terakhir</option>
            <option value="bulan" {{ request('periode') == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
        </select>
        <button class="btn btn-dark-green">Filter</button>
    </form>

</div>


{{-- ALERT PENDING --}}
@if($pending > 5)
<div class="alert alert-warning">
    Terdapat <strong>{{ $pending }}</strong> reservasi yang belum dikonfirmasi.
</div>
@endif



{{-- STATISTIK UTAMA --}}
<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="stat-card gradient-1">
            <h6>Total Reservasi</h6>
            <h2 class="counter">{{ $totalReservasi }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card gradient-2">
            <h6>Hari Ini</h6>
            <h2 class="counter">{{ $hariIni }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card gradient-3">
            <h6>Total Pengunjung</h6>
            <h2 class="counter">{{ $totalOrang }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="stat-card gradient-4">
            <h6>Confirmed</h6>
            <h2 class="counter">{{ $confirmed }}</h2>
        </div>
    </div>

</div>



{{-- PERBANDINGAN MINGGU --}}
<div class="row g-4 mb-4">

    <div class="col-md-6">
        <div class="card modern-card p-4">
            <h6 class="fw-bold">Reservasi Minggu Ini</h6>
            <h3>{{ $mingguIni }}</h3>
            <small class="{{ $persentase >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $persentase >= 0 ? '↑' : '↓' }}
                {{ abs(round($persentase,1)) }}% dibanding minggu lalu
            </small>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card modern-card p-4">
            <h6 class="fw-bold">Distribusi Status (%)</h6>
            <p class="mb-1">Confirmed: {{ $confirmedPercent }}%</p>
            <p class="mb-0">Cancelled: {{ $cancelledPercent }}%</p>
        </div>
    </div>

</div>



{{-- RESERVASI TERBARU --}}
<div class="card modern-card p-4 mt-4">
    <h6 class="fw-bold mb-3">Reservasi Terbaru</h6>

    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="latestReservasiTable">
            @forelse($latest as $item)
                <tr>
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->tanggal_reservasi }}</td>
                    <td>{{ $item->jam_reservasi }}</td>
                    <td>
                        <span class="status {{ $item->status }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


{{-- GRAFIK --}}
<div class="row g-4 mt-2">

    <div class="col-md-8">
        <div class="card modern-card p-4">
            <h6 class="fw-bold mb-3">Tren Reservasi</h6>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card modern-card p-4">
            <h6 class="fw-bold mb-3">Status Reservasi</h6>
            <canvas id="donutChart"></canvas>
        </div>
    </div>

</div>



{{-- SCRIPT --}}
<script>

    // Counter animation
    document.querySelectorAll('.counter').forEach(el => {
        let target = parseInt(el.innerText);
        let count = 0;
        let interval = setInterval(() => {
            count += Math.ceil(target / 30);
            if (count >= target) {
                count = target;
                clearInterval(interval);
            }
            el.innerText = count;
        }, 30);
    });

    const chartData = @json($chartData);
    const labels = chartData.map(i => i.tanggal);
    const data = chartData.map(i => i.total);

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                borderColor: '#14532d',
                backgroundColor: 'rgba(20,83,45,0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            plugins: { legend: { display: false } }
        }
    });

    new Chart(document.getElementById('donutChart'), {
        type: 'doughnut',
        data: {
            labels: ['Confirmed','Cancelled'],
            datasets: [{
                data: [{{ $confirmed }}, {{ $cancelled }}],
                backgroundColor: ['#10b981','#ef4444']
            }]
        },
        options: {
            cutout: '70%',
            plugins: { legend: { position: 'bottom' } }
        }
    });

</script>

<script>
function loadLatestReservasi() {
    fetch("{{ route('admin.dashboard.latest') }}")
        .then(response => response.json())
        .then(data => {

            let table = document.getElementById('latestReservasiTable');
            table.innerHTML = '';

            data.forEach(item => {

                let statusClass = '';
                if (item.status === 'confirmed') statusClass = 'confirmed';
                if (item.status === 'pending') statusClass = 'pending';
                if (item.status === 'cancelled') statusClass = 'cancelled';

                table.innerHTML += `
                    <tr>
                        <td>${item.nama_pelanggan}</td>
                        <td>${item.tanggal_reservasi}</td>
                        <td>${item.jam_reservasi}</td>
                        <td>
                            <span class="status ${statusClass}">
                                ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
                            </span>
                        </td>
                    </tr>
                `;
            });

        });
}

// Load pertama kali
loadLatestReservasi();

// Refresh tiap 5 detik
setInterval(loadLatestReservasi, 5000);
</script>

@endsection
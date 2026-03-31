<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial; background:#111; color:white; padding:30px;">

    <h2 style="color:#d4b16a;">Reservasi Berhasil Dibuat</h2>

    <p>Halo {{ $reservasi->nama_pelanggan }}, <br><br>
       Terima kasih telah melakukan reservasi di <b>Wadesa Resto</b>.
    </p>

    <hr>

    <p><strong>Kode Booking:</strong> {{ $reservasi->kode_booking }}</p>

    <p><b>Tanggal:</b>
    {{ \Carbon\Carbon::parse($reservasi->tanggal_reservasi)->translatedFormat('d F Y') }}
    </p>

    <p><b>Jam:</b>
    {{ \Carbon\Carbon::parse($reservasi->jam_reservasi)->format('H.i') }}
    </p>

    <p><b>Jumlah Orang:</b> {{ $reservasi->jumlah_orang }}</p>

    <p><b>Email:</b> {{ $reservasi->email }}</p>

    <p><b>Area:</b>
    {{ $reservasi->area->nama_area ?? '-' }}
    </p>

    <p><b>Meja:</b>
    {{ $reservasi->meja->kode_meja ?? '-' }}
    </p>

    @if($reservasi->catatan)
    <p><b>Catatan:</b> {{ $reservasi->catatan }}</p>
    @endif

    <hr>

    <p>Status Pembayaran: <b style="color: {{ $reservasi->status_pembayaran == 'paid' ? '#28a745' : '#dc3545' }}">{{ $reservasi->status_pembayaran == 'paid' ? 'LUNAS' : 'PENDING' }}</b></p>
    @if($reservasi->metode_pembayaran)
    <p>Metode Pembayaran: <b>{{ $reservasi->metode_pembayaran }}</b></p>
    @endif

    <hr>

    <h3 style="color:#d4b16a;">Rincian Pesanan:</h3>
    <table style="width:100%; color:white; border-collapse: collapse;">
        @foreach($reservasi->menus as $menu)
        <tr>
            <td style="padding: 5px 0;">{{ $menu->nama_menu }} (x{{ $menu->pivot->jumlah }})</td>
            <td style="text-align:right;">Rp {{ number_format($menu->pivot->harga_saat_ini * $menu->pivot->jumlah, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr style="border-top: 1px solid #444;">
            <td style="padding: 10px 0; font-weight:bold;">Grand Total</td>
            <td style="text-align:right; font-weight:bold; color:#d4b16a; font-size:18px;">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</td>
        </tr>
    </table>

    <hr>

    <p>Status Reservasi: <b>{{ ucfirst($reservasi->status) }}</b></p>

    <hr>

    <p style="text-align:center;margin-top:20px;">
        <a href="{{ $cancelUrl }}"
        style="
        background:#dc3545;
        color:white;
        padding:10px 20px;
        text-decoration:none;
        border-radius:6px;
        display:inline-block;">
        Batalkan Reservasi
        </a>
    </p>

    <br>

    <p style="color:#aaa;">Kami tunggu kedatangan Anda ✨</p>

</body>
</html>

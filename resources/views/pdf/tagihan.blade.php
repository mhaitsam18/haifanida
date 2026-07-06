<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Faktur INV-{{ $pemesanan->id }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #292524; }
        .header { width: 100%; overflow: hidden; margin-bottom: 24px; }
        .header .company { float: left; width: 60%; }
        .header .invoice { float: right; width: 40%; text-align: right; }
        .company p { margin: 2px 0; color: #57534e; }
        .invoice h1 { margin: 0; color: #7f1d1d; font-size: 20px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        thead th { background: #f5f0e6; text-align: left; padding: 6px 8px; font-size: 10px; text-transform: uppercase; color: #78716c; }
        tbody td { padding: 6px 8px; border-bottom: 1px solid #e7e0d3; }
        .text-right { text-align: right; }
        .totals { width: 50%; margin-left: 50%; }
        .totals td { padding: 4px 8px; }
        .totals .balance { background: #f5f0e6; font-weight: bold; color: #7f1d1d; }
    </style>
</head>

<body>
    <div class="header">
        <div class="company">
            <p style="font-weight: bold;">PT. Haifa Nida Wisata Karawang</p>
            <p>Jl. RA. Kartini, No.1, Kel. Karangpawitan, Kec. Karawang Barat, Kab. Karawang, Jawa Barat</p>
            <p style="margin-top: 12px; text-transform: uppercase; font-size: 10px; color: #a8a29e;">Tagihan Untuk:</p>
            <p>Sdr/i, {{ $pemesanan->user->name }}<br>{{ $pemesanan->user->member->alamat ?? '' }}</p>
        </div>
        <div class="invoice">
            <h1>Faktur</h1>
            <p># INV-{{ $pemesanan->id }}</p>
            <p style="margin-top: 12px;">Total Tagihan</p>
            <p style="font-size: 18px; font-weight: bold; color: #7f1d1d;">Rp.{{ number_format($balance, 2, ',', '.') }}</p>
            <p>Tanggal Faktur: {{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->isoFormat('LL') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Deskripsi</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Biaya Satuan</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tagihans as $i => $tagihan)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $tagihan['deskripsi'] }}</td>
                    <td class="text-right">{{ $tagihan['jumlah'] . ' ' . $tagihan['satuan'] }}</td>
                    <td class="text-right">Rp.{{ number_format($tagihan['biaya_satuan'], 2, ',', '.') }}</td>
                    <td class="text-right">Rp.{{ number_format($tagihan['total'], 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td>Sub Total</td>
            <td class="text-right">Rp.{{ number_format($subtotal, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>TAX ({{ rtrim(rtrim(number_format($tax_rate, 2), '0'), '.') }}%)</td>
            <td class="text-right">Rp.{{ number_format($tax, 2, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Pembayaran Dilakukan</td>
            <td class="text-right">(-) Rp.{{ number_format($pembayaran, 2, ',', '.') }}</td>
        </tr>
        <tr class="balance">
            <td>Balance / Sisa Tagihan</td>
            <td class="text-right">Rp.{{ number_format($balance, 2, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>

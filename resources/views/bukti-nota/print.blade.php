<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Nota - {{ $transaksi->nomor_transaksi }}</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 1cm;
            }
            body {
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2d5016;
            margin-bottom: 5px;
        }
        .info-section {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #E8F5E9;
            color: #2d5016;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
        }
        .total-row {
            font-weight: bold;
            font-size: 1.1em;
        }
    </style>
</head>
<body>
    <!-- Header Nota -->
    <div class="header">
        <h1>{{ $transaksi->nama_toko }}</h1>
        <p>Bukti Nota Transaksi</p>
    </div>

    <!-- Info Transaksi -->
    <div class="info-section">
        <div class="info-row">
            <div>
                <strong>No. Transaksi:</strong> {{ $transaksi->nomor_transaksi }}
            </div>
            <div>
                <strong>Tanggal:</strong> {{ $transaksi->tanggal->format('d F Y') }}
            </div>
        </div>
        <div class="info-row">
            <div>
                <strong>Kasir:</strong> {{ $transaksi->user->name }}
            </div>
            <div>
                <strong>Pelanggan:</strong> {{ $transaksi->nama_pelanggan }}
                @if($transaksi->no_hp)
                    <br><strong>No. HP:</strong> {{ $transaksi->no_hp }}
                @endif
            </div>
        </div>
    </div>

    <!-- Daftar Produk -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th class="text-right">Harga Satuan</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi->detailTransaksis as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->produk->nama_produk }}</td>
                    <td class="text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $detail->jumlah }}</td>
                    <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">Total Bayar:</td>
                <td class="text-right">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Metode Pembayaran -->
    <div class="info-section">
        <p><strong>Metode Pembayaran:</strong> {{ $transaksi->metode_pembayaran }}</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Terima kasih atas kunjungan Anda</p>
        <p>{{ $transaksi->nama_toko }}</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>


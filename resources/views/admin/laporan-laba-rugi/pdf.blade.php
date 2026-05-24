<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laba Rugi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #fff;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }
        .period {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .section-header {
            background-color: #e8f5e9;
            font-weight: bold;
        }
        .row-total {
            background-color: #e8f5e9;
            font-weight: bold;
        }
        .row-net {
            background-color: #2d5016;
            color: white;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .pl-8 {
            padding-left: 40px;
        }
        .amount {
            font-family: monospace;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
        .signature-section {
            margin-top: 60px;
            display: table;
            width: 100%;
        }
        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
            padding-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PT ORIYA KHASANAH SEJAHTERA</h1>
            <p>Laporan Laba Rugi</p>
        </div>

        <div class="period">
            Periode: {{ $bulan }} {{ $tahun }}
        </div>

        <table>
            <tbody>
                <!-- PENJUALAN -->
                <tr class="section-header">
                    <td>PENJUALAN</td>
                    <td class="text-right amount">Rp {{ number_format($labaRugi['totalPenjualan'], 0, ',', '.') }}</td>
                </tr>

                <!-- HPP -->
                <tr>
                    <td class="pl-8">Harga Pokok Penjualan</td>
                    <td class="text-right amount">
                        @if($labaRugi['totalHPP'] > 0)
                            Rp {{ number_format($labaRugi['totalHPP'], 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>

                <!-- LABA KOTOR -->
                <tr class="row-total">
                    <td>LABA KOTOR</td>
                    <td class="text-right amount">Rp {{ number_format($labaRugi['labaKotor'], 0, ',', '.') }}</td>
                </tr>

                <!-- BEBAN OPERASIONAL HEADER -->
                <tr class="section-header">
                    <td colspan="2">Beban Operasional</td>
                </tr>

                @if(count($labaRugi['bebanOperasional']) > 0)
                    @foreach($labaRugi['bebanOperasional'] as $beban)
                        <tr>
                            <td class="pl-8">{{ $beban['nama_akun'] }}</td>
                            <td class="text-right amount">Rp {{ number_format($beban['nominal'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2" class="pl-8" style="font-style: italic; color: #999;">Tidak ada beban operasional</td>
                    </tr>
                @endif

                <!-- TOTAL BEBAN -->
                <tr class="row-total">
                    <td>Total Beban Operasional</td>
                    <td class="text-right amount">Rp {{ number_format($labaRugi['totalBeban'], 0, ',', '.') }}</td>
                </tr>

                <!-- LABA BERSIH -->
                <tr class="row-net">
                    <td>LABA BERSIH</td>
                    <td class="text-right amount">Rp {{ number_format($labaRugi['labaBersih'], 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="signature-section">
            <div class="signature-box">
                <p>Mengetahui,<br>Direktur</p>
                <br><br><br>
                <p>_________________</p>
            </div>
        </div>

        <div class="footer">
            <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>

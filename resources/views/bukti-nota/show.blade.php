<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Nota - {{ $transaksi->nomor_transaksi }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #F0FFF0;
        }
    </style>
</head>
<body class="min-h-screen bg-[#F0FFF0]">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#E8F5E9] border-r border-[#C0E0C0] flex flex-col">
            <!-- Logo Section -->
            <div class="p-4 border-b border-[#C0E0C0]">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#2d5016] rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">O</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-[#2d5016]">ORIYA HERBAL</h1>
                        <p class="text-xs text-[#2d5016]">SEJAHTERA</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 overflow-y-auto p-4">
                <ul class="space-y-1">
                    @if($user->role === 'kasir')
                        <li>
                            <a href="{{ route('kasir.transaksi-penjualan.create') }}" class="flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                <span>Transaksi Penjualan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kasir.bukti-nota.index') }}" class="flex items-center gap-3 px-4 py-3 bg-[#90EE90] text-[#2d5016] rounded-lg font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Bukti Nota</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.transaksi-penjualan.index') }}" class="flex items-center gap-3 px-4 py-3 bg-[#90EE90] text-[#2d5016] rounded-lg font-semibold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                <span>Penjualan</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>

            <!-- User Info & Logout -->
            <div class="p-4 border-t border-[#C0E0C0]">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 bg-[#2d5016] rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-semibold">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-[#2d5016]">{{ $user->name }}</p>
                        <p class="text-xs text-gray-600">{{ ucfirst($user->role) }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-[#90EE90] hover:bg-[#7ED87E] text-[#2d5016] px-4 py-2 rounded-lg font-semibold transition duration-200 text-sm">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-[#90EE90] text-[#2d5016] shadow-sm border-b border-[#C0E0C0]">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#2d5016] rounded-full flex items-center justify-center">
                                <span class="text-white font-bold">O</span>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold">ORIYA HERBAL</h1>
                                <p class="text-sm">SEJAHTERA</p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('bukti-nota.print', $transaksi->id) }}" target="_blank" class="bg-[#2d5016] hover:bg-[#1a3009] text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
                                Cetak Nota
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto bg-white p-6">
                <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8 border border-gray-200">
                    <!-- Header Nota -->
                    <div class="text-center mb-8">
                        <h1 class="text-3xl font-bold text-[#2d5016] mb-2">{{ $transaksi->nama_toko }}</h1>
                        <p class="text-gray-600">Bukti Nota Transaksi</p>
                    </div>

                    <!-- Info Transaksi -->
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div>
                            <p class="text-sm text-gray-600">No. Transaksi</p>
                            <p class="text-lg font-semibold text-[#2d5016]">{{ $transaksi->nomor_transaksi }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tanggal</p>
                            <p class="text-lg font-semibold text-[#2d5016]">{{ $transaksi->tanggal->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Kasir</p>
                            <p class="text-lg font-semibold text-[#2d5016]">{{ $transaksi->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Pelanggan</p>
                            <p class="text-lg font-semibold text-[#2d5016]">{{ $transaksi->nama_pelanggan }}</p>
                            @if($transaksi->no_hp)
                                <p class="text-sm text-gray-600 mt-1">No. HP: {{ $transaksi->no_hp }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Daftar Produk -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-[#2d5016] mb-4">Daftar Produk</h2>
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-[#E8F5E9]">
                                    <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                                    <th class="border border-gray-300 px-4 py-2 text-left">Nama Produk</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Harga Satuan</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Jumlah</th>
                                    <th class="border border-gray-300 px-4 py-2 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksi->detailTransaksis as $index => $detail)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $detail->produk->nama_produk }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">{{ $detail->jumlah }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-right font-semibold">Total Bayar:</td>
                                    <td class="border border-gray-300 px-4 py-2 text-right font-bold text-lg text-[#2d5016]">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div class="mb-8">
                        <p class="text-sm text-gray-600">Metode Pembayaran</p>
                        <p class="text-lg font-semibold text-[#2d5016]">{{ $transaksi->metode_pembayaran }}</p>
                    </div>

                    <!-- Footer -->
                    <div class="text-center text-gray-600 text-sm mt-8 pt-8 border-t border-gray-300">
                        <p>Terima kasih atas kunjungan Anda</p>
                        <p class="mt-2">{{ $transaksi->nama_toko }}</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>


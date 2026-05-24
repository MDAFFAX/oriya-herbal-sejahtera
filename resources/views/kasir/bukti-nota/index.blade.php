<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Nota - Oriya Herbal Sejahtera</title>
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
                    <!-- Transaksi Penjualan -->
                    <li>
                        <a href="{{ route('kasir.transaksi-penjualan.create') }}" class="flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            <span>Transaksi Penjualan</span>
                        </a>
                    </li>

                    <!-- Bukti Nota -->
                    <li>
                        <a href="{{ route('kasir.bukti-nota.index') }}" class="flex items-center gap-3 px-4 py-3 bg-[#90EE90] text-[#2d5016] rounded-lg font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Bukti Nota</span>
                        </a>
                    </li>
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
                        <p class="text-xs text-gray-600">Kasir</p>
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
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#2d5016] rounded-full flex items-center justify-center">
                            <span class="text-white font-bold">O</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">ORIYA HERBAL</h1>
                            <p class="text-sm">SEJAHTERA</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto bg-white p-6">
                <h2 class="text-3xl font-bold text-[#2d5016] mb-6">Bukti Nota</h2>

                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#E8F5E9]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">No. Transaksi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">Total Bayar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">Metode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($transaksis as $transaksi)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaksi->nomor_transaksi }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaksi->tanggal->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaksi->nama_pelanggan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaksi->metode_pembayaran }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('bukti-nota.show', $transaksi->id) }}" class="text-[#2d5016] hover:text-[#1a3009] mr-3">Lihat</a>
                                        <a href="{{ route('bukti-nota.print', $transaksi->id) }}" target="_blank" class="text-[#2d5016] hover:text-[#1a3009]">Cetak</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">
                                        Tidak ada data transaksi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $transaksis->links() }}
                </div>
            </main>
        </div>
    </div>
</body>
</html>









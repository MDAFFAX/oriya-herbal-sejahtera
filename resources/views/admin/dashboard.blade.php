<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Oriya Herbal Sejahtera</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #F0FFF0;
        }
    </style>
    <script>
        // Toggle dropdown menu
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const icon = document.getElementById(id + '-icon');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                dropdown.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }
    </script>
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
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-[#90EE90] text-[#2d5016] rounded-lg font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Master Data -->
                    <li>
                        <button onclick="toggleDropdown('master-data')" class="w-full flex items-center justify-between px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                                </svg>
                                <span>Master Data</span>
                            </div>
                            <svg id="master-data-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul id="master-data" class="hidden mt-1 ml-8 space-y-1">
                            <li>
                                <a href="{{ route('coa.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">COA</a>
                            </li>
                            <li>
                                <a href="{{ route('produk.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Produk</a>
                            </li>
                            <li>
                                <a href="{{ route('pelanggan.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Pelanggan</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Transaksi -->
                    <li>
                        <button onclick="toggleDropdown('transaksi')" class="w-full flex items-center justify-between px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                                <span>Transaksi</span>
                            </div>
                            <svg id="transaksi-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul id="transaksi" class="hidden mt-1 ml-8 space-y-1">
                            <li>
                                <a href="{{ route('admin.transaksi-penjualan.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Penjualan</a>
                            </li>
                            <li>
                                <a href="{{ route('beban-operasional.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Beban Operasional</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Laporan -->
                    <li>
                        <button onclick="toggleDropdown('laporan')" class="w-full flex items-center justify-between px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span>Laporan</span>
                            </div>
                            <svg id="laporan-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <ul id="laporan" class="hidden mt-1 ml-8 space-y-1">
                            <li>
                                <a href="{{ route('jurnal-umum.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Jurnal Umum</a>
                            </li>
                            <li>
                                <a href="{{ route('buku-besar.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Buku Besar</a>
                            </li>
                            <li>
                                <a href="{{ route('laporan-laba-rugi.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Laba Rugi</a>
                            </li>
                        </ul>
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
                        <p class="text-xs text-gray-600">Admin</p>
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
                <h2 class="text-3xl font-bold text-[#2d5016] mb-6">Dashboard</h2>

                <!-- Dashboard Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Penjualan / Hari ini -->
                    <div class="bg-[#E8F5E9] rounded-lg p-6 shadow-sm border border-[#C0E0C0]">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Penjualan</p>
                                <p class="text-xs text-gray-500">Hari ini</p>
                            </div>
                            <div class="w-12 h-12 bg-[#90EE90] rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#2d5016]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-[#2d5016]">{{ number_format($penjualanHariIni, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 mt-1">Transaksi</p>
                    </div>

                    <!-- Pendapatan / Hari ini -->
                    <div class="bg-[#E8F5E9] rounded-lg p-6 shadow-sm border border-[#C0E0C0]">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Pendapatan</p>
                                <p class="text-xs text-gray-500">Hari ini</p>
                            </div>
                            <div class="w-12 h-12 bg-[#90EE90] rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#2d5016]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-[#2d5016]">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 mt-1">Total pendapatan hari ini</p>
                    </div>

                    <!-- Pelanggan / Hari ini -->
                    <div class="bg-[#E8F5E9] rounded-lg p-6 shadow-sm border border-[#C0E0C0]">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Pelanggan</p>
                                <p class="text-xs text-gray-500">Hari ini</p>
                            </div>
                            <div class="w-12 h-12 bg-[#90EE90] rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#2d5016]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-2xl font-bold text-[#2d5016]">{{ number_format($pelangganBaruHariIni, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500 mt-1">Pelanggan baru</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>

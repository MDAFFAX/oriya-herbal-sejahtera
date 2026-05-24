<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Akun Pelanggan - Oriya Herbal Sejahtera</title>
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

        // Confirm delete
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')) {
                document.getElementById('delete-form-' + id).submit();
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
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
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
                        <ul id="master-data" class="mt-1 ml-8 space-y-1">
                            <li>
                                <a href="{{ route('coa.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">COA</a>
                            </li>
                            <li>
                                <a href="{{ route('produk.index') }}" class="block px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Produk</a>
                            </li>
                            <li>
                                <a href="{{ route('pelanggan.index') }}" class="block px-4 py-2 text-sm bg-[#90EE90] text-[#2d5016] rounded-lg font-semibold">Pelanggan</a>
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
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-[#2d5016]">Kelola Akun Pelanggan</h2>
                    <p class="text-sm text-gray-600 mt-1">Data pelanggan diambil otomatis dari transaksi penjualan</p>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Table -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#E8F5E9]">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">No HP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-[#2d5016] uppercase tracking-wider">Jumlah Transaksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pelanggans as $index => $pelanggan)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pelanggan->nama_pelanggan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pelanggan->no_hp ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $pelanggan->jumlah_transaksi }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data pelanggan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>


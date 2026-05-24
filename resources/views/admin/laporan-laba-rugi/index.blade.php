<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laba Rugi - Oriya Herbal Sejahtera</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #F0FFF0;
        }
    </style>
    <script>
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
        <aside class="w-64 bg-[#E8F5E9] border-r border-[#C0E0C0] flex flex-col overflow-y-auto">
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
            <nav class="flex-1 p-4">
                <ul class="space-y-1">
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
                        <button onclick="toggleDropdown('masterdata')" class="w-full flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Master Data</span>
                            <svg id="masterdata-icon" class="w-4 h-4 ml-auto transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7-7m0 0L5 14m7-7v12"></path>
                            </svg>
                        </button>
                        <ul id="masterdata" class="hidden pl-4 space-y-1">
                            <li><a href="{{ route('coa.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">COA</a></li>
                            <li><a href="{{ route('produk.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Produk</a></li>
                            <li><a href="{{ route('pelanggan.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Pelanggan</a></li>
                        </ul>
                    </li>

                    <!-- Transaksi -->
                    <li>
                        <button onclick="toggleDropdown('transaksi')" class="w-full flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span>Transaksi</span>
                            <svg id="transaksi-icon" class="w-4 h-4 ml-auto transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7-7m0 0L5 14m7-7v12"></path>
                            </svg>
                        </button>
                        <ul id="transaksi" class="hidden pl-4 space-y-1">
                            <li><a href="{{ route('admin.transaksi-penjualan.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Penjualan</a></li>
                        </ul>
                    </li>

                    <!-- Input Data -->
                    <li>
                        <button onclick="toggleDropdown('inputdata')" class="w-full flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Input Data</span>
                            <svg id="inputdata-icon" class="w-4 h-4 ml-auto transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7-7m0 0L5 14m7-7v12"></path>
                            </svg>
                        </button>
                        <ul id="inputdata" class="hidden pl-4 space-y-1">
                            <li><a href="{{ route('beban-operasional.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Beban Operasional</a></li>
                        </ul>
                    </li>

                    <!-- Laporan -->
                    <li>
                        <button onclick="toggleDropdown('laporan')" class="w-full flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Laporan</span>
                            <svg id="laporan-icon" class="w-4 h-4 ml-auto transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7-7m0 0L5 14m7-7v12"></path>
                            </svg>
                        </button>
                        <ul id="laporan" class="hidden pl-4 space-y-1">
                            <li><a href="{{ route('jurnal-umum.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Jurnal Umum</a></li>
                            <li><a href="{{ route('buku-besar.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">Buku Besar</a></li>
                            <li><a href="{{ route('laporan-laba-rugi.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-white bg-[#2d5016] rounded-lg transition duration-200">Laba Rugi</a></li>
                        </ul>
                    </li>

                    <!-- Logout -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-red-100 rounded-lg transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <!-- Header -->
            <div class="bg-[#2d5016] text-white p-6 mb-6">
                <h1 class="text-3xl font-bold">Laporan Laba Rugi</h1>
                <p class="text-[#C0E0C0] mt-1">PT Oriya Khasanah Sejahtera</p>
            </div>

            <!-- Content -->
            <div class="px-6 pb-6">
                <!-- Filter Section -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <form method="GET" action="{{ route('laporan-laba-rugi.index') }}" class="flex flex-wrap gap-4 items-end">
                        <div>
                            <label for="bulan" class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                            <select id="bulan" name="bulan" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#2d5016]">
                                @foreach ($months as $key => $month)
                                    <option value="{{ $key }}" {{ $key == $bulan ? 'selected' : '' }}>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                            <select id="tahun" name="tahun" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-[#2d5016]">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $year == $tahun ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="px-6 py-2 bg-[#2d5016] text-white rounded-lg hover:bg-[#1f3810] transition duration-200">
                            Filter
                        </button>

                        <a href="{{ route('laporan-laba-rugi.export-pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Download PDF
                        </a>
                    </form>
                </div>

                <!-- Report Table -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">
                            Laporan Laba Rugi - {{ $months[$bulan] }} {{ $tahun }}
                        </h2>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <tbody>
                                    <!-- PENJUALAN -->
                                    <tr class="border-b-2 border-gray-300">
                                        <td class="px-4 py-3 font-bold text-[#2d5016] bg-[#E8F5E9]">PENJUALAN</td>
                                        <td class="px-4 py-3 text-right font-bold text-[#2d5016] bg-[#E8F5E9]">
                                            Rp {{ number_format($labaRugi['totalPenjualan'], 0, ',', '.') }}
                                        </td>
                                    </tr>

                                    <!-- HPP -->
                                    <tr class="border-b border-gray-200">
                                        <td class="px-4 py-3 pl-8">Harga Pokok Penjualan</td>
                                        <td class="px-4 py-3 text-right">
                                            @if($labaRugi['totalHPP'] > 0)
                                                Rp {{ number_format($labaRugi['totalHPP'], 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- LABA KOTOR -->
                                    <tr class="border-b-2 border-gray-300">
                                        <td class="px-4 py-3 font-bold text-[#2d5016] bg-[#E8F5E9]">LABA KOTOR</td>
                                        <td class="px-4 py-3 text-right font-bold text-[#2d5016] bg-[#E8F5E9]">
                                            Rp {{ number_format($labaRugi['labaKotor'], 0, ',', '.') }}
                                        </td>
                                    </tr>

                                    <!-- BEBAN OPERASIONAL -->
                                    <tr class="border-b border-gray-200">
                                        <td colspan="2" class="px-4 py-3 font-bold text-[#2d5016] bg-[#F0FFF0]">Beban Operasional</td>
                                    </tr>

                                    @if(count($labaRugi['bebanOperasional']) > 0)
                                        @foreach($labaRugi['bebanOperasional'] as $beban)
                                            <tr class="border-b border-gray-200">
                                                <td class="px-4 py-3 pl-8">{{ $beban['nama_akun'] }}</td>
                                                <td class="px-4 py-3 text-right">Rp {{ number_format($beban['nominal'], 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="border-b border-gray-200">
                                            <td class="px-4 py-3 pl-8 text-gray-500 italic" colspan="2">Tidak ada beban operasional</td>
                                        </tr>
                                    @endif

                                    <!-- TOTAL BEBAN -->
                                    <tr class="border-b-2 border-gray-300">
                                        <td class="px-4 py-3 font-bold text-[#2d5016] bg-[#E8F5E9]">Total Beban Operasional</td>
                                        <td class="px-4 py-3 text-right font-bold text-[#2d5016] bg-[#E8F5E9]">
                                            Rp {{ number_format($labaRugi['totalBeban'], 0, ',', '.') }}
                                        </td>
                                    </tr>

                                    <!-- LABA BERSIH -->
                                    <tr class="border-b-4 border-[#2d5016]">
                                        <td class="px-4 py-4 font-bold text-lg text-white bg-[#2d5016]">LABA BERSIH</td>
                                        <td class="px-4 py-4 text-right font-bold text-lg {{ $labaRugi['labaBersih'] >= 0 ? 'text-white bg-[#2d5016]' : 'text-white bg-red-600' }}">
                                            Rp {{ number_format($labaRugi['labaBersih'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Summary Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-gray-600 text-sm font-medium mb-2">Total Penjualan</h3>
                        <p class="text-2xl font-bold text-[#2d5016]">Rp {{ number_format($labaRugi['totalPenjualan'], 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-gray-600 text-sm font-medium mb-2">Total Beban</h3>
                        <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($labaRugi['totalBeban'], 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-gray-600 text-sm font-medium mb-2">Laba Bersih</h3>
                        <p class="text-2xl font-bold {{ $labaRugi['labaBersih'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                            Rp {{ number_format($labaRugi['labaBersih'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

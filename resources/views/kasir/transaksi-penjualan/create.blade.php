<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Penjualan - Oriya Herbal Sejahtera</title>
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
                        <a href="{{ route('kasir.transaksi-penjualan.create') }}" class="flex items-center gap-3 px-4 py-3 bg-[#90EE90] text-[#2d5016] rounded-lg font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                            </svg>
                            <span>Transaksi Penjualan</span>
                        </a>
                    </li>

                    <!-- Bukti Nota -->
                    <li>
                        <a href="{{ route('kasir.bukti-nota.index') }}" class="flex items-center gap-3 px-4 py-3 text-[#2d5016] hover:bg-[#D0F0D0] rounded-lg transition duration-200">
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
                <h2 class="text-3xl font-bold text-[#2d5016] mb-6">Transaksi Penjualan</h2>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="transaksiForm" method="POST" action="{{ route('kasir.transaksi-penjualan.store') }}" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    @csrf

                    <!-- Customer Info -->
                    <div class="mb-6">
                        <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Pelanggan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_pelanggan" name="nama_pelanggan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#90EE90] focus:border-[#90EE90]"
                            value="{{ old('nama_pelanggan') }}">
                    </div>

                    <!-- No HP -->
                    <div class="mb-6">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor HP
                        </label>
                        <input type="text" id="no_hp" name="no_hp"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#90EE90] focus:border-[#90EE90]"
                            value="{{ old('no_hp') }}" placeholder="Opsional">
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-6">
                        <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">
                            Metode Pembayaran <span class="text-red-500">*</span>
                        </label>
                        <select id="metode_pembayaran" name="metode_pembayaran" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#90EE90] focus:border-[#90EE90]">
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="Tunai" {{ old('metode_pembayaran') == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="Transfer" {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                    </div>

                    <!-- Products Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-[#2d5016] mb-4">Daftar Produk</h3>
                        <div id="produkContainer">
                            <!-- Product rows will be added here dynamically -->
                        </div>
                        <button type="button" id="tambahProduk" class="mt-4 bg-[#90EE90] hover:bg-[#7ED87E] text-[#2d5016] px-4 py-2 rounded-lg font-semibold transition duration-200">
                            + Tambah Produk
                        </button>
                    </div>

                    <!-- Total -->
                    <div class="mb-6 p-4 bg-[#E8F5E9] rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-[#2d5016]">Total Bayar:</span>
                            <span id="totalBayar" class="text-2xl font-bold text-[#2d5016]">Rp 0</span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#2d5016] hover:bg-[#1a3009] text-white px-8 py-3 rounded-lg font-semibold transition duration-200">
                            Simpan
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <script>
        const produkData = @json($produks);
        let produkCounter = 0;

        // Add first product row
        document.addEventListener('DOMContentLoaded', function() {
            tambahProduk();
        });

        document.getElementById('tambahProduk').addEventListener('click', tambahProduk);

        function tambahProduk() {
            produkCounter++;
            const container = document.getElementById('produkContainer');
            const row = document.createElement('div');
            row.className = 'produk-row mb-4 p-4 border border-gray-300 rounded-lg';
            row.id = `produk-row-${produkCounter}`;

            row.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Produk <span class="text-red-500">*</span></label>
                        <select name="produk_id[]" class="produk-select w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#90EE90] focus:border-[#90EE90]" required>
                            <option value="">Pilih Produk</option>
                            ${produkData.map(p => `<option value="${p.id}" data-harga="${p.harga_jual}">${p.nama_produk} - Rp ${parseFloat(p.harga_jual).toLocaleString('id-ID')}</option>`).join('')}
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Harga Satuan</label>
                        <input type="text" class="harga-satuan w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah[]" class="jumlah w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#90EE90] focus:border-[#90EE90]" min="1" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subtotal</label>
                        <input type="text" class="subtotal w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                        <button type="button" class="hapus-produk mt-2 text-red-600 hover:text-red-800 text-sm">Hapus</button>
                    </div>
                </div>
            `;

            container.appendChild(row);

            // Event listeners
            const produkSelect = row.querySelector('.produk-select');
            const hargaSatuan = row.querySelector('.harga-satuan');
            const jumlah = row.querySelector('.jumlah');
            const subtotal = row.querySelector('.subtotal');
            const hapusBtn = row.querySelector('.hapus-produk');

            produkSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const harga = selectedOption.getAttribute('data-harga');
                hargaSatuan.value = harga ? 'Rp ' + parseFloat(harga).toLocaleString('id-ID') : '';
                hitungSubtotal(row);
            });

            jumlah.addEventListener('input', function() {
                hitungSubtotal(row);
            });

            hapusBtn.addEventListener('click', function() {
                row.remove();
                hitungTotal();
            });
        }

        function hitungSubtotal(row) {
            const produkSelect = row.querySelector('.produk-select');
            const jumlah = row.querySelector('.jumlah');
            const subtotal = row.querySelector('.subtotal');

            if (produkSelect.value && jumlah.value) {
                const harga = parseFloat(produkSelect.options[produkSelect.selectedIndex].getAttribute('data-harga'));
                const qty = parseFloat(jumlah.value);
                const total = harga * qty;
                subtotal.value = 'Rp ' + total.toLocaleString('id-ID');
            } else {
                subtotal.value = '';
            }

            hitungTotal();
        }

        function hitungTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(subtotal => {
                const value = subtotal.value.replace('Rp ', '').replace(/\./g, '');
                if (value) {
                    total += parseFloat(value);
                }
            });

            document.getElementById('totalBayar').textContent = 'Rp ' + total.toLocaleString('id-ID');
        }

        // Validate form before submit
        document.getElementById('transaksiForm').addEventListener('submit', function(e) {
            const produkRows = document.querySelectorAll('.produk-row');
            if (produkRows.length === 0) {
                e.preventDefault();
                alert('Minimal harus ada satu produk!');
                return false;
            }

            let hasValidProduct = false;
            produkRows.forEach(row => {
                const produkSelect = row.querySelector('.produk-select');
                const jumlah = row.querySelector('.jumlah');
                if (produkSelect.value && jumlah.value) {
                    hasValidProduct = true;
                }
            });

            if (!hasValidProduct) {
                e.preventDefault();
                alert('Minimal harus ada satu produk yang valid!');
                return false;
            }
        });
    </script>
</body>
</html>


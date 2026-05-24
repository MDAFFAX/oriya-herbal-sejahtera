<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - Oriya Herbal Sejahtera</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #F0FFF0;
        }
    </style>
</head>
<body class="min-h-screen bg-[#F0FFF0]">
    <!-- Header -->
    <header class="bg-[#2d5016] text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#2d5016]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">ORIYA HERBAL SEJAHTERA</h1>
                        <p class="text-sm text-[#90EE90]">Dashboard Kasir</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm">Selamat datang, {{ $user->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-[#90EE90] hover:bg-[#7ED87E] text-[#2d5016] px-4 py-2 rounded-lg font-semibold transition duration-200">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-[#2d5016] mb-2">Dashboard Kasir</h2>
            <p class="text-gray-600">Halaman kasir akan segera tersedia.</p>
        </div>
    </main>
</body>
</html>












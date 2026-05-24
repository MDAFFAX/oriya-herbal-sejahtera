<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Oriya Herbal Sejahtera</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #F0FFF0;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[#F0FFF0]">
    <div class="w-full max-w-md">
        <!-- Logo and Brand -->
        <div class="bg-[#E0FFE0] rounded-lg p-8 shadow-lg border border-[#C0E0C0]">
            <div class="flex items-center justify-center mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-16 h-16 bg-[#2d5016] rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-[#2d5016]">ORIYA HERBAL</h1>
                        <p class="text-sm text-[#2d5016]">SEJAHTERA</p>
                    </div>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Field -->
                <div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        placeholder="Username (Gmail)" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#90EE90] focus:border-transparent @error('email') border-red-500 @enderror"
                        required
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        placeholder="Password" 
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#90EE90] focus:border-transparent @error('password') border-red-500 @enderror"
                        required
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Dropdown -->
                <div>
                    <select 
                        name="role" 
                        id="role"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#90EE90] focus:border-transparent appearance-none bg-white @error('role') border-red-500 @enderror"
                        required
                    >
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Login Button -->
                <button 
                    type="submit"
                    class="w-full bg-[#90EE90] hover:bg-[#7ED87E] text-[#2d5016] font-semibold py-3 rounded-lg transition duration-200 shadow-md hover:shadow-lg"
                >
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>












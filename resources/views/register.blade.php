<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - DONE CELL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="min-h-screen flex">

    <!-- LEFT PANEL -->
    <div class="hidden lg:flex flex-col justify-between w-2/5 bg-[#0c1424] border-r border-[#1a2744] p-12">

        <div>
            <h1 class="text-3xl font-bold text-[#f0f4ff]">
                DONE CELL
            </h1>

            <p class="text-xs text-[#4a5568] mt-1">
                REPAIR SERVICE
            </p>
        </div>

        <div>

            <h2 class="text-4xl font-bold text-[#f0f4ff] leading-tight mb-4">
                Buat akun<br>
                DONE CELL
            </h2>

            <p class="text-[#8892a4] leading-relaxed">
                Bergabung dan nikmati layanan servis smartphone
                yang cepat dan terpercaya.
            </p>

            <div class="mt-8 flex flex-col gap-3 text-sm text-[#8892a4]">
                <p>✅ Akun gratis</p>
                <p>📊 Pantau pesanan servis</p>
                <p>🔔 Notifikasi status servis</p>
                <p>🏪 Berbagai metode pembayaran</p>
            </div>

        </div>

        <p class="text-xs text-[#4a5568]">
            © 2026 DONE CELL. All rights reserved.
        </p>

    </div>


    <!-- RIGHT PANEL -->
    <div class="flex-1 flex items-center justify-center p-6 overflow-y-auto">

        <div class="w-full max-w-md py-8">

            <!-- MOBILE LOGO -->
            <div class="lg:hidden mb-8">

                <h1 class="text-xl font-bold text-[#f0f4ff]">
                    DONE CELL
                </h1>

            </div>


            <h1 class="text-2xl font-bold text-[#f0f4ff]">
                Create account
            </h1>

            <p class="text-sm text-[#8892a4] mt-1 mb-8">
                Isi data Anda untuk membuat akun
            </p>


            <!-- ERROR VALIDATION -->
            @if ($errors->any())

                <div class="mb-5 p-4 rounded-lg bg-red-500/10 border border-red-500/30 text-red-400 text-sm">

                    <p class="font-semibold mb-2">
                        Terjadi kesalahan:
                    </p>

                    <ul class="list-disc list-inside space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- FORM -->
            <form action="/register" method="POST" class="flex flex-col gap-4">

                @csrf


                <!-- NAME -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Budi Santoso"
                        class="w-full px-4 py-3 rounded-lg
                        bg-[#0c1424]
                        border border-[#1a2744]
                        text-white
                        outline-none
                        focus:border-[#22d3ee]"
                    >

                </div>


                <!-- PHONE -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Nomor Telepon
                    </label>

                    <input
                        type="tel"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="081234567890"
                        class="w-full px-4 py-3 rounded-lg
                        bg-[#0c1424]
                        border border-[#1a2744]
                        text-white
                        outline-none
                        focus:border-[#22d3ee]"
                    >

                </div>


                <!-- EMAIL -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        class="w-full px-4 py-3 rounded-lg
                        bg-[#0c1424]
                        border border-[#1a2744]
                        text-white
                        outline-none
                        focus:border-[#22d3ee]"
                    >

                </div>


                <!-- PASSWORD -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Minimal 6 karakter"
                        class="w-full px-4 py-3 rounded-lg
                        bg-[#0c1424]
                        border border-[#1a2744]
                        text-white
                        outline-none
                        focus:border-[#22d3ee]"
                    >

                </div>


                <!-- CONFIRM PASSWORD -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        class="w-full px-4 py-3 rounded-lg
                        bg-[#0c1424]
                        border border-[#1a2744]
                        text-white
                        outline-none
                        focus:border-[#22d3ee]"
                    >

                </div>


                <!-- ADDRESS -->
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Alamat
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        placeholder="Jl. Merdeka No. 1"
                        class="w-full px-4 py-3 rounded-lg
                        bg-[#0c1424]
                        border border-[#1a2744]
                        text-white
                        outline-none
                        focus:border-[#22d3ee]
                        resize-none"
                    >{{ old('address') }}</textarea>

                </div>


                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full px-4 py-3 rounded-lg
                    bg-[#22d3ee]
                    text-[#080e1a]
                    font-semibold
                    hover:bg-[#06b6d4]
                    transition mt-2"
                >
                    Create Account
                </button>

            </form>


            <!-- LOGIN -->
            <p class="text-sm text-[#8892a4] mt-6 text-center">

                Sudah punya akun?

                <a
                    href="/login"
                    class="text-[#22d3ee] hover:underline font-medium"
                >
                    Masuk
                </a>

            </p>


            <!-- BACK -->
            <p class="text-center mt-3">

                <a
                    href="/"
                    class="text-[#4a5568] hover:text-[#8892a4] text-xs"
                >
                    ← Kembali ke Home
                </a>

            </p>

        </div>

    </div>

</div>

</body>
</html>
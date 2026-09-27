<!DOCTYPE html>
<html lang="{{ session('locale', 'id') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ session('locale', 'id') === 'id' ? 'Beranda - DONE CELL' : 'Home - DONE CELL' }}
    </title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

@php
    $locale = session('locale', 'id');
    $isId = $locale === 'id';

    $user = session('user', []);
    $activeRequest = session('activeRequest');

    $userName = $user['name'] ?? 'User';
@endphp


<div class="max-w-6xl mx-auto px-5 md:px-6 py-6 md:py-8">

    {{-- ===================================================== --}}
    {{-- HEADER --}}
    {{-- ===================================================== --}}

    <header class="flex items-center justify-between mb-7">

        <div>
            <p class="text-xs text-[#8892a4] mb-1">
                {{ $isId ? 'Selamat Datang,' : 'Welcome,' }}
            </p>

            <h1 class="text-xl md:text-2xl font-bold text-[#f0f4ff]">
                {{ $userName }} 👋
            </h1>
        </div>

        <div class="flex items-center gap-2">

            <a href="/notifications"
               class="w-10 h-10 rounded-xl
                      bg-[#0f1729]
                      border border-[#1a2744]
                      flex items-center justify-center
                      hover:border-[#22d3ee]
                      hover:text-[#22d3ee]
                      transition">

                🔔

            </a>

            <a href="/profile"
               class="w-10 h-10 rounded-xl
                      bg-[#0f1729]
                      border border-[#1a2744]
                      flex items-center justify-center
                      hover:border-[#22d3ee]
                      hover:text-[#22d3ee]
                      transition">

                👤

            </a>

        </div>

    </header>


    {{-- ===================================================== --}}
    {{-- HERO --}}
    {{-- ===================================================== --}}

    <section class="relative overflow-hidden rounded-3xl
                    border border-[#1a2744]
                    bg-[#0c1424]
                    mb-7">

        {{-- Glow --}}
        <div class="absolute -right-20 -top-24
                    w-80 h-80
                    bg-[#22d3ee]/10
                    rounded-full blur-3xl">
        </div>

        <div class="absolute right-10 bottom-0
                    w-40 h-40
                    bg-blue-500/10
                    rounded-full blur-3xl">
        </div>


        {{-- Background image --}}
        <img src="/images/phone-bg-1.png"
             alt="Smartphone"
             class="absolute inset-0
                    w-full h-full
                    object-cover
                    opacity-20">


        {{-- Overlay --}}
        <div class="absolute inset-0
                    bg-gradient-to-r
                    from-[#0c1424]
                    via-[#0c1424]/95
                    to-[#0c1424]/50">
        </div>


        <div class="relative z-10
                    min-h-[330px]
                    md:min-h-[360px]
                    flex items-center
                    px-6 py-8
                    md:px-10">


            {{-- LEFT CONTENT --}}
            <div class="max-w-xl">

                <div class="inline-flex items-center gap-2
                            px-3 py-1.5
                            rounded-full
                            bg-[#22d3ee]/10
                            border border-[#22d3ee]/20
                            text-[#22d3ee]
                            text-xs font-semibold
                            mb-5">

                    <span class="w-1.5 h-1.5
                                 rounded-full
                                 bg-[#22d3ee]">
                    </span>

                    DONE CELL SERVICE

                </div>


                <h2 class="text-3xl md:text-5xl
                           font-bold
                           leading-tight
                           tracking-tight
                           text-[#f0f4ff]">

                    {{ $isId
                        ? 'HP Bermasalah?'
                        : 'Phone Problem?' }}

                    <br>

                    <span class="text-[#22d3ee]">

                        {{ $isId
                            ? 'Cek & Servis dengan Mudah.'
                            : 'Check & Repair Easily.' }}

                    </span>

                </h2>


                <p class="mt-4
                          text-sm md:text-base
                          leading-relaxed
                          text-[#8892a4]
                          max-w-md">

                    {{ $isId
                        ? 'Pilih perangkat, tentukan jenis kerusakan, dan dapatkan estimasi biaya servis sebelum datang ke teknisi.'
                        : 'Select your device, choose the damage type, and get a repair estimate before visiting the technician.' }}

                </p>


                <div class="mt-6 flex flex-wrap gap-3">

                    <a href="/select-brand"
                       class="inline-flex items-center gap-2
                              px-5 py-3
                              rounded-xl
                              bg-[#22d3ee]
                              text-[#07111f]
                              text-sm
                              font-bold
                              hover:bg-cyan-300
                              transition">

                        {{ $isId ? 'Mulai Cek Kerusakan' : 'Check Your Phone' }}

                        <span>→</span>

                    </a>


                    <a href="/repair-history"
                       class="inline-flex items-center
                              px-5 py-3
                              rounded-xl
                              bg-white/5
                              border border-white/10
                              text-[#f0f4ff]
                              text-sm
                              font-semibold
                              hover:bg-white/10
                              transition">

                        {{ $isId ? 'Riwayat Servis' : 'Repair History' }}

                    </a>

                </div>

            </div>


            {{-- PHONE VISUAL --}}
            <div class="hidden md:flex
                        absolute
                        right-10
                        top-1/2
                        -translate-y-1/2
                        items-center
                        justify-center">

                <div class="relative">

                    {{-- Glow --}}
                    <div class="absolute inset-0
                                bg-[#22d3ee]/20
                                blur-3xl
                                rounded-full">
                    </div>


                    {{-- Phone --}}
                    <div class="relative
                                w-[145px]
                                h-[270px]
                                rounded-[28px]
                                border-[5px]
                                border-[#263650]
                                bg-[#07111f]
                                shadow-2xl
                                rotate-6">

                        {{-- Screen --}}
                        <div class="absolute inset-[6px]
                                    rounded-[21px]
                                    overflow-hidden
                                    bg-gradient-to-b
                                    from-[#13243b]
                                    via-[#0b1729]
                                    to-[#06101d]">

                            {{-- Camera --}}
                            <div class="absolute
                                        top-2 left-1/2
                                        -translate-x-1/2
                                        w-12 h-3
                                        rounded-full
                                        bg-black">
                            </div>


                            {{-- Screen content --}}
                            <div class="h-full
                                        flex flex-col
                                        items-center
                                        justify-center
                                        text-center
                                        px-4">

                                <div class="w-12 h-12
                                            rounded-2xl
                                            bg-[#22d3ee]/10
                                            border border-[#22d3ee]/20
                                            flex items-center
                                            justify-center
                                            text-2xl
                                            mb-3">

                                    📱

                                </div>

                                <p class="text-[10px]
                                          font-semibold
                                          text-white">

                                    DONE CELL

                                </p>

                                <p class="text-[8px]
                                          text-[#718096]
                                          mt-1">

                                    Repair Service

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ===================================================== --}}
    {{-- HOW IT WORKS --}}
    {{-- ===================================================== --}}

    <section class="mb-8">

        <div class="mb-4">

            <p class="text-xs
                      text-[#22d3ee]
                      font-semibold
                      uppercase
                      tracking-wider">

                {{ $isId ? 'Cara Kerja' : 'How It Works' }}

            </p>

            <h2 class="text-lg
                       md:text-xl
                       font-bold
                       text-[#f0f4ff]
                       mt-1">

                {{ $isId
                    ? 'Servis jadi lebih simpel'
                    : 'Repair made simple' }}

            </h2>

        </div>


        <div class="grid grid-cols-1
                    sm:grid-cols-3
                    gap-3">


            {{-- STEP 1 --}}
            <div class="relative
                        bg-[#0f1729]
                        border border-[#1a2744]
                        rounded-2xl
                        p-5">

                <div class="w-11 h-11
                            rounded-xl
                            bg-cyan-500/10
                            border border-cyan-400/10
                            flex items-center
                            justify-center
                            text-xl
                            mb-4">

                    <>

                </div>

                <span class="absolute
                             top-4 right-4
                             text-xs
                             font-bold
                             text-[#334155]">

                    01

                </span>

                <h3 class="font-semibold text-sm mb-1">

                    {{ $isId
                        ? 'Pilih Perangkat'
                        : 'Choose Device' }}

                </h3>

                <p class="text-xs
                          text-[#8892a4]
                          leading-relaxed">

                    {{ $isId
                        ? 'Pilih merek dan model HP yang ingin diperiksa.'
                        : 'Select the brand and model of your phone.' }}

                </p>

            </div>


            {{-- STEP 2 --}}
            <div class="relative
                        bg-[#0f1729]
                        border border-[#1a2744]
                        rounded-2xl
                        p-5">

                <div class="w-11 h-11
                            rounded-xl
                            bg-cyan-500/10
                            border border-cyan-400/10
                            flex items-center
                            justify-center
                            text-xl
                            mb-4">

                    🔍

                </div>

                <span class="absolute
                             top-4 right-4
                             text-xs
                             font-bold
                             text-[#334155]">

                    02

                </span>

                <h3 class="font-semibold text-sm mb-1">

                    {{ $isId
                        ? 'Pilih Kerusakan'
                        : 'Select Damage' }}

                </h3>

                <p class="text-xs
                          text-[#8892a4]
                          leading-relaxed">

                    {{ $isId
                        ? 'Tentukan kategori dan jenis kerusakan HP.'
                        : 'Choose the damage category and type.' }}

                </p>

            </div>


            {{-- STEP 3 --}}
            <div class="relative
                        bg-[#0f1729]
                        border border-[#1a2744]
                        rounded-2xl
                        p-5">

                <div class="w-11 h-11
                            rounded-xl
                            bg-cyan-500/10
                            border border-cyan-400/10
                            flex items-center
                            justify-center
                            text-xl
                            mb-4">

                    💰

                </div>

                <span class="absolute
                             top-4 right-4
                             text-xs
                             font-bold
                             text-[#334155]">

                    03

                </span>

                <h3 class="font-semibold text-sm mb-1">

                    {{ $isId
                        ? 'Dapatkan Estimasi'
                        : 'Get Estimate' }}

                </h3>

                <p class="text-xs
                          text-[#8892a4]
                          leading-relaxed">

                    {{ $isId
                        ? 'Lihat perkiraan harga sebelum melakukan servis.'
                        : 'See the estimated price before repair.' }}

                </p>

            </div>

        </div>

    </section>


    {{-- ===================================================== --}}
    {{-- ACTIVE REPAIR --}}
    {{-- ===================================================== --}}

    <section class="mb-8">

        <div class="flex items-center justify-between mb-4">

            <div>

                <p class="text-xs
                          text-[#22d3ee]
                          font-semibold
                          uppercase
                          tracking-wider">

                    {{ $isId ? 'Aktivitas' : 'Activity' }}

                </p>

                <h2 class="text-lg
                           font-bold
                           text-[#f0f4ff]
                           mt-1">

                    {{ $isId ? 'Servis Terbaru' : 'Latest Repair' }}

                </h2>

            </div>


            <a href="/repair-history"
               class="text-xs
                      text-[#22d3ee]
                      hover:text-cyan-300
                      transition">

                {{ $isId ? 'Lihat semua →' : 'View all →' }}

            </a>

        </div>


        @if($activeRequest)

            <a href="/repair-history"
               class="block
                      bg-[#0f1729]
                      border border-[#1a2744]
                      rounded-2xl
                      p-5
                      hover:border-[#22d3ee]/40
                      transition">

                <div class="flex items-start
                            justify-between
                            gap-4">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11
                                    rounded-xl
                                    bg-cyan-500/10
                                    flex items-center
                                    justify-center
                                    text-xl">

                            📱

                        </div>

                        <div>

                            <p class="font-semibold
                                      text-[#f0f4ff]">

                                {{ $activeRequest['brand'] ?? 'Unknown Brand' }}

                                {{ $activeRequest['model'] ?? '' }}

                            </p>

                            <p class="text-xs
                                      text-[#8892a4]
                                      mt-1">

                                {{ $activeRequest['damageName'] ?? 'Repair Request' }}

                            </p>

                        </div>

                    </div>


                    <span class="px-2.5 py-1
                                 rounded-full
                                 text-xs
                                 font-medium
                                 bg-cyan-500/10
                                 text-cyan-400">

                        {{ $isId ? 'Menunggu' : 'Waiting' }}

                    </span>

                </div>


                <div class="mt-4
                            pt-3
                            border-t
                            border-[#1a2744]
                            flex justify-between
                            text-xs
                            text-[#4a5568]">

                    <span>
                        #{{ $activeRequest['requestId'] ?? 'REQ-001' }}
                    </span>

                    <span>
                        {{ $isId ? 'Lihat detail →' : 'View details →' }}
                    </span>

                </div>

            </a>

        @else

            <div class="bg-[#0f1729]
                        border border-[#1a2744]
                        rounded-2xl
                        p-7
                        text-center">

                <div class="w-14 h-14
                            mx-auto
                            rounded-2xl
                            bg-cyan-500/10
                            flex items-center
                            justify-center
                            text-2xl
                            mb-4">

                    🔧

                </div>

                <p class="text-sm
                          font-semibold
                          text-[#f0f4ff]">

                    {{ $isId
                        ? 'Belum ada servis'
                        : 'No repairs yet' }}

                </p>

                <p class="text-xs
                          text-[#8892a4]
                          mt-1 mb-4">

                    {{ $isId
                        ? 'Mulai request servis pertama Anda.'
                        : 'Start your first repair request.' }}

                </p>

                <a href="/select-brand"
                   class="inline-flex
                          items-center
                          gap-2
                          px-4 py-2
                          rounded-xl
                          bg-[#22d3ee]
                          text-[#07111f]
                          text-sm
                          font-semibold
                          hover:bg-cyan-300
                          transition">

                    {{ $isId ? 'Mulai Servis' : 'Start Repair' }}

                    →

                </a>

            </div>

        @endif

    </section>


    {{-- ===================================================== --}}
    {{-- POPULAR SERVICES --}}
    {{-- ===================================================== --}}

    <section class="mb-8">

        <div class="flex items-end
                    justify-between
                    mb-4">

            <div>

                <p class="text-xs
                          text-[#22d3ee]
                          font-semibold
                          uppercase
                          tracking-wider">

                    {{ $isId ? 'Layanan' : 'Services' }}

                </p>

                <h2 class="text-lg
                           md:text-xl
                           font-bold
                           text-[#f0f4ff]
                           mt-1">

                    {{ $isId ? 'Kerusakan Populer' : 'Popular Repairs' }}

                </h2>

            </div>

            <a href="/select-brand"
               class="text-xs
                      text-[#22d3ee]
                      hover:text-cyan-300">

                {{ $isId ? 'Lihat semua →' : 'View all →' }}

            </a>

        </div>


        <div class="grid
                    grid-cols-2
                    lg:grid-cols-4
                    gap-3">


            {{-- LCD --}}
            <a href="/select-brand"
               class="group
                      bg-[#0f1729]
                      border border-[#1a2744]
                      rounded-2xl
                      p-4
                      hover:border-[#22d3ee]/50
                      hover:-translate-y-1
                      transition">

                <div class="w-11 h-11
                            rounded-xl
                            bg-cyan-500/10
                            flex items-center
                            justify-center
                            text-xl
                            mb-4
                            group-hover:bg-cyan-500/20
                            transition">

                    📱

                </div>

                <h3 class="text-sm
                           font-semibold
                           text-[#f0f4ff]">

                    LCD

                </h3>

                <p class="text-[11px]
                          text-[#8892a4]
                          mt-1">

                    {{ $isId ? 'Ganti layar rusak' : 'Replace damaged screen' }}

                </p>

                <p class="text-xs
                          text-[#22d3ee]
                          font-medium
                          mt-3">

                    Rp150K – Rp500K

                </p>

            </a>


            {{-- BATTERY --}}
            <a href="/select-brand"
               class="group
                      bg-[#0f1729]
                      border border-[#1a2744]
                      rounded-2xl
                      p-4
                      hover:border-[#22d3ee]/50
                      hover:-translate-y-1
                      transition">

                <div class="w-11 h-11
                            rounded-xl
                            bg-cyan-500/10
                            flex items-center
                            justify-center
                            text-xl
                            mb-4
                            group-hover:bg-cyan-500/20
                            transition">

                    🔋

                </div>

                <h3 class="text-sm
                           font-semibold
                           text-[#f0f4ff]">

                    Battery

                </h3>

                <p class="text-[11px]
                          text-[#8892a4]
                          mt-1">

                    {{ $isId ? 'Ganti baterai' : 'Battery replacement' }}

                </p>

                <p class="text-xs
                          text-[#22d3ee]
                          font-medium
                          mt-3">

                    Rp100K – Rp350K

                </p>

            </a>


            {{-- BUTTON --}}
            <a href="/select-brand"
               class="group
                      bg-[#0f1729]
                      border border-[#1a2744]
                      rounded-2xl
                      p-4
                      hover:border-[#22d3ee]/50
                      hover:-translate-y-1
                      transition">

                <div class="w-11 h-11
                            rounded-xl
                            bg-cyan-500/10
                            flex items-center
                            justify-center
                            text-xl
                            mb-4
                            group-hover:bg-cyan-500/20
                            transition">

                    🔘

                </div>

                <h3 class="text-sm
                           font-semibold
                           text-[#f0f4ff]">

                    Button

                </h3>

                <p class="text-[11px]
                          text-[#8892a4]
                          mt-1">

                    {{ $isId ? 'Perbaikan tombol' : 'Button repair' }}

                </p>

                <p class="text-xs
                          text-[#22d3ee]
                          font-medium
                          mt-3">

                    Rp100K – Rp300K

                </p>

            </a>


            {{-- DEAD PHONE --}}
            <a href="/select-brand"
               class="group
                      bg-[#0f1729]
                      border border-[#1a2744]
                      rounded-2xl
                      p-4
                      hover:border-[#22d3ee]/50
                      hover:-translate-y-1
                      transition">

                <div class="w-11 h-11
                            rounded-xl
                            bg-cyan-500/10
                            flex items-center
                            justify-center
                            text-xl
                            mb-4
                            group-hover:bg-cyan-500/20
                            transition">

                    ⚡

                </div>

                <h3 class="text-sm
                           font-semibold
                           text-[#f0f4ff]">

                    Dead Phone

                </h3>

                <p class="text-[11px]
                          text-[#8892a4]
                          mt-1">

                    {{ $isId ? 'HP tidak menyala' : 'Phone won’t turn on' }}

                </p>

                <p class="text-xs
                          text-[#22d3ee]
                          font-medium
                          mt-3">

                    Rp200K – Rp600K

                </p>

            </a>

        </div>


        <p class="text-[11px]
                  text-[#4a5568]
                  text-center
                  mt-4">

            {{ $isId
                ? 'Harga merupakan estimasi dan dapat berbeda berdasarkan model serta kondisi HP.'
                : 'Prices are estimates and may vary depending on phone model and condition.' }}

        </p>

    </section>


    {{-- ===================================================== --}}
    {{-- QUICK ACTIONS --}}
    {{-- ===================================================== --}}

    


    {{-- FOOTER --}}
    <p class="text-center
              text-[10px]
              text-[#334155]
              pt-3">

        DONE CELL • Smartphone Repair Service

    </p>

</div>

</body>
</html>
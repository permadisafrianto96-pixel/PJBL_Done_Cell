<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONE CELL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#0B0D10] text-[#F5F7FA] overflow-x-hidden">

```
<!-- Navbar -->
<nav class="fixed top-0 left-0 right-0 z-40 bg-[#0B0D10]/90 backdrop-blur-xl border-b border-[#252C34]">
    <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-[#22D3EE] flex items-center justify-center">
                <span class="text-[#0B0D10] font-bold">D</span>
            </div>

            <span class="font-bold text-lg tracking-tight">
                DONE CELL
            </span>
        </div>

        <!-- Button -->
        <div class="flex items-center gap-3">
            <a href="/login"
                class="px-4 py-2 text-sm text-[#8B949E] hover:text-white transition">
                Masuk
            </a>

            <a href="/register"
                class="px-4 py-2 text-sm font-semibold rounded-lg bg-[#22D3EE] text-[#0B0D10] hover:bg-[#06B6D4] transition">
                Daftar
            </a>
        </div>

    </div>
</nav>


<!-- Hero -->
<section class="pt-32 pb-24 px-6 relative overflow-hidden">

    <!-- Background Effect -->
    <div class="absolute inset-0 pointer-events-none">

        <div class="absolute top-20 left-1/2 -translate-x-1/2
            w-[800px] h-[400px]
            bg-[#22D3EE] opacity-[0.035]
            rounded-full blur-3xl">
        </div>

        <div class="absolute inset-0"
            style="
            background-image: radial-gradient(circle at 1px 1px, #252C34 1px, transparent 0);
            background-size: 40px 40px;
            ">
        </div>

    </div>


    <!-- Hero Content -->
    <div class="max-w-4xl mx-auto text-center relative">

        <!-- Badge -->
        <div class="inline-flex items-center gap-2
            px-4 py-2 rounded-full
            bg-[rgba(34,211,238,0.07)]
            border border-[rgba(34,211,238,0.18)]
            text-[#22D3EE]
            text-sm font-medium mb-8">

            <span class="w-2 h-2 rounded-full bg-[#22D3EE] animate-pulse"></span>

            Layanan Servis Smartphone Profesional
        </div>


        <!-- Heading -->
        <h1 class="text-5xl md:text-7xl font-bold leading-[1.05] mb-6">

            Hp Anda,

            <span
                class="text-transparent bg-clip-text"
                style="
                background-image: linear-gradient(
                    135deg,
                    #22D3EE,
                    #06B6D4
                );
                ">
                Kembali Prima.
            </span>

        </h1>


        <!-- Description -->
        <p class="text-lg text-[#8B949E] max-w-xl mx-auto mb-10 leading-relaxed">

            Layanan perbaikan untuk Xiaomi, Samsung, OPPO, Vivo, dan Infinix.
Harga transparan, pengerjaan cepat, dan kualitas yang dapat Anda percaya.

        </p>


        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">

            <a href="/register"
                class="px-6 py-3 rounded-lg
                bg-[#22D3EE]
                text-[#0B0D10]
                font-semibold
                hover:bg-[#06B6D4]
                transition
                flex items-center gap-2">

                Pesan Servis

                <span>→</span>
            </a>

            <a href="/login"
                class="px-6 py-3 rounded-lg
                border border-[#252C34]
                text-[#F5F7FA]
                font-semibold
                hover:bg-[#151A20]
                transition">

                Masuk untuk Melacak

            </a>

        </div>

    </div>

</section>


<!-- Stats -->
<section class="px-6 pb-24">

    <div class="max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-4">

        <div class="text-center bg-[#151A20] border border-[#252C34] rounded-2xl p-5">
            <p class="text-3xl font-bold text-[#22D3EE]">800+</p>
            <p class="text-sm text-[#8B949E] mt-1">Memperbaiki Perangkat</p>
        </div>

        <div class="text-center bg-[#151A20] border border-[#252C34] rounded-2xl p-5">
            <p class="text-3xl font-bold text-[#22D3EE]">50%</p>
            <p class="text-sm text-[#8B949E] mt-1">Tingkat Kepuasan</p>
        </div>

        <div class="text-center bg-[#151A20] border border-[#252C34] rounded-2xl p-5">
            <p class="text-3xl font-bold text-[#22D3EE]">24h</p>
            <p class="text-sm text-[#8B949E] mt-1">Rata-rata Pengerjaan</p>
        </div>

        <div class="text-center bg-[#151A20] border border-[#252C34] rounded-2xl p-5">
            <p class="text-3xl font-bold text-[#22D3EE]">5</p>
            <p class="text-sm text-[#8B949E] mt-1">Dukung Brand Ini</p>
        </div>

    </div>

</section>


<!-- Features -->
<section class="py-24 px-6 bg-[#101419]">

    <div class="max-w-5xl mx-auto">

        <!-- Heading -->
        <div class="text-center mb-14">

            <p class="text-xs font-semibold tracking-widest
                text-[#22D3EE] uppercase mb-3">

                Mengapa Memilih Kami

            </p>

            <h2 class="text-3xl md:text-4xl font-bold">
                Dibuat untuk Keandalan
            </h2>

            <p class="text-[#8B949E] mt-3 max-w-lg mx-auto">

                Setiap perbaikan ditangani dengan teliti dan didukung
oleh komitmen layanan kami.

            </p>

        </div>


        <!-- Feature Cards -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <!-- Card 1 -->
            <div class="bg-[#151A20]
                border border-[#252C34]
                rounded-2xl p-6
                hover:border-[#22D3EE]/30
                transition-all group">

                <div class="w-10 h-10 rounded-xl
                    bg-[rgba(34,211,238,0.08)]
                    flex items-center justify-center
                    text-[#22D3EE]
                    mb-4
                    group-hover:scale-110
                    transition-transform">

                    ⚡

                </div>

                <h3 class="font-semibold text-[#F5F7FA] mb-2">
                    Pengerjaan Cepat
                </h3>

                <p class="text-sm text-[#8B949E] leading-relaxed">
                    Same-day service for light damage.
                    Quick diagnosis and transparent pricing.
                </p>

            </div>


            <!-- Card 2 -->
            <div class="bg-[#151A20]
                border border-[#252C34]
                rounded-2xl p-6
                hover:border-[#22D3EE]/30
                transition-all group">

                <div class="w-10 h-10 rounded-xl
                    bg-[rgba(34,211,238,0.08)]
                    flex items-center justify-center
                    text-[#22D3EE]
                    mb-4
                    group-hover:scale-110
                    transition-transform">

                    🛡️

                </div>

                <h3 class="font-semibold text-[#F5F7FA] mb-2">
                    Teknisi Terpercaya
                </h3>

                <p class="text-sm text-[#8B949E] leading-relaxed">
                    Certified repair specialists with years of
                    experience across all major brands.
                </p>

            </div>


            <!-- Card 3 -->
            <div class="bg-[#151A20]
                border border-[#252C34]
                rounded-2xl p-6
                hover:border-[#22D3EE]/30
                transition-all group">

                <div class="w-10 h-10 rounded-xl
                    bg-[rgba(34,211,238,0.08)]
                    flex items-center justify-center
                    text-[#22D3EE]
                    mb-4
                    group-hover:scale-110
                    transition-transform">

                    ✓

                </div>

                <h3 class="font-semibold text-[#F5F7FA] mb-2">
                    Kualitas Terjamin
                </h3>

                <p class="text-sm text-[#8B949E] leading-relaxed">
                    All repairs backed by a service guarantee.
                    Quality parts whenever possible.
                </p>

            </div>


            <!-- Card 4 -->
            <div class="bg-[#151A20]
                border border-[#252C34]
                rounded-2xl p-6
                hover:border-[#22D3EE]/30
                transition-all group">

                <div class="w-10 h-10 rounded-xl
                    bg-[rgba(34,211,238,0.08)]
                    flex items-center justify-center
                    text-[#22D3EE]
                    mb-4
                    group-hover:scale-110
                    transition-transform">

                    📱

                </div>

                <h3 class="font-semibold text-[#F5F7FA] mb-2">
                    Merk utama
                </h3>

                <p class="text-sm text-[#8B949E] leading-relaxed">
                    Xiaomi, Samsung, OPPO, Vivo, Infinix dan lain nya.
                    
                </p>

            </div>

        </div>

    </div>

</section>


<!-- How It Works -->
<section class="py-24 px-6">

    <div class="max-w-5xl mx-auto">

        <div class="text-center mb-14">

            <p class="text-xs font-semibold tracking-widest
                text-[#22D3EE] uppercase mb-3">

                How It Works

            </p>

            <h2 class="text-3xl md:text-4xl font-bold">
                Simple. Transparent. Fast.
            </h2>

        </div>


        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Step 01 -->
            <div class="relative">

                <div class="flex flex-col items-start gap-4">

                    <div class="w-12 h-12 rounded-2xl
                        bg-[#151A20]
                        border border-[#252C34]
                        flex items-center justify-center
                        text-[#22D3EE]
                        font-mono text-sm font-bold">

                        01

                    </div>

                    <div>

                        <h3 class="font-semibold mb-1.5">
                            Select Your Device
                        </h3>

                        <p class="text-sm text-[#8B949E] leading-relaxed">
                            Choose your brand and phone model
                            from our supported list.
                        </p>

                    </div>

                </div>

            </div>


            <!-- Step 02 -->
            <div class="relative">

                <div class="flex flex-col items-start gap-4">

                    <div class="w-12 h-12 rounded-2xl
                        bg-[#151A20]
                        border border-[#252C34]
                        flex items-center justify-center
                        text-[#22D3EE]
                        font-mono text-sm font-bold">

                        02

                    </div>

                    <div>

                        <h3 class="font-semibold mb-1.5">
                            Pick the Damage
                        </h3>

                        <p class="text-sm text-[#8B949E] leading-relaxed">
                            Select the damage category and
                            specific issue you're experiencing.
                        </p>

                    </div>

                </div>

            </div>


            <!-- Step 03 -->
            <div class="relative">

                <div class="flex flex-col items-start gap-4">

                    <div class="w-12 h-12 rounded-2xl
                        bg-[#151A20]
                        border border-[#252C34]
                        flex items-center justify-center
                        text-[#22D3EE]
                        font-mono text-sm font-bold">

                        03

                    </div>

                    <div>

                        <h3 class="font-semibold mb-1.5">
                            Get a Fixed Price
                        </h3>

                        <p class="text-sm text-[#8B949E] leading-relaxed">
                            Our technician reviews and provides
                            a definitive fixed repair price.
                        </p>

                    </div>

                </div>

            </div>


            <!-- Step 04 -->
            <div class="relative">

                <div class="flex flex-col items-start gap-4">

                    <div class="w-12 h-12 rounded-2xl
                        bg-[#151A20]
                        border border-[#252C34]
                        flex items-center justify-center
                        text-[#22D3EE]
                        font-mono text-sm font-bold">

                        04

                    </div>

                    <div>

                        <h3 class="font-semibold mb-1.5">
                            Pay & Collect
                        </h3>

                        <p class="text-sm text-[#8B949E] leading-relaxed">
                            Pay via bank transfer or on-site,
                            then pick up your repaired device.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- Testimonials -->
<section class="py-24 px-6 bg-[#101419]">

    <div class="max-w-5xl mx-auto">

        <div class="text-center mb-14">

            <p class="text-xs font-semibold tracking-widest
                text-[#22D3EE] uppercase mb-3">

                Testimonials

            </p>

            <h2 class="text-3xl md:text-4xl font-bold">
                Trusted by customers
            </h2>

        </div>


        <div class="grid md:grid-cols-3 gap-5">

            <!-- Testimonial 1 -->
            <div class="bg-[#151A20]
                border border-[#252C34]
                rounded-2xl p-6">

                <div class="flex gap-0.5 mb-4 text-[#F59E0B]">
                    ★★★★★
                </div>

                <p class="text-sm text-[#C8D3E8]
                    leading-relaxed mb-5 italic">

                    "Fast and professional. My screen looks brand new.
                    Highly recommend DONE CELL!"

                </p>

                <p class="font-semibold text-sm">
                    Rizki M.
                </p>

                <p class="text-xs text-[#8B949E] mt-0.5">
                    Samsung Galaxy A25 · LCD Replacement
                </p>

            </div>


            <!-- Testimonial 2 -->
            <div class="bg-[#151A20]
                border border-[#252C34]
                rounded-2xl p-6">

                <div class="flex gap-0.5 mb-4 text-[#F59E0B]">
                    ★★★★★
                </div>

                <p class="text-sm text-[#C8D3E8]
                    leading-relaxed mb-5 italic">

                    "Transparent pricing and honest technicians.
                    Got my phone back same day!"

                </p>

                <p class="font-semibold text-sm">
                    Dewi S.
                </p>

                <p class="text-xs text-[#8B949E] mt-0.5">
                    Xiaomi Redmi Note 13 · Battery Replacement
                </p>

            </div>


            <!-- Testimonial 3 -->
            <div class="bg-[#151A20]
                border border-[#252C34]
                rounded-2xl p-6">

                <div class="flex gap-0.5 mb-4 text-[#F59E0B]">
                    ★★★★★
                </div>

                <p class="text-sm text-[#C8D3E8]
                    leading-relaxed mb-5 italic">

                    "Thought my phone was gone for good.
                    They brought it back to life within 3 days."

                </p>

                <p class="font-semibold text-sm">
                    Arif P.
                </p>

                <p class="text-xs text-[#8B949E] mt-0.5">
                    OPPO A78 · Dead Phone
                </p>

            </div>

        </div>

    </div>

</section>


<!-- CTA -->
<section class="py-24 px-6">

    <div class="max-w-2xl mx-auto text-center">

        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Ready to fix your phone?
        </h2>

        <p class="text-[#8B949E] mb-8">
            Create a free account and submit your repair request in minutes.
        </p>

        <a href="/register"
            class="inline-flex items-center gap-2
            px-6 py-3 rounded-lg
            bg-[#22D3EE]
            text-[#0B0D10]
            font-semibold
            hover:bg-[#06B6D4]
            transition">

            Get Started — It's Free

            <span>→</span>

        </a>

    </div>

</section>


<!-- Footer -->
<footer class="border-t border-[#252C34] py-8 px-6 text-center">

    <div class="flex items-center justify-center gap-2 mb-3">

        <div class="w-6 h-6 rounded-lg
            bg-[#22D3EE]
            flex items-center justify-center">

            <span class="text-[#0B0D10] text-xs font-bold">
                D
            </span>

        </div>

        <span class="font-bold text-sm">
            DONE CELL
        </span>

    </div>

    <p class="text-xs text-[#8B949E]">
        © 2026 DONE CELL Repair Service. All rights reserved.
    </p>

</footer>
```

</body>
</html>

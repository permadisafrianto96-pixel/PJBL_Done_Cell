<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Select Brand - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-[#080e1a] text-white">

    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- Page Header --}}

        <div class="mb-8">

            <a href="/customer/home"
               class="inline-flex items-center gap-2 text-sm text-[#8892a4]
                      hover:text-[#22d3ee] transition">

                ← Back

            </a>

            <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">

                Select Brand

            </h1>

            <p class="text-sm text-[#8892a4] mt-1">

                Step 1 of 4 — Choose your phone brand

            </p>

        </div>


        {{-- Progress --}}

        <div class="flex gap-2 mb-8">

            @foreach(['Brand', 'Model', 'Category', 'Damage'] as $i => $step)

                <div class="flex-1 flex flex-col items-center gap-1">

                    <div class="h-1 w-full rounded-full
                        {{ $i === 0
                            ? 'bg-[#22d3ee]'
                            : 'bg-[#1a2744]' }}">

                    </div>

                    <span class="text-xs
                        {{ $i === 0
                            ? 'text-[#22d3ee] font-medium'
                            : 'text-[#4a5568]' }}">

                        {{ $step }}

                    </span>

                </div>

            @endforeach

        </div>


        {{-- Brand Cards --}}

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">

            @foreach($brands as $brand)

                <a href="/select-model?brand={{ urlencode($brand->name) }}"
                   class="p-5 rounded-2xl
                          bg-[#0f1729]
                          border border-[#1a2744]
                          block
                          group
                          hover:border-[#243356]
                          transition">

                    <div class="flex items-center gap-4">

                        {{-- Brand Logo --}}

                        <div class="w-14 h-14 rounded-2xl
                                    flex items-center justify-center
                                    text-white font-bold text-lg shrink-0
                                    bg-cyan-500/10
                                    text-cyan-400
                                    border border-cyan-500/20
                                    transition-transform
                                    group-hover:scale-105">

                            {{ $brandLogos[$brand->name] ?? strtoupper(substr($brand->name, 0, 2)) }}

                        </div>


                        {{-- Brand Info --}}

                        <div class="flex-1 min-w-0">

                            <h3 class="font-bold text-[#f0f4ff] text-lg">

                                {{ $brand->name }}

                            </h3>

                            <p class="text-xs text-[#8892a4] mt-0.5">

                                {{ $brandDescs[$brand->name] ?? 'Smartphone dan perangkat lainnya' }}

                            </p>

                        </div>


                        {{-- Arrow --}}

                        <span class="text-[#4a5568]
                                     group-hover:text-[#22d3ee]
                                     group-hover:translate-x-0.5
                                     transition-all">

                            →

                        </span>

                    </div>

                </a>

            @endforeach

        </div>


        {{-- Brand Lain --}}

        <div class="mt-6 p-5 rounded-2xl
                    bg-[#0f1729]
                    border border-[#1a2744]
                    block">

            <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-2xl
                            flex items-center justify-center
                            text-white font-bold text-lg shrink-0
                            bg-gray-500/10
                            text-gray-400
                            border border-gray-500/20">

                    ?

                </div>

                <div class="flex-1 min-w-0">

                    <h3 class="font-bold text-[#f0f4ff] text-lg">

                        Brand Lain

                    </h3>

                    <p class="text-xs text-[#8892a4] mt-0.5">

                        Tidak menemukan brand HP?

                    </p>

                </div>

            </div>


            {{-- Input Brand Lain --}}

            <form action="/select-brand" method="POST" class="mt-4">

                @csrf

                <input
                    type="text"
                    name="brand"
                    placeholder="Masukkan brand HP"
                    required
                    maxlength="100"
                    class="w-full px-4 py-3 rounded-xl
                           bg-[#080e1a]
                           border border-[#1a2744]
                           text-white
                           text-sm
                           outline-none
                           focus:border-[#22d3ee]">

                <button
                    type="submit"
                    class="w-full mt-3 px-4 py-3 rounded-xl
                           bg-[#22d3ee]
                           text-[#080e1a]
                           text-sm font-semibold
                           hover:bg-[#67e8f9]
                           transition">

                    Lanjut →

                </button>

            </form>

        </div>


        {{-- Contact --}}

        <div class="mt-6 p-4 rounded-2xl
                    bg-[#0f1729]
                    border border-[#1a2744]">

            <p class="text-xs text-[#8892a4] text-center">

                Don't see your brand?

                <button class="text-[#22d3ee] hover:underline">

                    Contact us

                </button>

                for other models.

            </p>

        </div>

    </div>

</body>

</html>
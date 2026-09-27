<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Select Model - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="max-w-6xl mx-auto px-6 py-8">

    {{-- Header --}}

    <div class="mb-8">

        <a href="/select-brand"
           class="text-sm text-[#8892a4] hover:text-[#22d3ee]">

            ← Back

        </a>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">

            Select Model

        </h1>

        <p class="text-sm text-[#8892a4] mt-1">

            Step 2 of 4 — {{ $brand }} models

        </p>

    </div>


    {{-- Progress --}}

    <div class="flex gap-2 mb-8">

        <div class="flex-1">

            <div class="h-1 rounded-full bg-[#22d3ee]"></div>

            <p class="text-xs text-[#22d3ee] mt-1 text-center">
                Brand
            </p>

        </div>

        <div class="flex-1">

            <div class="h-1 rounded-full bg-[#22d3ee]"></div>

            <p class="text-xs text-[#22d3ee] mt-1 text-center">
                Model
            </p>

        </div>

        <div class="flex-1">

            <div class="h-1 rounded-full bg-[#1a2744]"></div>

            <p class="text-xs text-[#4a5568] mt-1 text-center">
                Category
            </p>

        </div>

        <div class="flex-1">

            <div class="h-1 rounded-full bg-[#1a2744]"></div>

            <p class="text-xs text-[#4a5568] mt-1 text-center">
                Damage
            </p>

        </div>

    </div>


    {{-- Selected Brand --}}

    <div class="flex items-center gap-3 mb-6 px-4 py-3
                rounded-2xl bg-[#0f1729] border border-[#1a2744]">

        <div class="w-8 h-8 rounded-xl
                    flex items-center justify-center
                    font-bold text-sm
                    bg-cyan-500/10 text-cyan-400">

            {{ strtoupper(substr($brand, 0, 2)) }}

        </div>

        <div>

            <p class="text-xs text-[#8892a4]">
                Selected brand
            </p>

            <p class="font-semibold text-[#f0f4ff]">
                {{ $brand }}
            </p>

        </div>

    </div>


    {{-- Models --}}

    <div class="flex flex-col gap-3">

        @forelse($brandModels as $model)

            <a href="/select-category?model={{ urlencode($model['name']) }}"
               class="block p-4 rounded-2xl
                      bg-[#0f1729]
                      border border-[#1a2744]
                      hover:border-[#243356]
                      transition">

                <div class="flex items-center gap-4">

                    {{-- Phone Icon --}}

                    <div class="w-12 h-12 rounded-xl
                                bg-[#0c1424]
                                border border-[#1a2744]
                                flex items-center justify-center">

                        📱

                    </div>


                    {{-- Model Info --}}

                    <div class="flex-1">

                        <div class="flex items-center gap-2">

                            <h3 class="font-semibold text-[#f0f4ff]">

                                {{ $model['name'] }}

                            </h3>

                            <span class="px-2 py-1 rounded-lg
                                         text-xs
                                         bg-cyan-500/10
                                         text-cyan-400">

                                {{ $model['type'] }}

                            </span>

                        </div>

                        <p class="text-xs text-[#8892a4] mt-1">

                            {{ $model['description'] }}

                        </p>

                    </div>


                    {{-- Arrow --}}

                    <span class="text-[#4a5568]">

                        →

                    </span>

                </div>

            </a>

        @empty

            <div class="p-5 rounded-2xl
                        bg-[#0f1729]
                        border border-[#1a2744]
                        text-center">

                <p class="text-sm text-[#8892a4]">

                    Belum ada model untuk brand ini.

                </p>

            </div>

        @endforelse


        {{-- Model Lain --}}

        <div class="mt-3 p-5 rounded-2xl
                    bg-[#0f1729]
                    border border-[#1a2744]">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-xl
                            bg-gray-500/10
                            border border-gray-500/20
                            text-gray-400
                            flex items-center justify-center
                            font-bold text-lg">

                    ?

                </div>

                <div>

                    <h3 class="font-semibold text-[#f0f4ff]">

                        Model Lain

                    </h3>

                    <p class="text-xs text-[#8892a4] mt-1">

                        Tidak menemukan model HP?

                    </p>

                </div>

            </div>


            {{-- Input Model Lain --}}

            <form action="/select-category" method="GET" class="mt-4">

                <input
                    type="text"
                    name="model"
                    placeholder="Masukkan model HP"
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

    </div>

</div>

</body>

</html>
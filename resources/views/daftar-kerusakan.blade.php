<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Select Damage - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="max-w-6xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">

        <a href="/select-category"
           class="inline-flex items-center gap-2 text-sm text-[#8892a4]
                  hover:text-[#22d3ee] transition">

            ← Back

        </a>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">
            Select Damage
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Step 4 of 4 — Choose the specific issue
        </p>

    </div>


    {{-- Progress --}}
    <div class="flex gap-2 mb-8">

        @foreach(['Brand', 'Model', 'Category', 'Damage'] as $step)

            <div class="flex-1 flex flex-col items-center gap-1">

                <div class="h-1 w-full rounded-full bg-[#22d3ee]">
                </div>

                <span class="text-xs text-[#22d3ee] font-medium">
                    {{ $step }}
                </span>

            </div>

        @endforeach

    </div>


    {{-- Summary --}}
    <div class="flex flex-wrap items-center gap-2 mb-6
                px-4 py-3 rounded-2xl
                bg-[#0f1729]
                border border-[#1a2744]
                text-sm">

        <span class="text-[#8892a4]">
            {{ $brand }} {{ $model }}
        </span>

        <span class="text-[#4a5568]">
            ·
        </span>

        <span class="px-2 py-1 rounded-lg
                     text-xs font-medium
                     bg-green-500/10
                     text-green-400">

            {{ $category }}

        </span>

    </div>


    {{-- Damage List --}}
    <div class="flex flex-col gap-4">

        @foreach($damages as $damage)

           <a href="/damage-detail/{{ $damage['id'] }}?category={{ urlencode($category) }}"
               class="p-5 rounded-2xl
                      bg-[#0f1729]
                      border border-[#1a2744]
                      group
                      hover:border-[#243356]
                      transition">

                <div class="flex items-start justify-between gap-4">

                    <div class="flex-1">

                        {{-- Title --}}
                        <div class="flex items-center justify-between
                                    gap-2 mb-2">

                            <h3 class="font-bold text-[#f0f4ff]">
                                {{ $damage['name'] }}
                            </h3>

                            <span class="text-[#4a5568]
                                         group-hover:text-[#22d3ee]
                                         group-hover:translate-x-0.5
                                         transition-all
                                         shrink-0
                                         text-lg">

                                →

                            </span>

                        </div>


                        {{-- Description --}}
                        <p class="text-sm text-[#8892a4]
                                  leading-relaxed mb-4">

                            {{ $damage['description'] }}

                        </p>


                        {{-- Price + Duration --}}
                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs text-[#8892a4] mb-0.5">
                                    Estimated Price
                                </p>

                                <p class="font-mono font-semibold
                                          text-[#22d3ee]">

                                    Rp{{ number_format($damage['price_min'], 0, ',', '.') }}

                                    –

                                    Rp{{ number_format($damage['price_max'], 0, ',', '.') }}

                                </p>

                            </div>


                            <div class="flex items-center gap-1.5
                                        text-xs text-[#4a5568]">

                                ⏱

                                @if($damage['days'] == 1)

                                    Same day

                                @else

                                    {{ $damage['days'] }} days

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </a>

        @endforeach

    </div>

</div>

</body>

</html>




<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damage Category - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="max-w-6xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="mb-8">

        <a href="/select-model"
           class="text-sm text-[#8892a4] hover:text-[#22d3ee]">
            ← Back
        </a>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">
            Damage Category
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Step 3 of 4 — Select the severity of damage
        </p>

    </div>


    <!-- Progress -->
    <div class="flex gap-2 mb-8">

        <div class="flex-1">
            <div class="h-1 w-full rounded-full bg-[#22d3ee]"></div>
            <p class="text-xs text-[#22d3ee] mt-1 text-center">
                Brand
            </p>
        </div>

        <div class="flex-1">
            <div class="h-1 w-full rounded-full bg-[#22d3ee]"></div>
            <p class="text-xs text-[#22d3ee] mt-1 text-center">
                Model
            </p>
        </div>

        <div class="flex-1">
            <div class="h-1 w-full rounded-full bg-[#22d3ee]"></div>
            <p class="text-xs text-[#22d3ee] mt-1 text-center">
                Category
            </p>
        </div>

        <div class="flex-1">
            <div class="h-1 w-full rounded-full bg-[#1a2744]"></div>
            <p class="text-xs text-[#4a5568] mt-1 text-center">
                Damage
            </p>
        </div>

    </div>


    <!-- Selected Device -->
    <div class="flex items-center gap-2 mb-6 px-4 py-3
                rounded-2xl bg-[#0f1729]
                border border-[#1a2744] text-sm">

        <span class="text-[#8892a4]">
            Device:
        </span>

        <span class="font-semibold text-[#f0f4ff]">
            {{ $brand }} {{ $model }}
        </span>

    </div>


    <!-- Categories -->
    <div class="flex flex-col gap-4">

        @foreach($damageCategories as $cat)

            <a href="/demage-list?category={{ urlencode($cat['name']) }}"
               class="block p-5 rounded-2xl
                      bg-[#0f1729]
                      border border-[#1a2744]
                      hover:border-[#243356]
                      transition group">

                <div class="flex items-start gap-4">

                    <!-- Icon -->
                    <div
                        class="w-14 h-14 rounded-2xl
                               flex items-center justify-center
                               text-2xl shrink-0
                               transition-transform
                               group-hover:scale-105"
                        style="background-color: {{ $cat['bgColor'] }}"
                    >
                        @if($cat['name'] === 'Light Damage')
                            🔧
                        @elseif($cat['name'] === 'Moderate Damage')
                            ⚙️
                        @else
                            🔩
                        @endif
                    </div>


                    <!-- Content -->
                    <div class="flex-1">

                        <div class="flex items-center justify-between gap-2">

                            <h3 class="font-bold text-[#f0f4ff] text-lg">
                                {{ $cat['name'] }}
                            </h3>

                            <span
                                class="text-[#4a5568]
                                       group-hover:translate-x-0.5
                                       transition-transform">
                                →
                            </span>

                        </div>


                        <p class="text-sm text-[#8892a4] mt-1 leading-relaxed">
                            {{ $cat['description'] }}
                        </p>


                        <!-- Repair Count -->
                        <div class="flex items-center gap-2 mt-3">

                            <span
                                class="text-xs font-semibold
                                       px-2.5 py-1 rounded-full"
                                style="
                                    background-color: {{ $cat['bgColor'] }};
                                    color: {{ $cat['color'] }};
                                "
                            >
                                {{ $damageCount[$cat['name']] }}
                                repair type{{ $damageCount[$cat['name']] > 1 ? 's' : '' }}
                            </span>

                        </div>

                    </div>

                </div>

            </a>

        @endforeach

    </div>

</div>

</body>
</html>
```

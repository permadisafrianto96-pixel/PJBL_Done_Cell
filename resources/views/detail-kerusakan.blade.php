<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Summary - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="max-w-6xl mx-auto px-6 py-8">

    {{-- Header --}}
    <div class="mb-8">

        <a
            href="/demage-list?category={{ urlencode($category) }}"
            class="text-sm text-[#8892a4] hover:text-[#22d3ee]"
        >
            ← Back
        </a>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">
            Repair Summary
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Review details before requesting a fixed price
        </p>

    </div>


    {{-- Damage Info --}}
    <div class="p-5 mb-4 rounded-2xl
                bg-[#0f1729]
                border border-[#1a2744]">

        <div class="flex items-start gap-4 mb-4">

            {{-- Damage Icon --}}
            <div class="w-12 h-12 rounded-2xl
                        flex items-center justify-center
                        text-xl shrink-0
                        bg-[#22d3ee]/10">

                @if($damage['id'] == 1 || $damage['id'] == 2)
                    🔧
                @elseif($damage['id'] == 3 || $damage['id'] == 4)
                    🔋
                @elseif($damage['id'] == 5)
                    📱
                @elseif($damage['id'] == 6)
                    ⚡
                @elseif($damage['id'] == 7)
                    🧩
                @else
                    🛠️
                @endif

            </div>


            <div>

                {{-- Category --}}
                <div class="mb-2">

                    <span class="px-2 py-1 rounded-lg
                                 text-xs font-medium
                                 bg-green-500/10
                                 text-green-400">

                        {{ $category }}

                    </span>

                </div>


                {{-- Damage Name --}}
                <h2 class="text-xl font-bold text-[#f0f4ff]">

                    {{ $damage['name'] }}

                </h2>

            </div>

        </div>


        {{-- Description --}}
        <p class="text-sm text-[#8892a4] leading-relaxed">

            {{ $damage['description'] }}

        </p>

    </div>



    {{-- Repair Details --}}
    <div class="p-5 mb-4 rounded-2xl
                bg-[#0f1729]
                border border-[#1a2744]">

        <h3 class="text-sm font-semibold text-[#f0f4ff] mb-4">

            Repair Details

        </h3>


        <div class="flex flex-col divide-y divide-[#1a2744]">

            {{-- Brand --}}
            <div class="flex justify-between items-center py-3">

                <div class="flex items-center gap-2
                            text-sm text-[#8892a4]">

                    📱
                    Brand

                </div>

                <span class="text-sm font-semibold text-[#f0f4ff]">

                    {{ $brand }}

                </span>

            </div>


            {{-- Model --}}
            <div class="flex justify-between items-center py-3">

                <div class="flex items-center gap-2
                            text-sm text-[#8892a4]">

                    📱
                    Phone Model

                </div>

                <span class="text-sm font-semibold text-[#f0f4ff]">

                    {{ $model }}

                </span>

            </div>


            {{-- Damage --}}
            <div class="flex justify-between items-center py-3">

                <div class="flex items-center gap-2
                            text-sm text-[#8892a4]">

                    🔧
                    Damage Type

                </div>

                <span class="text-sm font-semibold text-[#f0f4ff]">

                    {{ $damage['name'] }}

                </span>

            </div>


            {{-- Duration --}}
            <div class="flex justify-between items-center py-3">

                <div class="flex items-center gap-2
                            text-sm text-[#8892a4]">

                    ⏱
                    Est. Duration

                </div>

                <span class="text-sm font-semibold text-[#f0f4ff]">

                    {{ $damage['days'] == 1
                        ? 'Same day'
                        : $damage['days'] . ' days'
                    }}

                </span>

            </div>

        </div>

    </div>



    {{-- Estimated Price --}}
    <div
        class="rounded-2xl p-5 mb-5"
        style="
            background: linear-gradient(
                135deg,
                rgba(34,211,238,0.08) 0%,
                rgba(34,211,238,0.04) 100%
            );

            border: 1px solid rgba(34,211,238,0.2);
        "
    >

        <p class="text-xs font-semibold
                  text-[#22d3ee]
                  uppercase tracking-wider mb-2">

            Estimated Price Range

        </p>


        <p class="text-3xl font-bold
                  text-[#22d3ee]
                  font-mono">

            Rp{{ number_format($damage['price_min'], 0, ',', '.') }}

            <span class="text-xl text-[#0891b2] mx-2">

                –

            </span>

            Rp{{ number_format($damage['price_max'], 0, ',', '.') }}

        </p>


        <div class="flex items-start gap-2 mt-3">

            <span class="text-[#8892a4] shrink-0">

                ⚠

            </span>

            <p class="text-xs text-[#8892a4] leading-relaxed">

                This is an estimate. Our technician will inspect your
                device and provide a definitive fixed price, which may
                differ from the estimate.

            </p>

        </div>

    </div>



    {{-- Description --}}
    <form action="/repair-request" method="POST">

        @csrf

        <div class="mb-6">

            <label class="block text-sm font-medium
                          text-[#f0f4ff] mb-2">

                Describe the issue (optional)

            </label>


            <textarea
                name="description"
                rows="4"
                placeholder="E.g. Screen cracked after dropping phone. Touch still partially works on the top half."
                class="w-full px-4 py-3 rounded-xl
                       bg-[#0f1729]
                       border border-[#1a2744]
                       text-white
                       placeholder-[#4a5568]
                       focus:outline-none
                       focus:border-[#22d3ee]
                       resize-none"
            ></textarea>

        </div>


        {{-- Submit --}}
        <button
            type="submit"
            class="w-full flex items-center justify-center
                   gap-2 px-6 py-3 rounded-xl
                   bg-[#22d3ee]
                   text-[#080e1a]
                   font-semibold
                   hover:bg-[#67e8f9]
                   transition"
        >

            🔧
            Request Fixed Price

        </button>

    </form>


    <p class="text-xs text-[#4a5568]
              text-center mt-4">

        By submitting, you agree to our service terms.
        No payment is collected until you accept the fixed price.

    </p>

</div>

</body>
</html>
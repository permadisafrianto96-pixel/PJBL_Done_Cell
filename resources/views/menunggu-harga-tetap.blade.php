<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Waiting for Technician - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #080e1a;
            color: #f0f4ff;
        }
    </style>
</head>

<body>

<div class="pb-24 md:pb-8 flex flex-col items-center min-h-screen">

    <div class="w-full max-w-lg mx-auto px-5 pt-8">

        {{-- STATUS ICON --}}
        <div class="flex flex-col items-center text-center mb-8">

            <div class="relative mb-6">

                <div class="w-20 h-20 rounded-3xl
                            bg-[rgba(245,158,11,0.1)]
                            border border-[rgba(245,158,11,0.2)]
                            flex items-center justify-center">

                    <span class="text-4xl text-[#f59e0b]">◷</span>

                </div>

                <div class="absolute -top-1 -right-1
                            w-6 h-6
                            bg-[#f59e0b]
                            rounded-full
                            flex items-center justify-center">

                    <span class="text-xs font-bold text-[#080e1a]">
                        !
                    </span>

                </div>

            </div>


            {{-- BADGE --}}
            <span class="inline-flex items-center gap-2
                         px-3 py-1.5
                         rounded-full
                         bg-[rgba(245,158,11,0.1)]
                         border border-[rgba(245,158,11,0.2)]
                         text-[#f59e0b]
                         text-sm font-medium">

                <span class="w-2 h-2 rounded-full bg-[#f59e0b]"></span>

                Waiting for Technician

            </span>


            <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4 mb-2">
                Repair Request Submitted
            </h1>

            <p class="text-[#8892a4] leading-relaxed max-w-sm">
                Your request has been received. Our technician will inspect
                the issue and set a fixed price. You will be notified when
                it's ready.
            </p>

        </div>


        {{-- REQUEST SUMMARY --}}
        @php
            $request = session('activeRequest');
        @endphp

        @if ($request || session('brand'))

            <div class="p-5 mb-5
                        bg-[#0f1729]
                        border border-[#1a2744]
                        rounded-2xl">

                <h3 class="text-sm font-semibold text-[#f0f4ff]
                           mb-4 flex items-center gap-2">

                    <span class="text-[#22d3ee] text-lg">🔧</span>

                    Request Summary

                </h3>


                <div class="flex flex-col divide-y divide-[#1a2744]">


                    {{-- REQUEST ID --}}
                    <div class="flex justify-between items-start gap-4 py-3">

                        <span class="text-sm text-[#8892a4] shrink-0">
                            Request ID
                        </span>

                        <span class="text-sm text-right font-mono text-[#22d3ee]">
                            {{ $request['id'] ?? 'Processing...' }}
                        </span>

                    </div>


                    {{-- BRAND --}}
                    <div class="flex justify-between items-start gap-4 py-3">

                        <span class="text-sm text-[#8892a4] shrink-0">
                            Brand
                        </span>

                        <span class="text-sm text-right text-[#f0f4ff] font-medium">
                            {{ $request['brand'] ?? session('brand', '') }}
                        </span>

                    </div>


                    {{-- MODEL --}}
                    <div class="flex justify-between items-start gap-4 py-3">

                        <span class="text-sm text-[#8892a4] shrink-0">
                            Model
                        </span>

                        <span class="text-sm text-right text-[#f0f4ff] font-medium">
                            {{ $request['model'] ?? session('model', '') }}
                        </span>

                    </div>


                    {{-- CATEGORY --}}
                    <div class="flex justify-between items-start gap-4 py-3">

                        <span class="text-sm text-[#8892a4] shrink-0">
                            Category
                        </span>

                        <span class="text-sm text-right text-[#f0f4ff] font-medium">
                            {{ $request['category'] ?? session('category', '') }}
                        </span>

                    </div>


                    {{-- DAMAGE --}}
                    <div class="flex justify-between items-start gap-4 py-3">

                        <span class="text-sm text-[#8892a4] shrink-0">
                            Damage
                        </span>

                        <span class="text-sm text-right text-[#f0f4ff] font-medium">
                            {{ $request['damageName'] ?? session('damageName', '') }}
                        </span>

                    </div>


                    {{-- ESTIMATED PRICE --}}
                    <div class="flex justify-between items-start gap-4 py-3">

                        <span class="text-sm text-[#8892a4] shrink-0">
                            Estimated Price
                        </span>

                        <span class="text-sm text-right font-mono text-[#22d3ee]">

                            Rp{{ number_format(
                                $request['estimatedPriceMin']
                                ?? session('estimatedPriceMin', 0),
                                0,
                                ',',
                                '.'
                            ) }}

                            –

                            Rp{{ number_format(
                                $request['estimatedPriceMax']
                                ?? session('estimatedPriceMax', 0),
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>

                </div>

            </div>

        @endif


        {{-- NOTIFICATION HINT --}}
        <div class="flex items-start gap-3
                    px-4 py-4
                    rounded-2xl
                    bg-[rgba(34,211,238,0.06)]
                    border border-[rgba(34,211,238,0.15)]
                    mb-6">

            <span class="text-[#22d3ee] text-lg shrink-0">
                🔔
            </span>

            <p class="text-sm text-[#8892a4]">

                We'll send you a notification as soon as the fixed price
                is ready. Average response time:

                <span class="text-[#f0f4ff] font-medium">
                    1–2 hours
                </span>.

            </p>

        </div>


        {{-- BUTTONS --}}
        <div class="flex flex-col gap-3">


            {{-- CHECK NOTIFICATIONS --}}
            <a href="/notifications"
               class="w-full flex items-center justify-center gap-2
                      px-5 py-3
                      rounded-xl
                      border border-[#243356]
                      text-[#f0f4ff]
                      font-medium
                      hover:bg-[#0f1729]
                      transition">

                <span>🔔</span>

                Check Notifications

            </a>


            {{-- BACK HOME --}}
            <a href="/customer/home"
               class="w-full flex items-center justify-center
                      px-5 py-3
                      rounded-xl
                      text-[#8892a4]
                      font-medium
                      hover:text-[#f0f4ff]
                      transition">

                Back to Home

            </a>

        </div>

    </div>

</div>

</body>
</html>
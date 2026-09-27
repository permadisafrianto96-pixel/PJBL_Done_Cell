<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Notifications - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="max-w-2xl mx-auto px-5 py-8">

    {{-- HEADER --}}

    <div class="mb-8">

        <a
            href="/waiting-fixed-price"
            class="text-sm text-[#8892a4] hover:text-[#22d3ee] transition"
        >
            ← Back
        </a>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">
            Notifications
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Updates about your repair request
        </p>

    </div>



    {{-- NOTIFICATION --}}

    @if($request)

        @php
            $status = $request->status;

            $isFixedPrice = $status === 'waiting_payment';
        @endphp

        <div
            class="p-5 rounded-2xl
                   bg-[#0f1729]
                   border border-[#1a2744]
                   mb-4"
        >

            <div class="flex items-start gap-4">

                {{-- ICON --}}

                <div
                    class="w-12 h-12 rounded-2xl
                           {{ $isFixedPrice
                               ? 'bg-[rgba(16,185,129,0.1)] border border-[rgba(16,185,129,0.2)]'
                               : 'bg-[rgba(245,158,11,0.1)] border border-[rgba(245,158,11,0.2)]' }}
                           flex items-center justify-center
                           text-xl shrink-0"
                >

                    {{ $isFixedPrice ? '✓' : '◷' }}

                </div>



                {{-- CONTENT --}}

                <div class="flex-1">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <h2 class="font-semibold text-[#f0f4ff]">

                                @if($isFixedPrice)

                                    Fixed price set

                                @else

                                    Repair request received

                                @endif

                            </h2>

                            <p class="text-xs text-[#8892a4] mt-1">

                                Request {{ $request->request_id }}

                            </p>

                        </div>



                        <span
                            class="px-2 py-1 rounded-lg
                                   text-xs font-medium
                                   shrink-0
                                   {{ $isFixedPrice
                                       ? 'bg-green-500/10 text-green-400'
                                       : 'bg-yellow-500/10 text-yellow-400' }}"
                        >

                            @if($isFixedPrice)

                                Ready

                            @else

                                Waiting

                            @endif

                        </span>

                    </div>



                    {{-- MESSAGE --}}

                    <p
                        class="text-sm text-[#8892a4]
                               leading-relaxed mt-4"
                    >

                        @if($isFixedPrice)

                            The technician has reviewed your device and
                            determined the fixed repair price.
                            Please review the price and choose a payment method.

                        @else

                            Your repair request has been submitted successfully.
                            Our technician will inspect your device and determine
                            the fixed repair price.

                        @endif

                    </p>



                    {{-- DEVICE INFO --}}

                    <div
                        class="mt-4 pt-4
                               border-t border-[#1a2744]"
                    >

                        {{-- DEVICE --}}

                        <div class="flex justify-between py-2">

                            <span class="text-xs text-[#8892a4]">
                                Device
                            </span>

                            <span
                                class="text-xs text-[#f0f4ff]
                                       font-medium"
                            >

                                {{ $request->brand }}
                                {{ $request->model }}

                            </span>

                        </div>



                        {{-- DAMAGE --}}

                        <div class="flex justify-between py-2">

                            <span class="text-xs text-[#8892a4]">
                                Damage
                            </span>

                            <span
                                class="text-xs text-[#f0f4ff]
                                       font-medium"
                            >

                                {{ $request->damage_name }}

                            </span>

                        </div>



                        {{-- ESTIMATED PRICE --}}

                        <div class="flex justify-between py-2">

                            <span class="text-xs text-[#8892a4]">
                                Estimated Price
                            </span>

                            <span
                                class="text-xs text-[#22d3ee]
                                       font-mono"
                            >

                                Rp{{ number_format(
                                    $request->estimated_price_min,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                                –

                                Rp{{ number_format(
                                    $request->estimated_price_max,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </span>

                        </div>



                        {{-- FIXED PRICE --}}

                        @if($isFixedPrice)

                            <div class="flex justify-between py-2">

                                <span class="text-xs text-[#8892a4]">
                                    Fixed Price
                                </span>

                                <span
                                    class="text-xs text-green-400
                                           font-mono font-semibold"
                                >

                                    Rp{{ number_format(
                                        $request->fixed_price,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </div>

                        @endif

                    </div>



                    {{-- ACTION --}}

                    @if($isFixedPrice)

                        <a
                            href="/fixed-price"
                            class="w-full flex items-center justify-center
                                   gap-2
                                   px-4 py-3
                                   mt-5
                                   rounded-xl
                                   bg-[#22d3ee]
                                   hover:bg-[#06b6d4]
                                   text-[#080e1a]
                                   font-bold
                                   transition"
                        >

                            View Fixed Price

                            <span>→</span>

                        </a>

                    @endif

                </div>

            </div>

        </div>

    @else

        {{-- EMPTY STATE --}}

        <div
            class="p-8 rounded-2xl
                   bg-[#0f1729]
                   border border-[#1a2744]
                   text-center"
        >

            <div class="text-4xl mb-4">
                🔔
            </div>

            <h2 class="font-semibold text-[#f0f4ff]">
                No notifications
            </h2>

            <p class="text-sm text-[#8892a4] mt-2">
                You don't have any repair updates yet.
            </p>

        </div>

    @endif



    {{-- BACK HOME --}}

    <a
        href="/customer/home"
        class="w-full flex items-center justify-center
               px-5 py-3 mt-6
               rounded-xl
               bg-[#22d3ee]
               text-[#080e1a]
               font-semibold
               hover:bg-[#67e8f9]
               transition"
    >

        Back to Home

    </a>

</div>

</body>

</html>
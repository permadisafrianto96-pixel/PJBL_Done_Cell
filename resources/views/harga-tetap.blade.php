<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Fixed Price - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="max-w-lg mx-auto px-6 py-8">

    <!-- Header -->

    <div class="flex flex-col items-center text-center mb-8">

        <div class="w-20 h-20 rounded-3xl
                    bg-[rgba(16,185,129,0.1)]
                    border border-[rgba(16,185,129,0.2)]
                    flex items-center justify-center mb-5">

            <span class="text-4xl text-[#10b981]">
                ✓
            </span>

        </div>

        <span class="px-3 py-1 rounded-full
                     bg-[rgba(16,185,129,0.1)]
                     border border-[rgba(16,185,129,0.2)]
                     text-[#10b981] text-sm font-semibold">

            ● Fixed Price Set

        </span>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4 mb-2">

            Technician has reviewed your device

        </h1>

        <p class="text-[#8892a4] max-w-sm">

            The fixed repair price has been determined.
            Please review and choose a payment method.

        </p>

    </div>



    <!-- Price Breakdown -->

    <div class="rounded-2xl p-5 mb-5
                bg-[#0f1729]
                border border-[#1a2744]">

        <h3 class="text-sm font-semibold text-[#f0f4ff] mb-5">

            Price Breakdown

        </h3>

        <div class="flex items-center justify-between gap-4
                    py-3 border-b border-[#1a2744]">

            <div>

                <p class="text-xs text-[#8892a4] mb-1">

                    Estimated Range

                </p>

                <p class="text-sm font-mono text-[#8892a4]">

                    Rp{{ number_format($request->estimated_price_min, 0, ',', '.') }}

                    –

                    Rp{{ number_format($request->estimated_price_max, 0, ',', '.') }}

                </p>

            </div>

            <span class="px-2 py-1 rounded-lg
                         bg-[#1a2744]
                         text-[#8892a4]
                         text-xs">

                Estimate

            </span>

        </div>



        <div class="py-5">

            <p class="text-xs text-[#8892a4] mb-1">

                Fixed Repair Price

            </p>

            <p class="text-4xl font-bold font-mono text-[#f0f4ff]">

                Rp{{ number_format($request->fixed_price, 0, ',', '.') }}

            </p>

            @if($request->fixed_price > $request->estimated_price_max)

                <p class="text-xs text-[#f97316] mt-2">

                    +Rp{{ number_format($request->fixed_price - $request->estimated_price_max, 0, ',', '.') }}

                    above estimate

                </p>

            @elseif($request->fixed_price < $request->estimated_price_min)

                <p class="text-xs text-[#10b981] mt-2">

                    Below estimate — good news!

                </p>

            @else

                <span class="inline-block mt-2 px-2 py-1 rounded-lg
                             bg-[#1a2744]
                             text-[#8892a4]
                             text-xs">

                    Within estimate

                </span>

            @endif

        </div>

    </div>



    <!-- Repair Details -->

    <div class="rounded-2xl p-5 mb-6
                bg-[#0f1729]
                border border-[#1a2744]">

        <h3 class="text-sm font-semibold text-[#f0f4ff] mb-3">

            Repair Details

        </h3>

        <div class="divide-y divide-[#1a2744]">

            <div class="flex justify-between items-center py-2.5">

                <span class="text-sm text-[#8892a4]">

                    Device

                </span>

                <span class="text-sm text-[#f0f4ff] font-medium">

                    {{ $request->brand }} {{ $request->model }}

                </span>

            </div>

            <div class="flex justify-between items-center py-2.5">

                <span class="text-sm text-[#8892a4]">

                    Repair

                </span>

                <span class="text-sm text-[#f0f4ff] font-medium">

                    {{ $request->damage_name }}

                </span>

            </div>

            <div class="flex justify-between items-center py-2.5">

                <span class="text-sm text-[#8892a4]">

                    Category

                </span>

                <span class="text-sm text-[#f0f4ff] font-medium">

                    {{ $request->category }}

                </span>

            </div>

            <div class="flex justify-between items-center py-2.5">

                <span class="text-sm text-[#8892a4]">

                    Request ID

                </span>

                <span class="text-sm font-mono text-[#22d3ee]">

                    #{{ $request->request_id }}

                </span>

            </div>

        </div>

    </div>



    <!-- Continue -->

    <a href="/payment-method"

       class="w-full flex items-center justify-center gap-2
              px-5 py-4 rounded-xl
              bg-[#22d3ee]
              hover:bg-[#06b6d4]
              text-[#080e1a]
              font-bold
              transition">

        🔧 Choose Payment Method

        <span>→</span>

    </a>

</div>

</body>

</html>

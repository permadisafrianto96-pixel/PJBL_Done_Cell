<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Set Fixed Price - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="max-w-3xl mx-auto px-6 py-8">

    <!-- Back -->
    <a href="/admin/requests"
       class="inline-flex items-center gap-2 text-[#8892a4] hover:text-[#f0f4ff] transition mb-6">
        ← Back to Requests
    </a>

    <!-- Header -->
    <div class="mb-8">
        <p class="text-sm font-semibold text-[#f97316] mb-2">
            FIXED PRICE REQUEST
        </p>

        <h1 class="text-3xl font-bold text-[#f0f4ff]">
            Set Fixed Price
        </h1>

        <p class="text-[#8892a4] mt-2">
            Review the request and determine the final repair price.
        </p>
    </div>

    <!-- Request Info -->
    <div class="rounded-2xl p-6 mb-5
                bg-[#0f1729]
                border border-[#1a2744]">

        <h2 class="text-sm font-semibold text-[#f0f4ff] mb-5">
            Request Information
        </h2>

        <div class="grid md:grid-cols-2 gap-5">

            <div>
                <p class="text-xs text-[#8892a4] mb-1">
                    Request ID
                </p>

                <p class="text-sm font-mono text-[#22d3ee]">
                    #{{ $repairRequest->request_id }}
                </p>
            </div>

            <div>
                <p class="text-xs text-[#8892a4] mb-1">
                    Customer
                </p>

                <p class="text-sm font-medium text-[#f0f4ff]">
                    {{ $repairRequest->customer_name }}
                </p>
            </div>

            <div>
                <p class="text-xs text-[#8892a4] mb-1">
                    Device
                </p>

                <p class="text-sm font-medium text-[#f0f4ff]">
                    {{ $repairRequest->brand }}
                    {{ $repairRequest->model }}
                </p>
            </div>

            <div>
                <p class="text-xs text-[#8892a4] mb-1">
                    Category
                </p>

                <p class="text-sm font-medium text-[#f0f4ff]">
                    {{ $repairRequest->category }}
                </p>
            </div>

            <div class="md:col-span-2">
                <p class="text-xs text-[#8892a4] mb-1">
                    Damage
                </p>

                <p class="text-sm font-medium text-[#f0f4ff]">
                    {{ $repairRequest->damage_name }}
                </p>
            </div>

        </div>
    </div>

    <!-- Estimated Price -->
    <div class="rounded-2xl p-6 mb-5
                bg-[#0f1729]
                border border-[#1a2744]">

        <h2 class="text-sm font-semibold text-[#f0f4ff] mb-5">
            Estimated Price
        </h2>

        <div class="flex items-center justify-between">

            <div>
                <p class="text-xs text-[#8892a4] mb-1">
                    Customer's Estimated Range
                </p>

                <p class="text-xl font-bold font-mono text-[#f0f4ff]">
                    Rp{{ number_format($repairRequest->estimated_price_min, 0, ',', '.') }}
                    -
                    Rp{{ number_format($repairRequest->estimated_price_max, 0, ',', '.') }}
                </p>
            </div>

            <span class="px-3 py-1 rounded-lg
                         bg-[#1a2744]
                         text-[#8892a4]
                         text-xs">
                Estimate
            </span>

        </div>
    </div>

    <!-- Set Price -->
    <div class="rounded-2xl p-6
                bg-[#0f1729]
                border border-[#1a2744]">

        <h2 class="text-sm font-semibold text-[#f0f4ff] mb-2">
            Final Repair Price
        </h2>

        <p class="text-xs text-[#8892a4] mb-5">
            Enter the final price that the customer needs to pay.
        </p>

        <form action="/admin/requests/{{ $repairRequest->id }}/price"
              method="POST">

            @csrf

            <label class="block text-xs text-[#8892a4] mb-2">
                Fixed Price
            </label>

            <div class="flex items-center
                        bg-[#080e1a]
                        border border-[#1a2744]
                        rounded-xl
                        overflow-hidden
                        focus-within:border-[#f97316]">

                <span class="px-4 text-[#8892a4]">
                    Rp
                </span>

                <input
                    type="number"
                    name="fixed_price"
                    value="{{ old('fixed_price', $repairRequest->fixed_price) }}"
                    min="0"
                    required
                    placeholder="350000"
                    class="w-full bg-transparent px-3 py-4
                           text-[#f0f4ff]
                           outline-none"
                >

            </div>

            @error('fixed_price')
                <p class="text-sm text-red-400 mt-2">
                    {{ $message }}
                </p>
            @enderror

            <button
                type="submit"
                class="w-full mt-6
                       bg-[#22d3ee]
                       hover:bg-[#06b6d4]
                       text-[#080e1a]  
                       text-white
                       font-bold
                       py-3.5
                       rounded-xl
                       transition"
            >
                Set Fixed Price
            </button>

        </form>

    </div>

</div>

</body>
</html>
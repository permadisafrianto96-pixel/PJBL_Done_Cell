<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Repair History</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#07111f] text-[#f0f4ff]">

<div class="pb-24 md:pb-8">

    <div class="max-w-lg mx-auto px-4 pt-4 md:pt-8">

        {{-- Header --}}
        <div class="mb-8">

            <h1 class="text-2xl font-bold text-[#f0f4ff]">
                Repair History
            </h1>

            <p class="text-sm text-[#8892a4] mt-0.5">
                1 total repair
            </p>

        </div>


        @php
            $request = session('activeRequest');
        @endphp


        {{-- Empty State --}}
        @if (!$request)

            <div class="text-center py-16">

                <div class="w-14 h-14 mx-auto mb-4 rounded-2xl bg-[#111b2e] border border-[#1a2744] flex items-center justify-center text-[#8892a4]">
                    🔧
                </div>

                <h2 class="font-semibold text-[#f0f4ff]">
                    No repairs yet
                </h2>

                <p class="text-sm text-[#8892a4] mt-1">
                    Submit your first repair request to get started.
                </p>

            </div>

        @else

            {{-- Repair Card --}}
            <div class="bg-[#111b2e] border border-[#1a2744] rounded-2xl p-5">

                {{-- Device + Status --}}
                <div class="flex items-start justify-between gap-3 mb-4">

                    <div>

                        <p class="font-bold text-[#f0f4ff]">
                            {{ $request['brand'] ?? '-' }}
                            {{ $request['model'] ?? '-' }}
                        </p>

                        <p class="text-sm text-[#8892a4] mt-0.5">
                            {{ $request['damageName'] ?? $request['damage'] ?? '-' }}
                        </p>

                    </div>


                    @php
                        $status = $request['status'] ?? 'unknown';

                        $statusLabels = [
                            'waiting_fixed_price' => 'Waiting Fixed Price',
                            'waiting_payment' => 'Waiting Payment',
                            'waiting_verification' => 'Waiting Verification',
                            'payment_rejected' => 'Payment Rejected',
                            'waiting_site_payment' => 'Waiting Site Payment',
                        ];

                        $statusLabel = $statusLabels[$status] ?? ucwords(str_replace('_', ' ', $status));
                    @endphp

                    <span class="px-3 py-1 rounded-full bg-[rgba(34,211,238,0.1)] text-[#22d3ee] text-xs font-semibold whitespace-nowrap">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#22d3ee] mr-1"></span>
                        {{ $statusLabel }}
                    </span>

                </div>


                {{-- Information Grid --}}
                <div class="grid grid-cols-2 gap-x-4 gap-y-4 mb-4 text-sm">

                    {{-- Estimated --}}
                    <div>

                        <p class="text-xs text-[#4a5568] mb-0.5">
                            Estimated
                        </p>

                        <p class="font-mono text-[#8892a4] text-xs">
                            Rp {{ number_format($request['estimatedPriceMin'] ?? 0, 0, ',', '.') }}
                            –
                            Rp {{ number_format($request['estimatedPriceMax'] ?? 0, 0, ',', '.') }}
                        </p>

                    </div>


                    {{-- Fixed Price --}}
                    @if(isset($request['fixedPrice']) && $request['fixedPrice'] !== null)

                        <div>

                            <p class="text-xs text-[#4a5568] mb-0.5">
                                Fixed Price
                            </p>

                            <p class="font-mono font-bold text-[#22d3ee] text-sm">
                                Rp {{ number_format($request['fixedPrice'], 0, ',', '.') }}
                            </p>

                        </div>

                    @endif


                    {{-- Payment --}}
                    @if(isset($request['paymentMethod']) && $request['paymentMethod'])

                        <div>

                            <p class="text-xs text-[#4a5568] mb-0.5">
                                Payment
                            </p>

                            <p class="text-xs text-[#f0f4ff] font-medium capitalize">
                                {{ str_replace('_', ' ', $request['paymentMethod']) }}
                            </p>

                        </div>

                    @endif


                    {{-- Date --}}
                    <div>

                        <p class="text-xs text-[#4a5568] mb-0.5">
                            Date
                        </p>

                        <p class="text-xs text-[#f0f4ff]">

                            {{ isset($request['createdAt'])
                                ? \Carbon\Carbon::parse($request['createdAt'])->format('d M Y')
                                : now()->format('d M Y')
                            }}

                        </p>

                    </div>

                </div>


                {{-- Pickup Date --}}
                @if(isset($request['pickupDate']) && $request['pickupDate'])

                    <div class="px-3 py-2 rounded-xl bg-[rgba(16,185,129,0.08)] border border-[rgba(16,185,129,0.2)] mb-4">

                        <p class="text-xs text-[#10b981]">

                            Pickup:
                            {{ \Carbon\Carbon::parse($request['pickupDate'])->format('d F Y') }}

                        </p>

                    </div>

                @endif


                {{-- Bottom Actions --}}
                <div class="flex items-center gap-2 pt-3 border-t border-[#1a2744]">

                    {{-- Details --}}
                    <button
                        type="button"
                        onclick="openDetails()"
                        class="px-3 py-2 rounded-lg text-sm text-[#8892a4] hover:text-[#f0f4ff] hover:bg-[#18243a] transition"
                    >
                        👁 Details
                    </button>


                    {{-- Action --}}
                    @if($status === 'waiting_fixed_price')

                        <a
                            href="/waiting-fixed-price"
                            class="px-3 py-2 rounded-lg bg-[#22d3ee] text-[#07111f] text-sm font-bold"
                        >
                            View Status →
                        </a>

                    @elseif($status === 'waiting_payment')

                        <a
                            href="/payment-method"
                            class="px-3 py-2 rounded-lg bg-[#22d3ee] text-[#07111f] text-sm font-bold"
                        >
                            Choose Payment →
                        </a>

                    @elseif($status === 'waiting_verification')

                        <a
                            href="/bank-transfer"
                            class="px-3 py-2 rounded-lg bg-[#22d3ee] text-[#07111f] text-sm font-bold"
                        >
                            View Payment →
                        </a>

                    @elseif($status === 'payment_rejected')

                        <a
                            href="/bank-transfer"
                            class="px-3 py-2 rounded-lg bg-[#22d3ee] text-[#07111f] text-sm font-bold"
                        >
                            Upload New Proof →
                        </a>

                    @elseif($status === 'waiting_site_payment')

                        <a
                            href="/pay-on-site"
                            class="px-3 py-2 rounded-lg bg-[#22d3ee] text-[#07111f] text-sm font-bold"
                        >
                            Pay Now →
                        </a>

                    @endif


                    {{-- Request ID --}}
                    <span class="ml-auto text-xs text-[#4a5568] font-mono">
                        #{{ $request['requestId'] ?? '000' }}
                    </span>

                </div>

            </div>

        @endif

    </div>

</div>


{{-- Detail Modal --}}
<div
    id="detailModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 px-4"
>

    <div class="w-full max-w-md bg-[#111b2e] border border-[#1a2744] rounded-2xl p-5 max-h-[90vh] overflow-y-auto">

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-lg font-bold">
                Repair Details
            </h2>

            <button
                type="button"
                onclick="closeDetails()"
                class="text-[#8892a4] hover:text-[#f0f4ff] text-xl"
            >
                ×
            </button>

        </div>


        @if($request)

            <div class="space-y-0">

                {{-- Request ID --}}
                <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                    <span class="text-sm text-[#8892a4]">
                        Request ID
                    </span>

                    <span class="text-sm font-mono">
                        #{{ $request['requestId'] ?? '-' }}
                    </span>

                </div>


                {{-- Date --}}
                <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                    <span class="text-sm text-[#8892a4]">
                        Date
                    </span>

                    <span class="text-sm">
                        {{ isset($request['createdAt'])
                            ? \Carbon\Carbon::parse($request['createdAt'])->format('d F Y')
                            : now()->format('d F Y')
                        }}
                    </span>

                </div>


                {{-- Brand --}}
                <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                    <span class="text-sm text-[#8892a4]">
                        Brand
                    </span>

                    <span class="text-sm">
                        {{ $request['brand'] ?? '-' }}
                    </span>

                </div>


                {{-- Model --}}
                <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                    <span class="text-sm text-[#8892a4]">
                        Model
                    </span>

                    <span class="text-sm">
                        {{ $request['model'] ?? '-' }}
                    </span>

                </div>


                {{-- Category --}}
                <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                    <span class="text-sm text-[#8892a4]">
                        Category
                    </span>

                    <span class="text-sm">
                        {{ $request['category'] ?? '-' }}
                    </span>

                </div>


                {{-- Damage --}}
                <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                    <span class="text-sm text-[#8892a4]">
                        Damage
                    </span>

                    <span class="text-sm text-right">
                        {{ $request['damageName'] ?? $request['damage'] ?? '-' }}
                    </span>

                </div>


                {{-- Estimated Price --}}
                <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                    <span class="text-sm text-[#8892a4]">
                        Estimated Price
                    </span>

                    <span class="text-sm font-mono text-right">
                        Rp {{ number_format($request['estimatedPriceMin'] ?? 0, 0, ',', '.') }}
                        –
                        Rp {{ number_format($request['estimatedPriceMax'] ?? 0, 0, ',', '.') }}
                    </span>

                </div>


                {{-- Fixed Price --}}
                @if(isset($request['fixedPrice']) && $request['fixedPrice'] !== null)

                    <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                        <span class="text-sm text-[#8892a4]">
                            Fixed Price
                        </span>

                        <span class="text-sm font-mono font-bold text-[#22d3ee]">
                            Rp {{ number_format($request['fixedPrice'], 0, ',', '.') }}
                        </span>

                    </div>

                @endif


                {{-- Payment Method --}}
                @if(isset($request['paymentMethod']) && $request['paymentMethod'])

                    <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                        <span class="text-sm text-[#8892a4]">
                            Payment Method
                        </span>

                        <span class="text-sm capitalize">
                            {{ str_replace('_', ' ', $request['paymentMethod']) }}
                        </span>

                    </div>

                @endif


                {{-- Status --}}
                <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                    <span class="text-sm text-[#8892a4]">
                        Status
                    </span>

                    <span class="px-2.5 py-1 rounded-full bg-[rgba(34,211,238,0.1)] text-[#22d3ee] text-xs font-semibold">
                        {{ $statusLabel }}
                    </span>

                </div>


                {{-- Pickup Date --}}
                @if(isset($request['pickupDate']) && $request['pickupDate'])

                    <div class="flex justify-between gap-4 py-3 border-b border-[#1a2744]">

                        <span class="text-sm text-[#8892a4]">
                            Pickup Date
                        </span>

                        <span class="text-sm">
                            {{ \Carbon\Carbon::parse($request['pickupDate'])->format('d F Y') }}
                        </span>

                    </div>

                @endif


                {{-- Description --}}
                @if(isset($request['description']) && $request['description'])

                    <div class="pt-4">

                        <p class="text-xs text-[#8892a4] mb-1">
                            Description
                        </p>

                        <p class="text-sm text-[#f0f4ff] leading-relaxed">
                            {{ $request['description'] }}
                        </p>

                    </div>

                @endif

            </div>

        @endif

    </div>

</div>


<script>

function openDetails() {

    const modal = document.getElementById('detailModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

}

function closeDetails() {

    const modal = document.getElementById('detailModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');

}

document.getElementById('detailModal').addEventListener('click', function(event) {

    if (event.target === this) {
        closeDetails();
    }

});

</script>

</body>
</html>
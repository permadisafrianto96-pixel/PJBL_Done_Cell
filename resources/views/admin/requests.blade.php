<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Repair Requests - Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

@php

    $filter = request('filter', 'all');

    if ($filter === 'all') {

        $filteredRequests = $repairRequests->whereIn('status', [
            'waiting_fixed_price',
            'waiting_payment',
            'waiting_verification',
            'waiting_site_payment',
            'payment_rejected'
        ]);

    } else {

        $filteredRequests = $repairRequests->where('status', $filter);

    }

    $filteredRequests = $filteredRequests->sortByDesc('created_at');

    // Status
    $statusLabels = [
        'waiting_fixed_price' => 'Waiting Fixed Price',
        'waiting_payment' => 'Waiting Payment',
        'waiting_verification' => 'Waiting Verification',
        'waiting_site_payment' => 'Waiting Site Payment',
        'payment_rejected' => 'Payment Rejected',
        'payment_successful' => 'Payment Successful',
    ];

    $statusClasses = [
        'waiting_fixed_price' => 'bg-yellow-500/10 text-yellow-400',
        'waiting_payment' => 'bg-orange-500/10 text-orange-400',
        'waiting_verification' => 'bg-blue-500/10 text-blue-400',
        'waiting_site_payment' => 'bg-orange-500/10 text-orange-400',
        'payment_rejected' => 'bg-red-500/10 text-red-400',
        'payment_successful' => 'bg-green-500/10 text-green-400',
    ];

@endphp


<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Header -->

    <div class="mb-6">

        <a
            href="/admin/dashboard"
            class="text-sm text-[#8892a4] hover:text-white"
        >
            ← Dashboard
        </a>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">
            Repair Requests
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Review and set fixed prices for customer requests
        </p>

    </div>


    <!-- Filter -->

    <div class="flex gap-2 mb-6 overflow-x-auto pb-1">

        <a
            href="/admin/requests?filter=all"
            class="px-4 py-2 rounded-xl text-sm font-medium whitespace-nowrap
            {{ $filter === 'all'
                ? 'bg-[rgba(249,115,22,0.12)] text-[#f97316] border border-[rgba(249,115,22,0.2)]'
                : 'text-[#8892a4] border border-[#1a2744] hover:border-[#243356]' }}"
        >
            All Active
        </a>

        <a
            href="/admin/requests?filter=waiting_fixed_price"
            class="px-4 py-2 rounded-xl text-sm font-medium whitespace-nowrap
            {{ $filter === 'waiting_fixed_price'
                ? 'bg-[rgba(249,115,22,0.12)] text-[#f97316] border border-[rgba(249,115,22,0.2)]'
                : 'text-[#8892a4] border border-[#1a2744] hover:border-[#243356]' }}"
        >
            Need Price
        </a>

        <a
            href="/admin/requests?filter=waiting_payment"
            class="px-4 py-2 rounded-xl text-sm font-medium whitespace-nowrap
            {{ $filter === 'waiting_payment'
                ? 'bg-[rgba(249,115,22,0.12)] text-[#f97316] border border-[rgba(249,115,22,0.2)]'
                : 'text-[#8892a4] border border-[#1a2744] hover:border-[#243356]' }}"
        >
            Awaiting Payment
        </a>

    </div>


    @if ($filteredRequests->isEmpty())

        <!-- Empty State -->

        <div class="rounded-2xl border border-[#1a2744] bg-[#0c1424] p-10 text-center">

            <div class="text-4xl mb-3">
                🔧
            </div>

            <h2 class="font-semibold text-[#f0f4ff]">
                No requests
            </h2>

            <p class="text-sm text-[#8892a4] mt-1">
                No repair requests match this filter.
            </p>

        </div>

    @else

        <!-- Requests -->

        <div class="flex flex-col gap-4">

            @foreach ($filteredRequests as $req)

                @php

                    $status = $req->status ?? '';

                    $statusLabel = $statusLabels[$status] ?? $status;

                    $statusClass = $statusClasses[$status]
                        ?? 'bg-gray-500/10 text-gray-400';

                @endphp


                <div class="rounded-2xl border border-[#1a2744] bg-[#0c1424] p-5">

                    <!-- Customer -->

                    <div class="flex items-start justify-between gap-3 mb-4">

                        <div>

                            <p class="font-bold text-[#f0f4ff]">
                                {{ $req->customer_name ?? 'Customer' }}
                            </p>

                            <p class="text-xs text-[#8892a4] mt-1">
                                {{ $req->phone ?? '-' }}
                            </p>

                        </div>


                        <span
                            class="px-2.5 py-1 rounded-lg text-xs font-medium {{ $statusClass }}"
                        >
                            {{ $statusLabel }}
                        </span>

                    </div>


                    <!-- Info -->

                    <div class="divide-y divide-[#1a2744] mb-4 text-sm">

                        <div class="flex justify-between py-2 gap-4">

                            <span class="text-[#8892a4]">
                                Request ID
                            </span>

                            <span class="font-medium text-[#f0f4ff] text-right">
                                {{ $req->request_id ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between py-2 gap-4">

                            <span class="text-[#8892a4]">
                                Device
                            </span>

                            <span class="font-medium text-[#f0f4ff] text-right">
                                {{ $req->brand ?? '-' }}
                                {{ $req->model ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between py-2 gap-4">

                            <span class="text-[#8892a4]">
                                Damage
                            </span>

                            <span class="font-medium text-[#f0f4ff] text-right">
                                {{ $req->damage_name ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between py-2 gap-4">

                            <span class="text-[#8892a4]">
                                Estimated
                            </span>

                            <span class="font-mono text-[#8892a4] text-xs text-right">

                                Rp {{ number_format($req->estimated_price_min ?? 0, 0, ',', '.') }}

                                –

                                Rp {{ number_format($req->estimated_price_max ?? 0, 0, ',', '.') }}

                            </span>

                        </div>


                        @if ($req->fixed_price !== null)

                            <div class="flex justify-between py-2 gap-4">

                                <span class="text-[#8892a4]">
                                    Fixed Price
                                </span>

                                <span class="font-mono font-bold text-[#22d3ee]">

                                    Rp {{ number_format($req->fixed_price, 0, ',', '.') }}

                                </span>

                            </div>

                        @endif

                    </div>


                    <!-- Actions -->

                    <div class="flex items-center gap-2 flex-wrap">

                        <a
                            href="/admin/requests/{{ $req->id }}"
                            class="px-3 py-2 rounded-xl text-sm font-medium text-[#8892a4] border border-[#1a2744] hover:text-white hover:border-[#243356]"
                        >
                            👁 Details
                        </a>


                        @if ($status === 'waiting_fixed_price')

                            <a
                                href="/admin/requests/{{ $req->id }}/price"
                                class="px-3 py-2 rounded-xl text-sm font-medium bg-[#f97316] text-white hover:opacity-90"
                            >
                                🔧 Set Fixed Price
                            </a>

                        @endif


                        <span class="ml-auto text-xs text-[#4a5568] font-mono">

                            #{{ $req->id }}

                        </span>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

</body>

</html>

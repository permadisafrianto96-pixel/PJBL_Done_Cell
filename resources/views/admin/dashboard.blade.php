<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DONE CELL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

@php
    $activeRequest = session('activeRequest');

    $repairRequests = [];

    if ($activeRequest) {
        $repairRequests[] = $activeRequest;
    }

    $newRequests = collect($repairRequests)
        ->where('status', 'waiting_fixed_price')
        ->count();

    $awaitingPayment = collect($repairRequests)
        ->where('status', 'waiting_payment')
        ->count();

    $verification = collect($repairRequests)
        ->whereIn('status', [
            'waiting_verification',
            'waiting_site_payment'
        ])
        ->count();

    $successful = collect($repairRequests)
        ->where('status', 'payment_successful')
        ->count();

    $totalRevenue = collect($repairRequests)
        ->filter(function ($request) {
            return ($request['status'] ?? null) === 'payment_successful'
                && isset($request['fixedPrice']);
        })
        ->sum('fixedPrice');

    $recentRequests = collect($repairRequests)
        ->sortByDesc(function ($request) {
            return $request['createdAt'] ?? '';
        })
        ->take(5);

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

<div class="max-w-6xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex items-center justify-between pt-4 md:pt-8 mb-8">

        <div>
            <h1 class="text-2xl font-bold text-[#f0f4ff]">
                Dashboard
            </h1>

            <p class="text-sm text-[#8892a4] mt-0.5">
                Overview of all repair operations
            </p>
        </div>

        <a href="/admin/profile"
           class="w-10 h-10 rounded-full bg-[#1a2744]
                  flex items-center justify-center
                  text-sm font-bold text-[#22d3ee]
                  hover:bg-[#243356] transition">

            A
        </a>

    </div>


    <!-- Navigation -->
    <div class="flex gap-2 overflow-x-auto mb-8 pb-1">

        <a href="/admin/dashboard"
           class="px-4 py-2 rounded-xl
                  bg-orange-500/10 text-orange-400
                  border border-orange-500/20
                  text-sm whitespace-nowrap">
            Dashboard
        </a>

        <a href="/admin/requests"
           class="px-4 py-2 rounded-xl
                  text-[#8892a4]
                  border border-[#1a2744]
                  hover:text-white
                  hover:border-[#243356]
                  text-sm whitespace-nowrap transition">
            Requests
        </a>

        <a href="/admin/payments"
           class="px-4 py-2 rounded-xl
                  text-[#8892a4]
                  border border-[#1a2744]
                  hover:text-white
                  hover:border-[#243356]
                  text-sm whitespace-nowrap transition">
            Payments
        </a>

        <a href="/admin/notifications"
           class="px-4 py-2 rounded-xl
                  text-[#8892a4]
                  border border-[#1a2744]
                  hover:text-white
                  hover:border-[#243356]
                  text-sm whitespace-nowrap transition">
            Notifications
        </a>

        <a href="/admin/history"
           class="px-4 py-2 rounded-xl
                  text-[#8892a4]
                  border border-[#1a2744]
                  hover:text-white
                  hover:border-[#243356]
                  text-sm whitespace-nowrap transition">
            History
        </a>

          <a href="/admin/master"
           class="px-4 py-2 rounded-xl
                  text-[#8892a4]
                  border border-[#1a2744]
                  hover:text-white
                  hover:border-[#243356]
                  text-sm whitespace-nowrap transition">
            Tambah
        </a>

    </div>


    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

        <div class="bg-[#0f1729]
                    border border-[#1a2744]
                    rounded-2xl
                    p-4">

            <div class="flex items-center justify-between mb-4">

                <div class="w-10 h-10 rounded-xl
                            bg-orange-500/10
                            text-orange-400
                            flex items-center justify-center">
                    🔧
                </div>

                <span class="text-xs text-[#4a5568]">
                    New
                </span>

            </div>

            <p class="text-xs text-[#8892a4] mb-1">
                New Requests
            </p>

            <p class="text-2xl font-bold text-[#f0f4ff]">
                {{ $newRequests }}
            </p>

            <p class="text-xs text-[#4a5568] mt-1">
                Awaiting fixed price
            </p>

        </div>


        <div class="bg-[#0f1729]
                    border border-[#1a2744]
                    rounded-2xl
                    p-4">

            <div class="flex items-center justify-between mb-4">

                <div class="w-10 h-10 rounded-xl
                            bg-orange-500/10
                            text-orange-400
                            flex items-center justify-center">
                    💳
                </div>

                <span class="text-xs text-[#4a5568]">
                    Payment
                </span>

            </div>

            <p class="text-xs text-[#8892a4] mb-1">
                Awaiting Payment
            </p>

            <p class="text-2xl font-bold text-[#f0f4ff]">
                {{ $awaitingPayment }}
            </p>

            <p class="text-xs text-[#4a5568] mt-1">
                Price set, unpaid
            </p>

        </div>


        <div class="bg-[#0f1729]
                    border border-[#1a2744]
                    rounded-2xl
                    p-4">

            <div class="flex items-center justify-between mb-4">

                <div class="w-10 h-10 rounded-xl
                            bg-[rgba(34,211,238,0.1)]
                            text-[#22d3ee]
                            flex items-center justify-center">
                    ⏱️
                </div>

                <span class="text-xs text-[#4a5568]">
                    Review
                </span>

            </div>

            <p class="text-xs text-[#8892a4] mb-1">
                Under Verification
            </p>

            <p class="text-2xl font-bold text-[#f0f4ff]">
                {{ $verification }}
            </p>

            <p class="text-xs text-[#4a5568] mt-1">
                Payment submitted
            </p>

        </div>


        <div class="bg-[#0f1729]
                    border border-[#1a2744]
                    rounded-2xl
                    p-4">

            <div class="flex items-center justify-between mb-4">

                <div class="w-10 h-10 rounded-xl
                            bg-green-500/10
                            text-green-400
                            flex items-center justify-center">
                    ✓
                </div>

                <span class="text-xs text-[#4a5568]">
                    Done
                </span>

            </div>

            <p class="text-xs text-[#8892a4] mb-1">
                Completed
            </p>

            <p class="text-2xl font-bold text-[#f0f4ff]">
                {{ $successful }}
            </p>

            <p class="text-xs text-[#4a5568] mt-1">
                Total:
                <span class="text-green-400">
                    Rp{{ number_format($totalRevenue, 0, ',', '.') }}
                </span>
            </p>

        </div>

    </div>


    <!-- Notification -->
    <a href="/admin/notifications"
       class="flex items-center justify-between gap-4
              px-5 py-4
              rounded-2xl mb-6
              bg-[rgba(249,115,22,0.05)]
              border border-[rgba(249,115,22,0.2)]
              hover:border-orange-500/40
              transition">

        <div class="flex items-center gap-3">

            <div class="w-9 h-9 rounded-xl
                        bg-orange-500/10
                        text-orange-400
                        flex items-center justify-center">
                🔔
            </div>

            <div>
                <p class="text-sm font-medium text-[#f0f4ff]">
                    Check repair requests that require your attention.
                </p>

                <p class="text-xs text-[#8892a4] mt-1">
                    Open notifications
                </p>
            </div>

        </div>

        <span class="text-orange-400 text-xl">
            →
        </span>

    </a>


    <!-- Recent Requests -->
    <div class="mb-6">

        <div class="flex items-center justify-between mb-4">

            <h2 class="text-base font-semibold text-[#f0f4ff]">
                Recent Requests
            </h2>

            <a href="/admin/requests"
               class="text-xs text-[#22d3ee] hover:underline">
                View All →
            </a>

        </div>


        <div class="flex flex-col gap-3">

            @forelse($recentRequests as $request)

                @php
                    $requestStatus = $request['status'] ?? null;

                    $requestStatusLabel =
                        $statusLabels[$requestStatus]
                        ?? 'Waiting';

                    $requestStatusClass =
                        $statusClasses[$requestStatus]
                        ?? 'bg-yellow-500/10 text-yellow-400';
                @endphp

                <div class="bg-[#0f1729]
                            border border-[#1a2744]
                            rounded-2xl
                            p-4
                            hover:border-[#243356]
                            transition">

                    <div class="flex items-start justify-between
                                gap-3 mb-2">

                        <div>

                            <p class="font-semibold
                                      text-[#f0f4ff]
                                      text-sm">

                                {{ $request['customerName'] ?? 'Customer' }}

                            </p>

                            <p class="text-xs
                                      text-[#8892a4]
                                      mt-0.5">

                                {{ $request['brand'] ?? 'Unknown Brand' }}

                                {{ $request['model'] ?? '' }}

                                —

                                {{ $request['damageName'] ?? 'Repair Request' }}

                            </p>

                        </div>


                        <span class="px-2.5 py-1
                                     rounded-full
                                     text-xs font-medium
                                     {{ $requestStatusClass }}">

                            {{ $requestStatusLabel }}

                        </span>

                    </div>


                    <div class="flex items-center
                                justify-between
                                text-xs text-[#4a5568]">

                        <span class="font-mono">

                            #{{ $request['requestId']
                                ?? $request['id']
                                ?? 'REQ-001' }}

                        </span>


                        <div class="flex items-center gap-3">

                            @if(isset($request['fixedPrice'])
                                && $request['fixedPrice'] !== null)

                                <span class="text-[#22d3ee]
                                             font-mono
                                             font-semibold">

                                    Rp{{ number_format(
                                        $request['fixedPrice'],
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            @endif


                            <span>

                                @if(isset($request['createdAt']))

                                    {{ \Carbon\Carbon::parse(
                                        $request['createdAt']
                                    )->format('d M') }}

                                @else

                                    -

                                @endif

                            </span>

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-[#0f1729]
                            border border-[#1a2744]
                            rounded-2xl
                            p-8
                            text-center">

                    <div class="text-3xl mb-3">
                        🔧
                    </div>

                    <p class="text-sm font-semibold
                              text-[#f0f4ff]">

                        No repair requests yet

                    </p>

                    <p class="text-xs text-[#8892a4] mt-1">

                        New customer requests will appear here.

                    </p>

                </div>

            @endforelse

        </div>

    </div>


    

</body>
</html>
@php
    $activeRequest = session('activeRequest');

    $repairRequests = [];

    if ($activeRequest) {
        $repairRequests[] = $activeRequest;
    }

    $allRequests = collect($repairRequests)
        ->sortByDesc(function ($request) {
            return $request['createdAt'] ?? '';
        })
        ->values();
    
    $statusLabels = [
        'waiting_fixed_price' => 'Waiting Fixed Price',
        'waiting_payment' => 'Waiting Payment',
        'waiting_verification' => 'Waiting Verification',
        'waiting_site_payment' => 'Waiting Site Payment',
        'payment_rejected' => 'Payment Rejected',
        'payment_successful' => 'Payment Successful',
        'waiting_technician' => 'Waiting Technician',
    ];

    $statusClasses = [
        'waiting_fixed_price' => 'bg-yellow-500/10 text-yellow-400',
        'waiting_payment' => 'bg-orange-500/10 text-orange-400',
        'waiting_verification' => 'bg-blue-500/10 text-blue-400',
        'waiting_site_payment' => 'bg-orange-500/10 text-orange-400',
        'payment_rejected' => 'bg-red-500/10 text-red-400',
        'payment_successful' => 'bg-green-500/10 text-green-400',
        'waiting_technician' => 'bg-yellow-500/10 text-yellow-400',
    ];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Repair History - Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#080f1d] text-[#f0f4ff] min-h-screen">

<div class="max-w-5xl mx-auto px-4 md:px-6 pb-8">

    <!-- Header -->
    <div class="pt-6 md:pt-10 mb-6">

        <div class="flex items-center gap-3 mb-4">
            <a
                href="/admin/dashboard"
                class="text-[#8892a4] hover:text-[#f0f4ff] transition"
            >
                ←
            </a>

            <span class="text-sm text-[#8892a4]">
                Admin
            </span>
        </div>

        <h1 class="text-2xl font-bold">
            Repair History
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            All repair transactions — {{ $allRequests->count() }} total
        </p>

    </div>


    <!-- Search -->
    <div class="relative mb-6">

        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[#4a5568]">
            🔍
        </span>

        <input
            type="text"
            id="searchInput"
            placeholder="Search by customer, model, damage, or ID..."
            class="w-full bg-[#0f1729] border border-[#1a2744] text-[#f0f4ff] placeholder:text-[#4a5568] rounded-xl pl-10 pr-4 py-3 text-sm focus:outline-none focus:border-[#22d3ee] focus:ring-1 focus:ring-[#22d3ee] transition-all"
        >

    </div>


    <!-- History List -->
    <div id="historyList" class="flex flex-col gap-3">

        @forelse ($allRequests as $request)

            @php
                $status = $request['status'] ?? '';

                $statusLabel = $statusLabels[$status] ?? $status;

                $statusClass = $statusClasses[$status] ?? 'bg-gray-500/10 text-gray-400';

                $paymentMethod = $request['paymentMethod'] ?? null;

                if ($paymentMethod) {
                    $paymentMethod = str_replace('_', ' ', $paymentMethod);
                }
            @endphp

            <div
                class="history-item rounded-2xl border border-[#1a2744] bg-[#0f1729] p-4"
                data-search="
                    {{ strtolower($request['customerName'] ?? '') }}
                    {{ strtolower($request['model'] ?? '') }}
                    {{ strtolower($request['damageName'] ?? '') }}
                    {{ strtolower($request['id'] ?? '') }}
                "
            >

                <!-- Customer -->
                <div class="flex items-start justify-between gap-3 mb-3">

                    <div>

                        <p class="font-bold text-sm">
                            {{ $request['customerName'] ?? '—' }}
                        </p>

                        <p class="text-xs text-[#8892a4] mt-1">
                            {{ $request['brand'] ?? '—' }}
                            {{ $request['model'] ?? '' }}
                            —
                            {{ $request['damageName'] ?? '—' }}
                        </p>

                    </div>

                    <span class="px-2.5 py-1 rounded-lg text-xs font-medium whitespace-nowrap {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>

                </div>


                <!-- Info -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-x-3 gap-y-3 mb-3">

                    <div>
                        <p class="text-xs text-[#4a5568]">
                            Estimated
                        </p>

                        <p class="text-xs font-mono text-[#8892a4]">
                            Rp {{ number_format($request['estimatedPriceMin'] ?? 0, 0, ',', '.') }}
                            –
                            Rp {{ number_format($request['estimatedPriceMax'] ?? 0, 0, ',', '.') }}
                        </p>
                    </div>


                    @if (isset($request['fixedPrice']) && $request['fixedPrice'] !== null)

                        <div>
                            <p class="text-xs text-[#4a5568]">
                                Fixed
                            </p>

                            <p class="text-sm font-mono font-bold text-[#22d3ee]">
                                Rp {{ number_format($request['fixedPrice'], 0, ',', '.') }}
                            </p>
                        </div>

                    @endif


                    <div>
                        <p class="text-xs text-[#4a5568]">
                            Payment
                        </p>

                        <p class="text-xs capitalize">
                            {{ $paymentMethod ?: '—' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs text-[#4a5568]">
                            Date
                        </p>

                        <p class="text-xs">
                            @if (!empty($request['createdAt']))
                                {{ \Carbon\Carbon::parse($request['createdAt'])->format('d M Y') }}
                            @else
                                —
                            @endif
                        </p>
                    </div>

                </div>


                <!-- Actions -->
                <div class="flex items-center gap-2 pt-2 border-t border-[#1a2744]">

                    <button
                        type="button"
                        onclick='openHistoryModal(@json($request))'
                        class="px-3 py-2 rounded-xl text-sm font-medium text-[#8892a4] border border-[#1a2744] hover:text-[#f0f4ff] hover:border-[#243356] transition"
                    >
                        👁 Details
                    </button>

                    <span class="ml-auto text-xs text-[#4a5568] font-mono">
                        #{{ $request['id'] ?? '—' }}
                    </span>

                </div>

            </div>

        @empty

            <div
                id="emptyState"
                class="rounded-2xl border border-[#1a2744] bg-[#0f1729] p-10 text-center"
            >

                <div class="text-3xl mb-3">
                    📋
                </div>

                <h2 class="font-semibold">
                    No results
                </h2>

                <p class="text-sm text-[#8892a4] mt-1">
                    Try a different search term.
                </p>

            </div>

        @endforelse

    </div>

</div>


<!-- Detail Modal -->
<div
    id="historyModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
>

    <div
        class="absolute inset-0 bg-black/80 backdrop-blur-sm"
        onclick="closeHistoryModal()"
    ></div>


    <div class="relative max-w-lg w-full max-h-[90vh] overflow-y-auto bg-[#0f1729] border border-[#1a2744] rounded-2xl">

        <!-- Modal Header -->
        <div class="flex items-center justify-between px-5 py-4 border-b border-[#1a2744]">

            <h2 class="font-semibold">
                Full Repair Record
            </h2>

            <button
                type="button"
                onclick="closeHistoryModal()"
                class="text-[#8892a4] hover:text-[#f0f4ff] text-xl"
            >
                ×
            </button>

        </div>


        <!-- Modal Content -->
        <div id="historyModalContent" class="p-5">
        </div>

    </div>

</div>


<script>

    const searchInput = document.getElementById('searchInput');
    const historyItems = document.querySelectorAll('.history-item');

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        let visible = 0;

        historyItems.forEach(function (item) {

            const data = item.dataset.search;

            if (data.includes(keyword)) {
                item.classList.remove('hidden');
                visible++;
            } else {
                item.classList.add('hidden');
            }

        });

        let noResults = document.getElementById('searchEmpty');

        if (visible === 0) {

            if (!noResults) {

                noResults = document.createElement('div');

                noResults.id = 'searchEmpty';

                noResults.className =
                    'rounded-2xl border border-[#1a2744] bg-[#0f1729] p-10 text-center';

                noResults.innerHTML = `
                    <div class="text-3xl mb-3">📋</div>
                    <h2 class="font-semibold">No results</h2>
                    <p class="text-sm text-[#8892a4] mt-1">
                        Try a different search term.
                    </p>
                `;

                document.getElementById('historyList').appendChild(noResults);
            }

        } else if (noResults) {

            noResults.remove();

        }

    });


    function openHistoryModal(request) {

        const statusLabels = {
            waiting_fixed_price: 'Waiting Fixed Price',
            waiting_payment: 'Waiting Payment',
            waiting_verification: 'Waiting Verification',
            waiting_site_payment: 'Waiting Site Payment',
            payment_rejected: 'Payment Rejected',
            payment_successful: 'Payment Successful',
            waiting_technician: 'Waiting Technician'
        };

        const paymentMethod = request.paymentMethod
            ? request.paymentMethod.replace('_', ' ')
            : '—';

        let html = `

            <div class="flex flex-col divide-y divide-[#1a2744]">

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">ID</span>
                    <span class="text-sm font-mono">
                        #${request.id ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Date</span>
                    <span class="text-sm">
                        ${formatDate(request.createdAt)}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Customer</span>
                    <span class="text-sm text-right">
                        ${request.customerName ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Phone</span>
                    <span class="text-sm text-right">
                        ${request.customerPhone ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Email</span>
                    <span class="text-sm text-right break-all">
                        ${request.customerEmail ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Address</span>
                    <span class="text-sm text-right">
                        ${request.customerAddress ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Brand</span>
                    <span class="text-sm">
                        ${request.brand ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Model</span>
                    <span class="text-sm">
                        ${request.model ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Category</span>
                    <span class="text-sm">
                        ${request.category ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Damage</span>
                    <span class="text-sm">
                        ${request.damageName ?? '—'}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Estimated</span>
                    <span class="text-sm font-mono">
                        Rp ${formatRupiah(request.estimatedPriceMin)}
                        –
                        Rp ${formatRupiah(request.estimatedPriceMax)}
                    </span>
                </div>
        `;

        if (request.fixedPrice !== null && request.fixedPrice !== undefined) {

            html += `

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Fixed Price</span>
                    <span class="text-sm font-mono text-[#22d3ee]">
                        Rp ${formatRupiah(request.fixedPrice)}
                    </span>
                </div>

            `;

        }

        html += `

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Payment</span>
                    <span class="text-sm capitalize">
                        ${paymentMethod}
                    </span>
                </div>

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Status</span>
                    <span class="text-sm">
                        ${statusLabels[request.status] ?? request.status ?? '—'}
                    </span>
                </div>

        `;

        if (request.pickupDate) {

            html += `

                <div class="flex justify-between gap-4 py-3">
                    <span class="text-xs text-[#8892a4]">Pickup Date</span>
                    <span class="text-sm">
                        ${formatDate(request.pickupDate)}
                    </span>
                </div>

            `;

        }

        html += `
            </div>
        `;

        document.getElementById('historyModalContent').innerHTML = html;

        document.getElementById('historyModal').classList.remove('hidden');
    }


    function closeHistoryModal() {
        document.getElementById('historyModal').classList.add('hidden');
    }


    function formatDate(date) {

        if (!date) {
            return '—';
        }

        const parsed = new Date(date);

        if (isNaN(parsed.getTime())) {
            return '—';
        }

        return parsed.toLocaleDateString('en-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });

    }


    function formatRupiah(value) {

        return new Intl.NumberFormat('id-ID').format(value || 0);

    }

</script>

</body>
</html>
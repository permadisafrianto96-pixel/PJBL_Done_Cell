@php
    $activeRequest = session('activeRequest');

    $paymentRequests = [];

    if ($activeRequest && in_array($activeRequest['status'] ?? '', [
        'waiting_verification',
        'waiting_site_payment',
        'payment_rejected',
        'payment_successful'
    ])) {
        $paymentRequests[] = $activeRequest;
    }

    $statusLabels = [
        'waiting_verification' => 'Waiting Verification',
        'waiting_site_payment' => 'Waiting Site Payment',
        'payment_rejected' => 'Payment Rejected',
        'payment_successful' => 'Payment Successful',
    ];

    $statusClasses = [
        'waiting_verification' => 'bg-blue-500/10 text-blue-400',
        'waiting_site_payment' => 'bg-orange-500/10 text-orange-400',
        'payment_rejected' => 'bg-red-500/10 text-red-400',
        'payment_successful' => 'bg-green-500/10 text-green-400',
    ];
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Admin</title>

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
            Payments
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Verify bank transfers and confirm on-site payments
        </p>
    </div>

    <!-- Payment List -->
    @if (count($paymentRequests) === 0)

        <div class="rounded-2xl border border-[#1a2744] bg-[#0f1729] p-10 text-center">
            <div class="text-3xl mb-3">
                💳
            </div>

            <h2 class="font-semibold text-[#f0f4ff]">
                No payments
            </h2>

            <p class="text-sm text-[#8892a4] mt-1">
                Payment submissions will appear here.
            </p>
        </div>

    @else

        <div class="flex flex-col gap-4">

            @foreach ($paymentRequests as $request)

                @php
                    $status = $request['status'] ?? '';
                    $bankDetails = $request['bankDetails'] ?? null;

                    $isBankPending = $status === 'waiting_verification';
                    $isSitePending = $status === 'waiting_site_payment';

                    $fixedPrice = $request['fixedPrice'] ?? 0;

                    $paymentMethod = $request['paymentMethod'] ?? null;

                    if ($paymentMethod === 'bank_transfer') {
                        $paymentMethodText = 'Bank Transfer';
                    } elseif ($paymentMethod === 'pay_on_site') {
                        $paymentMethodText = 'Pay on Site';
                    } else {
                        $paymentMethodText = '—';
                    }
                @endphp

                <div class="rounded-2xl border border-[#1a2744] bg-[#0f1729] p-5">

                    <!-- Customer -->
                    <div class="flex items-start justify-between gap-3 mb-4">

                        <div>
                            <p class="font-bold">
                                {{ $request['customerName'] ?? '—' }}
                            </p>

                            <p class="text-xs text-[#8892a4] mt-1">
                                {{ $request['brand'] ?? '—' }}
                                {{ $request['model'] ?? '' }}
                                —
                                {{ $request['damageName'] ?? '—' }}
                            </p>
                        </div>

                        <span class="px-2.5 py-1 rounded-lg text-xs font-medium whitespace-nowrap {{ $statusClasses[$status] ?? 'bg-gray-500/10 text-gray-400' }}">
                            {{ $statusLabels[$status] ?? $status }}
                        </span>

                    </div>

                    <!-- Payment Info -->
                    <div class="flex flex-col divide-y divide-[#1a2744] mb-4 text-sm">

                        <div class="flex justify-between gap-4 py-2">
                            <span class="text-[#8892a4]">
                                Fixed Price
                            </span>

                            <span class="font-mono font-bold text-[#22d3ee]">
                                Rp {{ number_format($fixedPrice, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4 py-2">
                            <span class="text-[#8892a4]">
                                Method
                            </span>

                            <span class="font-medium">
                                {{ $paymentMethodText }}
                            </span>
                        </div>

                        @if ($bankDetails)

                            <div class="flex justify-between gap-4 py-2">
                                <span class="text-[#8892a4]">
                                    Sender Bank
                                </span>

                                <span class="font-medium text-right">
                                    {{ $bankDetails['senderBank'] ?? '—' }}
                                    ·
                                    {{ $bankDetails['accountHolder'] ?? '—' }}
                                </span>
                            </div>

                        @endif

                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 flex-wrap">

                        <button
                            type="button"
                            onclick="openDetailModal()"
                            class="px-3 py-2 rounded-xl text-sm font-medium text-[#8892a4] border border-[#1a2744] hover:text-[#f0f4ff] hover:border-[#243356] transition"
                        >
                            👁 Details
                        </button>

                        @if ($bankDetails && !empty($bankDetails['proofUrl']))

                            <button
                                type="button"
                                onclick="openProofModal('{{ $bankDetails['proofUrl'] }}')"
                                class="px-3 py-2 rounded-xl text-sm font-medium bg-[#1a2744] hover:bg-[#243356] transition"
                            >
                                View Proof
                            </button>

                        @endif

                        @if ($isBankPending)

                            <form
                                method="POST"
                                action="/admin/payments/approve"
                                class="inline"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="px-3 py-2 rounded-xl text-sm font-medium bg-green-500/10 text-green-400 hover:bg-green-500/20 transition"
                                >
                                    ✓ Approve
                                </button>
                            </form>

                            <form
                                method="POST"
                                action="/admin/payments/reject"
                                class="inline"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="px-3 py-2 rounded-xl text-sm font-medium bg-red-500/10 text-red-400 hover:bg-red-500/20 transition"
                                >
                                    ✕ Reject
                                </button>
                            </form>

                        @endif

                        @if ($isSitePending)

                            <form
                                method="POST"
                                action="/admin/payments/confirm-site"
                                class="inline"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="px-3 py-2 rounded-xl text-sm font-medium bg-green-500/10 text-green-400 hover:bg-green-500/20 transition"
                                >
                                    Payment Received
                                </button>
                            </form>

                            <form
                                method="POST"
                                action="/admin/payments/deny-site"
                                class="inline"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="px-3 py-2 rounded-xl text-sm font-medium bg-red-500/10 text-red-400 hover:bg-red-500/20 transition"
                                >
                                    Not Received
                                </button>
                            </form>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>


<!-- Detail Modal -->
<div
    id="detailModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
>
    <div
        class="absolute inset-0 bg-black/80 backdrop-blur-sm"
        onclick="closeDetailModal()"
    ></div>

    <div class="relative max-w-lg w-full max-h-[90vh] overflow-y-auto bg-[#0f1729] border border-[#1a2744] rounded-2xl">

        <div class="flex items-center justify-between px-5 py-4 border-b border-[#1a2744]">

            <h2 class="font-semibold">
                Payment Details
            </h2>

            <button
                type="button"
                onclick="closeDetailModal()"
                class="text-[#8892a4] hover:text-[#f0f4ff] text-xl"
            >
                ×
            </button>

        </div>

        <div class="p-5">

            @if ($activeRequest)

                @php
                    $detailBank = $activeRequest['bankDetails'] ?? null;
                @endphp

                <div class="flex flex-col divide-y divide-[#1a2744]">

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Request ID</span>
                        <span class="text-sm font-mono">
                            #{{ $activeRequest['id'] ?? '—' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Customer</span>
                        <span class="text-sm text-right">
                            {{ $activeRequest['customerName'] ?? '—' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Phone</span>
                        <span class="text-sm text-right">
                            {{ $activeRequest['customerPhone'] ?? '—' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Email</span>
                        <span class="text-sm text-right break-all">
                            {{ $activeRequest['customerEmail'] ?? '—' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Address</span>
                        <span class="text-sm text-right">
                            {{ $activeRequest['customerAddress'] ?? '—' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Device</span>
                        <span class="text-sm text-right">
                            {{ $activeRequest['brand'] ?? '—' }}
                            {{ $activeRequest['model'] ?? '' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Repair</span>
                        <span class="text-sm text-right">
                            {{ $activeRequest['damageName'] ?? '—' }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Fixed Price</span>
                        <span class="text-sm font-mono text-[#22d3ee]">
                            Rp {{ number_format($activeRequest['fixedPrice'] ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Method</span>
                        <span class="text-sm">
                            {{ str_replace('_', ' ', $activeRequest['paymentMethod'] ?? '—') }}
                        </span>
                    </div>

                    @if ($detailBank)

                        <div class="flex justify-between gap-4 py-3">
                            <span class="text-xs text-[#8892a4]">Sender Phone</span>
                            <span class="text-sm">
                                {{ $detailBank['phoneNumber'] ?? '—' }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4 py-3">
                            <span class="text-xs text-[#8892a4]">Sender Bank</span>
                            <span class="text-sm">
                                {{ $detailBank['senderBank'] ?? '—' }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4 py-3">
                            <span class="text-xs text-[#8892a4]">Account Holder</span>
                            <span class="text-sm">
                                {{ $detailBank['accountHolder'] ?? '—' }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4 py-3">
                            <span class="text-xs text-[#8892a4]">Account Number</span>
                            <span class="text-sm font-mono">
                                {{ $detailBank['accountNumber'] ?? '—' }}
                            </span>
                        </div>

                        <div class="flex justify-between gap-4 py-3">
                            <span class="text-xs text-[#8892a4]">Transfer Amount</span>
                            <span class="text-sm font-mono text-[#22d3ee]">
                                Rp {{ number_format($detailBank['transferAmount'] ?? 0, 0, ',', '.') }}
                            </span>
                        </div>

                    @endif

                    <div class="flex justify-between gap-4 py-3">
                        <span class="text-xs text-[#8892a4]">Status</span>
                        <span class="text-sm">
                            {{ $statusLabels[$activeRequest['status'] ?? ''] ?? ($activeRequest['status'] ?? '—') }}
                        </span>
                    </div>

                </div>

                @if ($detailBank && !empty($detailBank['proofUrl']))

                    <div class="mt-5">

                        <p class="text-xs text-[#8892a4] mb-2">
                            Payment Proof
                        </p>

                        <img
                            src="{{ $detailBank['proofUrl'] }}"
                            alt="Payment proof"
                            class="w-full rounded-xl border border-[#1a2744] object-contain max-h-64"
                        >

                    </div>

                @elseif (($activeRequest['paymentMethod'] ?? '') === 'bank_transfer')

                    <div class="mt-4 text-center py-6 rounded-xl bg-[#0c1424] border border-[#1a2744]">

                        <p class="text-sm text-[#4a5568]">
                            No payment proof uploaded yet
                        </p>

                    </div>

                @endif

            @else

                <p class="text-sm text-[#8892a4] text-center">
                    No payment details available.
                </p>

            @endif

        </div>

    </div>
</div>


<!-- Proof Modal -->
<div
    id="proofModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
>
    <div
        class="absolute inset-0 bg-black/80 backdrop-blur-sm"
        onclick="closeProofModal()"
    ></div>

    <div class="relative max-w-lg w-full bg-[#0f1729] border border-[#1a2744] rounded-2xl overflow-hidden">

        <div class="flex items-center justify-between px-4 py-3 border-b border-[#1a2744]">

            <p class="font-semibold">
                Payment Proof
            </p>

            <button
                type="button"
                onclick="closeProofModal()"
                class="text-[#4a5568] hover:text-[#f0f4ff] text-xl"
            >
                ×
            </button>

        </div>

        <div class="p-4">

            <img
                id="proofImage"
                src=""
                alt="Payment proof"
                class="w-full rounded-xl object-contain max-h-96"
            >

        </div>

    </div>
</div>


<script>
    function openDetailModal() {
        document.getElementById('detailModal').classList.remove('hidden');
    }

    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
    }

    function openProofModal(url) {
        document.getElementById('proofImage').src = url;
        document.getElementById('proofModal').classList.remove('hidden');
    }

    function closeProofModal() {
        document.getElementById('proofModal').classList.add('hidden');
        document.getElementById('proofImage').src = '';
    }
</script>

</body>
</html>
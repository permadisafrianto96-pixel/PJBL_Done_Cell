<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

@php
    // Data
    $user = session('user', []);
    $activeRequest = session('activeRequest');

    $name = $user['name'] ?? 'Admin';
    $email = $user['email'] ?? '-';
    $phone = $user['phone'] ?? '-';
    $address = $user['address'] ?? '-';

    $repairRequests = [];

    if ($activeRequest) {
        $repairRequests[] = $activeRequest;
    }

    $total = count($repairRequests);

    $successful = collect($repairRequests)
        ->where('status', 'payment_successful')
        ->count();

    $pending = collect($repairRequests)
        ->whereIn('status', [
            'waiting_fixed_price',
            'waiting_payment',
            'waiting_verification',
            'waiting_site_payment'
        ])
        ->count();
@endphp

<div class="max-w-5xl mx-auto px-4 py-8">

    <!-- Header -->
    <div class="mb-8">
        <a href="/admin/dashboard" class="text-sm text-[#8892a4] hover:text-white">
            ← Dashboard
        </a>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">
            Admin Profile
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Your administrator account
        </p>
    </div>

    <!-- Avatar -->
    <div class="rounded-2xl border border-[#1a2744] bg-[#0c1424] p-6 mb-5">

        <div class="flex items-center gap-4 mb-5">

            <div class="w-16 h-16 rounded-2xl bg-[rgba(249,115,22,0.15)] border border-[rgba(249,115,22,0.2)] flex items-center justify-center text-[#f97316] text-2xl font-bold">
                {{ strtoupper(substr($name, 0, 1)) }}
            </div>

            <div>
                <h2 class="text-xl font-bold text-[#f0f4ff]">
                    {{ $name }}
                </h2>

                <p class="text-sm text-[#8892a4]">
                    {{ $email }}
                </p>

                <div class="flex items-center gap-2 mt-2">
                    <span class="text-[#f97316]">🛡</span>

                    <span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-orange-500/10 text-orange-400">
                        Administrator
                    </span>
                </div>
            </div>

        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-3 border-t border-[#1a2744] pt-4">

            <div class="text-center">
                <p class="text-xl font-bold text-[#f0f4ff]">
                    {{ $total }}
                </p>

                <p class="text-xs text-[#8892a4] mt-0.5">
                    Total Cases
                </p>
            </div>

            <div class="text-center border-x border-[#1a2744]">
                <p class="text-xl font-bold text-[#10b981]">
                    {{ $successful }}
                </p>

                <p class="text-xs text-[#8892a4] mt-0.5">
                    Completed
                </p>
            </div>

            <div class="text-center">
                <p class="text-xl font-bold text-[#f59e0b]">
                    {{ $pending }}
                </p>

                <p class="text-xs text-[#8892a4] mt-0.5">
                    In Progress
                </p>
            </div>

        </div>
    </div>

    <!-- Account Information -->
    <div class="rounded-2xl border border-[#1a2744] bg-[#0c1424] p-5 mb-5">

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-[#f0f4ff]">
                Account Information
            </h3>

            <a
                href="/admin/profile?edit=1"
                class="px-3 py-2 rounded-xl text-sm text-[#8892a4] hover:text-white hover:bg-[#111c30]"
            >
                Edit
            </a>
        </div>

        @if (request('edit'))

            <!-- Edit Form -->
            <form action="/admin/profile/update" method="POST" class="flex flex-col gap-4">
                @csrf

                <div>
                    <label class="block text-xs text-[#8892a4] mb-2">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ $name }}"
                        class="w-full bg-[#080e1a] border border-[#1a2744] rounded-xl px-4 py-3 text-sm text-white outline-none focus:border-[#f97316]"
                    >
                </div>

                <div>
                    <label class="block text-xs text-[#8892a4] mb-2">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ $phone === '-' ? '' : $phone }}"
                        class="w-full bg-[#080e1a] border border-[#1a2744] rounded-xl px-4 py-3 text-sm text-white outline-none focus:border-[#f97316]"
                    >
                </div>

                <div class="flex gap-2">

                    <button
                        type="submit"
                        class="flex-1 px-4 py-3 rounded-xl bg-[#f97316] text-white text-sm font-semibold hover:opacity-90"
                    >
                        Save
                    </button>

                    <a
                        href="/admin/profile"
                        class="px-4 py-3 rounded-xl border border-[#1a2744] text-[#8892a4] text-sm hover:text-white"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        @else

            <!-- Account Info -->
            <div class="flex flex-col divide-y divide-[#1a2744]">

                <div class="flex items-start gap-3 py-3">
                    <span class="text-[#4a5568]">👤</span>

                    <div>
                        <p class="text-xs text-[#8892a4]">
                            Name
                        </p>

                        <p class="text-sm text-[#f0f4ff] font-medium mt-0.5">
                            {{ $name }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-3 py-3">
                    <span class="text-[#4a5568]">📱</span>

                    <div>
                        <p class="text-xs text-[#8892a4]">
                            Phone
                        </p>

                        <p class="text-sm text-[#f0f4ff] font-medium mt-0.5">
                            {{ $phone }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-3 py-3">
                    <span class="text-[#4a5568]">✉️</span>

                    <div>
                        <p class="text-xs text-[#8892a4]">
                            Email
                        </p>

                        <p class="text-sm text-[#f0f4ff] font-medium mt-0.5">
                            {{ $email }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-3 py-3">
                    <span class="text-[#4a5568]">📍</span>

                    <div>
                        <p class="text-xs text-[#8892a4]">
                            Address
                        </p>

                        <p class="text-sm text-[#f0f4ff] font-medium mt-0.5">
                            {{ $address }}
                        </p>
                    </div>
                </div>

            </div>

        @endif

    </div>

    <!-- Sign Out -->
    <form action="/logout" method="POST">
        @csrf

        <button
            type="submit"
            class="w-full px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 font-semibold hover:bg-red-500/15 transition"
        >
            🚪 Sign Out
        </button>
    </form>

</div>

</body>
</html>
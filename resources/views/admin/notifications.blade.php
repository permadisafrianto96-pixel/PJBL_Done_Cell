@php

    $notifications = session('notifications', []);

    $user = session('user', []);

    $myNotifs = collect($notifications)
        ->filter(function ($notification) use ($user) {
            return ($notification['userId'] ?? null) === ($user['id'] ?? null);
        })
        ->sortByDesc(function ($notification) {
            return $notification['createdAt'] ?? '';
        });

    $unread = $myNotifs->where('read', false)->count();

    $notifTitles = [
        'new_request' => 'New Repair Request',
        'verification_pending' => 'Payment Proof Submitted',
        'pay_now' => 'Pay on Site — Pending Confirmation',
        'payment_successful' => 'Payment Confirmed',
        'payment_rejected' => 'Payment Rejected',
    ];

    $notifIcons = [
        'fixed_price_set' => '🔧',
        'choose_payment' => '💳',
        'verification_pending' => '🕐',
        'payment_successful' => '✓',
        'payment_rejected' => '✕',
        'pay_now' => '💳',
        'pickup_ready' => '📱',
        'new_request' => '🔔',
    ];

    $notifColors = [
        'fixed_price_set' => 'text-cyan-400 bg-cyan-400/10',
        'choose_payment' => 'text-orange-400 bg-orange-400/10',
        'verification_pending' => 'text-cyan-400 bg-cyan-400/10',
        'payment_successful' => 'text-green-400 bg-green-400/10',
        'payment_rejected' => 'text-red-400 bg-red-400/10',
        'pay_now' => 'text-yellow-400 bg-yellow-400/10',
        'pickup_ready' => 'text-green-400 bg-green-400/10',
        'new_request' => 'text-orange-400 bg-orange-400/10',
    ];

@endphp

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Notifications - Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#080f1d] text-[#f0f4ff] min-h-screen">

<div class="max-w-5xl mx-auto px-4 md:px-6 pb-8">

    <!-- Header -->

    <div class="flex items-center justify-between pt-6 md:pt-10 mb-6">

        <div>

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
                Notifications
            </h1>

            @if ($unread > 0)

                <p class="text-sm text-[#8892a4] mt-1">
                    {{ $unread }} unread
                </p>

            @endif

        </div>

        @if ($unread > 0)

            <form
                method="POST"
                action="/admin/notifications/read-all"
            >

                @csrf

                <button
                    type="submit"
                    class="px-3 py-2 rounded-xl text-sm font-medium
                           text-[#8892a4]
                           border border-[#1a2744]
                           hover:text-[#f0f4ff]
                           hover:border-[#243356]
                           transition"
                >
                    Mark all read
                </button>

            </form>

        @endif

    </div>


    <!-- Notifications -->

    @if ($myNotifs->isEmpty())

        <div
            class="rounded-2xl
                   border border-[#1a2744]
                   bg-[#0f1729]
                   p-10
                   text-center"
        >

            <div class="text-3xl mb-3">
                🔔
            </div>

            <h2 class="font-semibold">
                No notifications
            </h2>

            <p class="text-sm text-[#8892a4] mt-1">
                Admin alerts will appear here.
            </p>

        </div>

    @else

        <div class="flex flex-col gap-3">

            @foreach ($myNotifs as $notif)

                @php

                    $type = $notif['type'] ?? '';

                    $icon = $notifIcons[$type] ?? '🔔';

                    $colorClass =
                        $notifColors[$type]
                        ?? 'text-[#8892a4] bg-[#8892a4]/10';

                    $title =
                        $notifTitles[$type]
                        ?? 'Notification';

                    $isRead =
                        $notif['read'] ?? false;

                    $createdAt =
                        $notif['createdAt'] ?? null;

                    $timeAgo = 'Just now';

                    if ($createdAt) {

                        $diff = now()->diffInSeconds(
                            \Carbon\Carbon::parse($createdAt)
                        );

                        if ($diff < 60) {

                            $timeAgo = 'Just now';

                        } elseif ($diff < 3600) {

                            $timeAgo =
                                floor($diff / 60) . 'm ago';

                        } elseif ($diff < 86400) {

                            $timeAgo =
                                floor($diff / 3600) . 'h ago';

                        } else {

                            $timeAgo =
                                floor($diff / 86400) . 'd ago';

                        }

                    }

                @endphp


                <form
                    method="POST"
                    action="/admin/notifications/{{ $notif['id'] ?? 0 }}/read"
                >

                    @csrf

                    <button
                        type="submit"
                        class="w-full text-left
                               rounded-2xl
                               p-4
                               border
                               transition-all
                               {{ $isRead
                                   ? 'bg-[#0f1729] border-[#1a2744]'
                                   : 'bg-[#0f1729] border-[#1e3a5a]' }}"
                    >

                        <div class="flex items-start gap-3">

                            <!-- Icon -->

                            <div
                                class="w-10 h-10
                                       rounded-xl
                                       flex
                                       items-center
                                       justify-center
                                       shrink-0
                                       text-lg
                                       {{ $colorClass }}"
                            >
                                {{ $icon }}
                            </div>


                            <!-- Content -->

                            <div class="flex-1">

                                <div
                                    class="flex items-center gap-2 mb-1"
                                >

                                    <span class="font-semibold text-sm">
                                        {{ $title }}
                                    </span>

                                    @if (!$isRead)

                                        <span
                                            class="w-2 h-2
                                                   rounded-full
                                                   bg-[#f97316]
                                                   shrink-0"
                                        >
                                        </span>

                                    @endif

                                </div>


                                <p
                                    class="text-sm
                                           text-[#8892a4]
                                           leading-relaxed"
                                >
                                    {{ $notif['message'] ?? '' }}
                                </p>


                                <p
                                    class="text-xs
                                           text-[#4a5568]
                                           mt-2"
                                >
                                    {{ $timeAgo }}
                                </p>

                            </div>

                        </div>

                    </button>

                </form>

            @endforeach

        </div>

    @endif

</div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#07111f] text-[#f0f4ff] min-h-screen">

@php
    $user = session('user');

    $activeRequest = session('activeRequest');

    $totalRepairs = $activeRequest ? 1 : 0;

    $successful = 0;

    if ($activeRequest && ($activeRequest['status'] ?? '') === 'payment_successful') {
        $successful = 1;
    }

    $inProgress = $totalRepairs - $successful;

    $name = $user['name'] ?? 'Customer';
    $phone = $user['phone'] ?? '';
    $email = $user['email'] ?? '';
    $address = $user['address'] ?? '';
@endphp


<div class="max-w-3xl mx-auto px-5 pb-24">

    <!-- HEADER -->
    <div class="pt-8 mb-8">

        <h1 class="text-2xl font-bold">
            Profile
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Manage your account information
        </p>

    </div>


    <!-- AVATAR & STATS -->
    <div class="bg-[#0c1424] border border-[#1a2744] rounded-2xl p-6 mb-5">

        <div class="flex items-center gap-4 mb-5">

            <!-- Avatar -->
            <div class="w-16 h-16 rounded-2xl
                        bg-[rgba(34,211,238,0.15)]
                        border border-[rgba(34,211,238,0.2)]
                        flex items-center justify-center
                        text-[#22d3ee]
                        text-2xl font-bold">

                {{ strtoupper(substr($name, 0, 1)) }}

            </div>


            <div>

                <h2 class="text-xl font-bold">
                    {{ $name }}
                </h2>

                <p class="text-sm text-[#8892a4]">
                    {{ $email ?: 'No email' }}
                </p>

                <div class="mt-2">

                    <span class="inline-flex items-center
                                 px-2.5 py-1
                                 rounded-lg
                                 bg-[rgba(34,211,238,0.12)]
                                 text-[#22d3ee]
                                 text-xs font-medium">

                        Customer

                    </span>

                </div>

            </div>

        </div>


        <!-- STATS -->
        <div class="grid grid-cols-3 gap-3
                    border-t border-[#1a2744]
                    pt-4">

            <div class="text-center">

                <p class="text-xl font-bold">
                    {{ $totalRepairs }}
                </p>

                <p class="text-xs text-[#8892a4] mt-1">
                    Total Repairs
                </p>

            </div>


            <div class="text-center border-x border-[#1a2744]">

                <p class="text-xl font-bold text-[#10b981]">
                    {{ $successful }}
                </p>

                <p class="text-xs text-[#8892a4] mt-1">
                    Completed
                </p>

            </div>


            <div class="text-center">

                <p class="text-xl font-bold text-[#f59e0b]">
                    {{ $inProgress }}
                </p>

                <p class="text-xs text-[#8892a4] mt-1">
                    In Progress
                </p>

            </div>

        </div>

    </div>


    <!-- ACCOUNT INFORMATION -->
    <div class="bg-[#0c1424] border border-[#1a2744] rounded-2xl p-5 mb-5">

        <div class="flex items-center justify-between mb-4">

            <h3 class="text-sm font-semibold">
                Account Information
            </h3>

            <a href="#edit-profile"
               class="text-sm text-[#22d3ee] hover:underline">

                Edit

            </a>

        </div>


        <div class="flex flex-col divide-y divide-[#1a2744]">

            <!-- NAME -->
            <div class="flex items-start gap-3 py-3">

                <div class="text-[#4a5568] mt-0.5">
                    👤
                </div>

                <div class="min-w-0">

                    <p class="text-xs text-[#8892a4]">
                        Full Name
                    </p>

                    <p class="text-sm font-medium mt-0.5 break-words">
                        {{ $name ?: '—' }}
                    </p>

                </div>

            </div>


            <!-- PHONE -->
            <div class="flex items-start gap-3 py-3">

                <div class="text-[#4a5568] mt-0.5">
                    📞
                </div>

                <div class="min-w-0">

                    <p class="text-xs text-[#8892a4]">
                        Phone Number
                    </p>

                    <p class="text-sm font-medium mt-0.5 break-words">
                        {{ $phone ?: '—' }}
                    </p>

                </div>

            </div>


            <!-- EMAIL -->
            <div class="flex items-start gap-3 py-3">

                <div class="text-[#4a5568] mt-0.5">
                    ✉
                </div>

                <div class="min-w-0">

                    <p class="text-xs text-[#8892a4]">
                        Email
                    </p>

                    <p class="text-sm font-medium mt-0.5 break-words">
                        {{ $email ?: '—' }}
                    </p>

                </div>

            </div>


            <!-- ADDRESS -->
            <div class="flex items-start gap-3 py-3">

                <div class="text-[#4a5568] mt-0.5">
                    📍
                </div>

                <div class="min-w-0">

                    <p class="text-xs text-[#8892a4]">
                        Address
                    </p>

                    <p class="text-sm font-medium mt-0.5 break-words">
                        {{ $address ?: '—' }}
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- LANGUAGE -->
<div class="bg-[#0c1424] border border-[#1a2744] rounded-2xl p-5 mb-5">

    <h3 class="text-sm font-semibold mb-1">
        Language
    </h3>

    <p class="text-xs text-[#8892a4] mb-4">
        Choose your preferred language
    </p>

    <div class="grid grid-cols-2 gap-3">

        <a href="/language/id"
           class="flex items-center justify-center gap-2
                  px-4 py-3
                  rounded-xl
                  border
                  {{ session('locale', 'id') === 'id'
                        ? 'bg-[#22d3ee] border-[#22d3ee] text-[#07111f]'
                        : 'bg-[#07111f] border-[#1a2744] text-[#8892a4]' }}
                  font-semibold text-sm
                  transition">

            🇮🇩 Indonesia

        </a>

      <a href="/language/eng"
   class="flex items-center justify-center gap-2
          px-4 py-3
          rounded-xl
          border
          {{ session('locale', 'id') === 'eng'
                ? 'bg-[#22d3ee] border-[#22d3ee] text-[#07111f]'
                : 'bg-[#07111f] border-[#1a2744] text-[#8892a4]' }}
          font-semibold text-sm
          transition">
    🇬🇧 English
</a>

    </div>

</div>


    <!-- EDIT PROFILE -->
    <div id="edit-profile"
         class="bg-[#0c1424] border border-[#1a2744] rounded-2xl p-5 mb-5">

        <h3 class="text-sm font-semibold mb-4">
            Edit Profile
        </h3>


        <form action="/profile/update"
              method="POST"
              class="flex flex-col gap-4">

            @csrf


            <!-- NAME -->
            <div>

                <label class="block text-sm font-medium text-[#c8d3e8] mb-1.5">
                    Full Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $name) }}"
                    required
                    class="w-full bg-[#07111f]
                           border border-[#1a2744]
                           text-[#f0f4ff]
                           rounded-xl
                           px-4 py-3
                           text-sm
                           focus:outline-none
                           focus:border-[#22d3ee]"
                >

            </div>


            <!-- PHONE -->
            <div>

                <label class="block text-sm font-medium text-[#c8d3e8] mb-1.5">
                    Phone Number
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $phone) }}"
                    class="w-full bg-[#07111f]
                           border border-[#1a2744]
                           text-[#f0f4ff]
                           rounded-xl
                           px-4 py-3
                           text-sm
                           focus:outline-none
                           focus:border-[#22d3ee]"
                >

            </div>


            <!-- ADDRESS -->
            <div>

                <label class="block text-sm font-medium text-[#c8d3e8] mb-1.5">
                    Address
                </label>

                <textarea
                    name="address"
                    rows="3"
                    class="w-full bg-[#07111f]
                           border border-[#1a2744]
                           text-[#f0f4ff]
                           rounded-xl
                           px-4 py-3
                           text-sm
                           focus:outline-none
                           focus:border-[#22d3ee]
                           resize-none"
                >{{ old('address', $address) }}</textarea>

            </div>


            <button
                type="submit"
                class="w-full
                       bg-[#22d3ee]
                       hover:bg-[#67e8f9]
                       text-[#07111f]
                       font-semibold
                       rounded-xl
                       px-4 py-3
                       transition">

                Save Changes

            </button>

        </form>

    </div>


    <!-- QUICK LINKS -->
    <div class="bg-[#0c1424] border border-[#1a2744] rounded-2xl p-4 mb-5">

        <a
            href="/repair-history"
            class="w-full flex items-center gap-3
                   px-2 py-3
                   rounded-xl
                   hover:bg-[#07111f]
                   transition"
        >

            <span class="text-[#22d3ee] text-lg">
                🔧
            </span>

            <span class="text-sm font-medium">
                Repair History
            </span>

            <span class="ml-auto text-xs text-[#4a5568]">
                {{ $totalRepairs }} repairs
            </span>

        </a>

    </div>


    <!-- LOGOUT -->
    <form action="/logout" method="POST">

        @csrf

        <button
            type="submit"
            class="w-full
                   flex items-center justify-center gap-2
                   bg-[#ef4444]
                   hover:bg-[#dc2626]
                   text-white
                   font-semibold
                   rounded-xl
                   px-4 py-3
                   transition">

            🚪
            Sign Out

        </button>

    </form>

</div>

</body>
</html>
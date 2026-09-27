<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

    <div class="min-h-screen flex">

        <!-- Nanti bagian kiri di sini -->

        <div class="hidden lg:flex w-2/5 bg-[#0c1424]">
            <h1 class="text-3xl font-bold m-auto">
                DONE CELL
            </h1>
        </div>

        <!-- Nanti bagian kanan di sini -->

        <div class="flex-1 flex items-center justify-center p-6">

            <div class="w-full max-w-md">

                <h1 class="text-2xl font-bold">
                    Sign in
                </h1>

               <p class="text-sm text-gray-400 mt-1">
    Enter your credentials to continue
</p>

<div class="flex gap-2 mb-6">

    <button
        
    type="button"
    onclick="fillDemo('customer')"
        class="flex-1 text-xs px-3 py-2 rounded-lg
        bg-[rgba(34,211,238,0.08)]
        border border-[rgba(34,211,238,0.2)]
        text-[#22d3ee]
        hover:bg-[rgba(34,211,238,0.12)]
        transition-all font-medium">
        Demo: Customer
    </button>

    <button
        
    type="button"
    onclick="fillDemo('admin')"
        
        class="flex-1 text-xs px-3 py-2 rounded-lg
        bg-[rgba(249,115,22,0.08)]
        border border-[rgba(249,115,22,0.2)]
        text-[#f97316]
        hover:bg-[rgba(249,115,22,0.12)]
        transition-all font-medium">
        Demo: Admin
    </button>

</div>

<form action="{{ route('login') }}" method="POST" class="flex flex-col gap-4 mt-6">
    @csrf
    

    <!-- Email -->
    <div>
        <label class="block text-sm font-medium mb-2">
            Email Address
        </label>

        <input
           
    id="email"
    type="email"
    name="email"
            placeholder="you@example.com"
            class="w-full px-4 py-3 rounded-lg bg-[#0c1424] border border-[#1a2744] text-white outline-none focus:border-[#22d3ee]"
        >
    </div>

    <!-- Password -->
    <div>
        <label class="block text-sm font-medium mb-2">
            Password
        </label>

        <input
            
    id="password"
    type="password"
    name="password"
            placeholder="Enter your password"
            class="w-full px-4 py-3 rounded-lg bg-[#0c1424] border border-[#1a2744] text-white outline-none focus:border-[#22d3ee]"
        >
    </div>

    <!-- Button -->
    <button
        type="submit"
        class="w-full px-4 py-3 rounded-lg bg-[#22d3ee] text-[#080e1a] font-semibold hover:bg-[#06b6d4] transition mt-2"
    >
        Sign In
    </button>

</form>
                

            </div>

        </div>

    </div>

    <script>
    function fillDemo(role) {
        if (role === 'customer') {
            document.getElementById('email').value = 'customer@example.com';
            document.getElementById('password').value = 'pass123';
        } else {
            document.getElementById('email').value = 'admin@donecell.com';
            document.getElementById('password').value = 'admin123';
        }
    }
</script>

</body>
</html>
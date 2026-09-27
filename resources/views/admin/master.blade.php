<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master - DONE CELL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

    <div class="max-w-6xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="flex items-center justify-between pt-4 md:pt-8 mb-8">

            <div>
                <h1 class="text-2xl font-bold text-[#f0f4ff]">
                    Data Master
                </h1>

                <p class="text-sm text-[#8892a4] mt-0.5">
                    Manage phone and repair data
                </p>
            </div>

            <a href="/admin/dashboard"
               class="px-4 py-2 rounded-xl
                      border border-[#1a2744]
                      text-sm text-[#8892a4]
                      hover:text-white
                      hover:border-[#243356]
                      transition">
                ← Dashboard
            </a>

        </div>


        <!-- Data Master -->
        <div class="grid sm:grid-cols-2 gap-4">

            <!-- Brand & Model HP -->
            <a href="/admin/phone-models"
               class="bg-[#0f1729]
                      border border-[#1a2744]
                      rounded-2xl
                      p-6
                      hover:border-orange-500/40
                      transition">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl
                                bg-[rgba(34,211,238,0.1)]
                                text-[#22d3ee]
                                flex items-center justify-center
                                text-xl">
                        📱
                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-[#f0f4ff]">
                            Brand & Model HP
                        </h2>

                        <p class="text-sm text-[#8892a4] mt-1">
                            Kelola brand dan model HP
                        </p>
                    </div>

                </div>

            </a>


            <!-- Damage -->
            <a href="/admin/damages"
               class="bg-[#0f1729]
                      border border-[#1a2744]
                      rounded-2xl
                      p-6
                      hover:border-orange-500/40
                      transition">

                <div class="flex items-center gap-4">

                    <div class="w-12 h-12 rounded-xl
                                bg-[rgba(34,211,238,0.1)]
                                text-[#22d3ee]
                                flex items-center justify-center
                                text-xl">
                        🔧
                    </div>

                    <div>
                        <h2 class="text-base font-semibold text-[#f0f4ff]">
                            Kerusakan
                        </h2>

                        <p class="text-sm text-[#8892a4] mt-1">
                            Kelola data kerusakan
                        </p>
                    </div>

                </div>

            </a>

        </div>

    </div>

</body>

</html>
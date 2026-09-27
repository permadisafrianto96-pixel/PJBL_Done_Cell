<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand & Model HP - DONE CELL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

    <div class="max-w-6xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="flex items-center justify-between pt-4 md:pt-8 mb-8">

            <div>
                <h1 class="text-2xl font-bold text-[#f0f4ff]">
                    Brand & Model HP
                </h1>

                <p class="text-sm text-[#8892a4] mt-1">
                    Kelola brand dan model HP
                </p>
            </div>

            <div class="flex items-center gap-3">

                <a href="/admin/master"
                   class="px-4 py-2 rounded-xl
                          border border-[#1a2744]
                          text-sm text-[#8892a4]
                          hover:text-white
                          hover:border-[#243356]
                          transition">
                    ← Kembali
                </a>

                <a href="/admin/phone-models/create"
                   class="px-4 py-2 rounded-xl
                          bg-[#22d3ee]
                          text-[#080e1a]
                          text-sm font-semibold
                          hover:bg-[#67e8f9]
                          transition">
                    + Tambah
                </a>

            </div>

        </div>


        <!-- Brand & Model -->
        <div class="space-y-4">

            @forelse ($brands as $brand)

                <div class="bg-[#0f1729]
                            border border-[#1a2744]
                            rounded-2xl
                            overflow-hidden">

                    <!-- Brand Header -->
                    <div class="px-6 py-4
                                border-b border-[#1a2744]
                                flex items-center justify-between">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl
                                        bg-orange-500/10
                                        text-orange-400
                                        flex items-center justify-center">
                                🏷️
                            </div>

                            <div>
                                <h2 class="font-semibold text-[#f0f4ff]">
                                    {{ $brand->name }}
                                </h2>

                                <p class="text-xs text-[#8892a4]">
                                    {{ $brand->phoneModels->count() }} model
                                </p>
                            </div>

                        </div>

                    </div>


                    <!-- Models -->
                    <div class="divide-y divide-[#1a2744]">

                        @forelse ($brand->phoneModels as $phoneModel)

                            <div class="px-6 py-4
                                        flex items-center justify-between
                                        hover:bg-[#111c31]
                                        transition">

                                <div class="flex items-center gap-3">

                                    <div class="w-9 h-9 rounded-lg
                                                bg-[rgba(34,211,238,0.08)]
                                                text-[#22d3ee]
                                                flex items-center justify-center">
                                        📱
                                    </div>

                                    <span class="text-sm text-[#dbe4f0]">
                                        {{ $phoneModel->name }}
                                    </span>

                                </div>


                                <div class="flex items-center gap-2">

                                    <a href="/admin/phone-models/{{ $phoneModel->id }}/edit"
                                       class="px-3 py-1.5 rounded-lg
                                              border border-[#1a2744]
                                              text-xs text-[#8892a4]
                                              hover:text-white
                                              hover:border-[#22d3ee]
                                              transition">
                                        Edit
                                    </a>

                                    <form action="/admin/phone-models/{{ $phoneModel->id }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus model ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-1.5 rounded-lg
                                                       border border-red-500/20
                                                       text-xs text-red-400
                                                       hover:bg-red-500/10
                                                       transition">
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @empty

                            <div class="px-6 py-6 text-sm text-[#8892a4]">
                                Belum ada model untuk brand ini.
                            </div>

                        @endforelse

                    </div>

                </div>

            @empty

                <div class="bg-[#0f1729]
                            border border-[#1a2744]
                            rounded-2xl
                            p-8
                            text-center">

                    <p class="text-[#8892a4]">
                        Belum ada data brand dan model HP.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</body>

</html>
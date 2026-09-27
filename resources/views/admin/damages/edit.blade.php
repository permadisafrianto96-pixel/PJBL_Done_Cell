<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Kerusakan - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

    <div class="max-w-2xl mx-auto px-6 py-8">

        <div class="pt-4 md:pt-8 mb-8">

            <h1 class="text-2xl font-bold text-[#f0f4ff]">
                Edit Kerusakan
            </h1>

            <p class="text-sm text-[#8892a4] mt-1">
                Ubah data kerusakan HP
            </p>

        </div>


        <div class="bg-[#0f1729] border border-[#1a2744] rounded-2xl p-6">

            <form action="{{ route('damages.update', $damage->id) }}" method="POST">

                @csrf
                @method('PUT')


                <!-- Kategori Kerusakan -->
                <div class="mb-5">

                    <label class="block text-sm text-[#8892a4] mb-2">
                        Kategori Kerusakan
                    </label>

                    <select
                        name="severity"
                        required
                        class="w-full px-4 py-3 rounded-xl
                               bg-[#080e1a]
                               border border-[#1a2744]
                               text-white
                               focus:outline-none
                               focus:border-blue-500">

                        <option value="light" {{ $damage->severity === 'light' ? 'selected' : '' }}>
                            Kerusakan Ringan
                        </option>

                        <option value="moderate" {{ $damage->severity === 'moderate' ? 'selected' : '' }}>
                            Kerusakan Sedang
                        </option>

                        <option value="heavy" {{ $damage->severity === 'heavy' ? 'selected' : '' }}>
                            Kerusakan Berat
                        </option>

                    </select>

                </div>


                <!-- Nama Kerusakan -->
                <div class="mb-5">

                    <label class="block text-sm text-[#8892a4] mb-2">
                        Nama Kerusakan
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ $damage->name }}"
                        required
                        class="w-full px-4 py-3 rounded-xl
                               bg-[#080e1a]
                               border border-[#1a2744]
                               text-white
                               focus:outline-none
                               focus:border-blue-500">

                </div>


                <!-- Perkiraan Harga -->
                <div class="mb-5">

                    <label class="block text-sm text-[#8892a4] mb-2">
                        Perkiraan Harga
                    </label>

                    <div class="flex items-center gap-3">

                        <input
                            type="number"
                            name="price_min"
                            value="{{ $damage->price_min }}"
                            required
                            class="w-full px-4 py-3 rounded-xl
                                   bg-[#080e1a]
                                   border border-[#1a2744]
                                   text-white
                                   focus:outline-none
                                   focus:border-blue-500">

                        <span class="text-[#8892a4]">
                            -
                        </span>

                        <input
                            type="number"
                            name="price_max"
                            value="{{ $damage->price_max }}"
                            required
                            class="w-full px-4 py-3 rounded-xl
                                   bg-[#080e1a]
                                   border border-[#1a2744]
                                   text-white
                                   focus:outline-none
                                   focus:border-blue-500">

                    </div>

                </div>


                <!-- Estimasi Pengerjaan -->
                <div class="mb-8">

                    <label class="block text-sm text-[#8892a4] mb-2">
                        Estimasi Pengerjaan
                    </label>

                    <div class="flex items-center gap-3">

                        <input
                            type="number"
                            name="estimated_days"
                            value="{{ $damage->estimated_days }}"
                            required
                            min="1"
                            class="w-32 px-4 py-3 rounded-xl
                                   bg-[#080e1a]
                                   border border-[#1a2744]
                                   text-white
                                   focus:outline-none
                                   focus:border-blue-500">

                        <span class="text-sm text-[#8892a4]">
                            hari
                        </span>

                    </div>

                </div>


                <!-- Button -->
                <div class="flex items-center gap-3">

                    <a href="{{ route('damages.index') }}"
                       class="px-5 py-3 rounded-xl
                              border border-[#1a2744]
                              text-sm text-[#8892a4]
                              hover:text-white
                              hover:border-[#243356]
                              transition">
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="px-5 py-3 rounded-xl
                               bg-blue-500
                               text-sm font-semibold
                               text-white
                               hover:bg-blue-600
                               transition">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
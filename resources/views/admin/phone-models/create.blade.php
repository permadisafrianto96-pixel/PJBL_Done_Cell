<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Model HP - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

    <div class="max-w-2xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="pt-4 md:pt-8 mb-8">

            <a href="{{ route('phone-models.index') }}"
               class="text-sm text-[#8892a4] hover:text-white">
                ← Kembali
            </a>

            <h1 class="text-2xl font-bold text-[#f0f4ff] mt-5">
                Tambah Model HP
            </h1>

            <p class="text-sm text-[#8892a4] mt-1">
                Tambahkan model HP baru
            </p>

        </div>

        <!-- Form -->
        <div class="bg-[#0f1729] border border-[#1a2744] rounded-2xl p-6">

            <form action="{{ route('phone-models.store') }}" method="POST">

                @csrf

                <!-- Brand -->
                <div class="mb-5">

                    <label class="block text-sm text-[#8892a4] mb-2">
                        Brand
                    </label>

                    <select name="brand_id"
                            required
                            class="w-full bg-[#080e1a]
                                   border border-[#1a2744]
                                   rounded-xl
                                   px-4 py-3
                                   text-white
                                   outline-none
                                   focus:border-orange-500">

                        <option value="">Pilih Brand</option>

                        @foreach ($brands as $brand)

                            <option value="{{ $brand->id }}">
                                {{ $brand->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Model -->
                <div class="mb-6">

                    <label class="block text-sm text-[#8892a4] mb-2">
                        Nama Model HP
                    </label>

                    <input type="text"
                           name="name"
                           required
                           placeholder="Contoh: Galaxy A15"
                           class="w-full bg-[#080e1a]
                                  border border-[#1a2744]
                                  rounded-xl
                                  px-4 py-3
                                  text-white
                                  placeholder-[#4b5870]
                                  outline-none
                                  focus:border-orange-500">

                </div>

                <!-- Button -->
                <div class="flex items-center gap-3">

                   <button type="submit"
        class="px-5 py-3 rounded-xl
               bg-blue-500
               text-sm font-semibold
               text-white
               hover:bg-blue-600
               transition">
    Simpan
</button>

                    <a href="{{ route('phone-models.index') }}"
                       class="px-5 py-3 rounded-xl
                              border border-[#1a2744]
                              text-sm text-[#8892a4]
                              hover:text-white
                              transition">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>
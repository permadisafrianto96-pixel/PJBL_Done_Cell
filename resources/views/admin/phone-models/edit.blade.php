<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Model HP - DONE CELL</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

<div class="max-w-3xl mx-auto px-6 py-8">

    <div class="mb-8">
        <a href="{{ route('phone-models.index') }}"
           class="text-sm text-[#8892a4] hover:text-white">
            ← Kembali
        </a>

        <h1 class="text-2xl font-bold text-[#f0f4ff] mt-4">
            Edit Model HP
        </h1>

        <p class="text-sm text-[#8892a4] mt-1">
            Ubah data model HP
        </p>
    </div>

    <div class="bg-[#0f1729] border border-[#1a2744] rounded-2xl p-6">

        <form action="{{ route('phone-models.update', $phoneModel->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-sm text-[#8892a4] mb-2">
                    Brand
                </label>

                <select name="brand_id"
                        class="w-full bg-[#080e1a]
                               border border-[#1a2744]
                               rounded-xl px-4 py-3
                               text-white
                               focus:outline-none
                               focus:border-orange-500">

                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ $phoneModel->brand_id == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm text-[#8892a4] mb-2">
                    Nama Model HP
                </label>

                <input type="text"
                       name="name"
                       value="{{ $phoneModel->name }}"
                       required
                       class="w-full bg-[#080e1a]
                              border border-[#1a2744]
                              rounded-xl px-4 py-3
                              text-white
                              focus:outline-none
                              focus:border-orange-500">
            </div>

            <div class="flex gap-3">

                <a href="{{ route('phone-models.index') }}"
                   class="flex-1 text-center
                          bg-[#1a2744]
                          rounded-xl px-4 py-3
                          text-sm
                          hover:bg-[#243356]">
                    Batal
                </a>

                <button type="submit"
                        class="flex-1
                               bg-orange-500
                               rounded-xl px-4 py-3
                               text-sm font-semibold
                               text-white
                               hover:bg-orange-600">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>
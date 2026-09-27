<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerusakan - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#080e1a] text-white">

    <div class="max-w-6xl mx-auto px-6 py-8">

        <!-- Header -->
        <div class="flex items-center justify-between pt-4 md:pt-8 mb-8">

            <div>
                <h1 class="text-2xl font-bold text-[#f0f4ff]">
                    Kerusakan
                </h1>

                <p class="text-sm text-[#8892a4] mt-0.5">
                    Kelola data kerusakan dan estimasi biaya
                </p>
            </div>

            <div class="flex gap-3">

                <a href="/admin/master"
                   class="px-4 py-2 rounded-xl
                          border border-[#1a2744]
                          text-sm text-[#8892a4]
                          hover:text-white
                          hover:border-[#243356]
                          transition">
                    ← Data Master
                </a>

                <a href="{{ route('damages.create') }}"
                   class="px-4 py-2 rounded-xl
                          bg-blue-500
                          text-sm font-semibold
                          text-white
                          hover:bg-blue-600
                          transition">
                    + Tambah Kerusakan
                </a>

            </div>

        </div>

        <!-- Table -->
        <div class="bg-[#0f1729] border border-[#1a2744] rounded-2xl overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="border-b border-[#1a2744]">
                        <tr class="text-left text-sm text-[#8892a4]">

                            <th class="px-6 py-4">
                                No
                            </th>

                            <th class="px-6 py-4">
                                Kerusakan
                            </th>

                            <th class="px-6 py-4">
                                Kategori
                            </th>

                            <th class="px-6 py-4">
                                 Perkiraan Harga
                            </th>

                            <th class="px-6 py-4">
                                Estimasi
                            </th>

                            <th class="px-6 py-4">
                                Aksi
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($damages as $damage)

                            <tr class="border-b border-[#1a2744] last:border-0">

                                <td class="px-6 py-4 text-sm text-[#8892a4]">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-medium text-[#f0f4ff]">
                                    {{ $damage->name }}
                                </td>

                                <td class="px-6 py-4 text-sm text-[#8892a4]">
                                   {{ $damage->severity === 'light' ? 'Kerusakan Ringan' : ($damage->severity === 'moderate' ? 'Kerusakan Sedang' : 'Kerusakan Berat') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-[#8892a4]">
                                Rp {{ number_format($damage->price_min, 0, ',', '.') }}
                                -
                                Rp {{ number_format($damage->price_max, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-[#8892a4]">
                                    {{ $damage->estimated_days ?? '-' }} hari
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">

                                    <a href="{{ route('damages.edit', ['damage' => $damage->id]) }}"
                                       class="text-sm text-blue-400 hover:text-blue-300 mr-3">
                                        Edit
                                    </a>

                                    <form action="{{ route('damages.destroy', ['damage' => $damage->id]) }}"
                                          method="POST"
                                          style="display:inline;">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-sm text-red-400 hover:text-red-300"
                                                onclick="return confirm('Yakin mau hapus data kerusakan ini?')">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                               <td colspan="6"
                                class="px-6 py-10 text-center text-sm text-[#8892a4]">
                                    Belum ada data kerusakan.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>
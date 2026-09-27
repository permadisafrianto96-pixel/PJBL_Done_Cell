<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Request</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-950 text-white min-h-screen">

    <div class="max-w-4xl mx-auto px-6 py-10">

        <a href="/admin/requests"
           class="text-gray-400 hover:text-white">
            ← Kembali ke Requests
        </a>

        <h1 class="text-3xl font-bold mt-6 mb-8">
            Detail Request
        </h1>

        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 space-y-6">

            <div>
                <p class="text-gray-400 text-sm">Request ID</p>
                <p class="text-lg font-semibold">
                    {{ $repairRequest->request_id }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <p class="text-gray-400 text-sm">Nama Customer</p>
                    <p class="font-semibold">
                        {{ $repairRequest->customer_name }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">No. Telepon</p>
                    <p class="font-semibold">
                        {{ $repairRequest->phone ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">Merek</p>
                    <p class="font-semibold">
                        {{ $repairRequest->brand }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">Model</p>
                    <p class="font-semibold">
                        {{ $repairRequest->model }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">Kategori Kerusakan</p>
                    <p class="font-semibold">
                        {{ $repairRequest->category }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-400 text-sm">Nama Kerusakan</p>
                    <p class="font-semibold">
                        {{ $repairRequest->damage_name }}
                    </p>
                </div>

            </div>

            <div>
                <p class="text-gray-400 text-sm">Deskripsi Customer</p>

                <div class="mt-2 bg-gray-950 rounded-xl p-4">
                    {{ $repairRequest->description ?? 'Tidak ada deskripsi.' }}
                </div>
            </div>

            <div>
                <p class="text-gray-400 text-sm">Estimasi Harga</p>

                <p class="text-xl font-bold mt-1">
                    Rp {{ number_format($repairRequest->estimated_price_min, 0, ',', '.') }}
                    -
                    Rp {{ number_format($repairRequest->estimated_price_max, 0, ',', '.') }}
                </p>
            </div>

            <div>
                <p class="text-gray-400 text-sm">Status</p>

                <span class="inline-block mt-2 px-3 py-1 rounded-full bg-yellow-500/20 text-yellow-400">
                    {{ $repairRequest->status }}
                </span>
            </div>

        </div>

    </div>

</body>
</html>
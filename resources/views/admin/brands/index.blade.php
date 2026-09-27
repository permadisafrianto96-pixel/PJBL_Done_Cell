<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Brand</title>
</head>
<body>

    <h1>Data Brand</h1>

    <a href="{{ route('brands.create') }}">+ Tambah Brand</a>

    <br><br>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Nama Brand</th>
            <th>Aksi</th>
        </tr>

        @forelse($brands as $brand)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $brand->name }}</td>
              <td>
    <a href="{{ route('brands.edit', ['brand' => $brand->id]) }}">
        Edit
    </a>

    <form action="{{ route('brands.destroy', ['brand' => $brand->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')

        <button type="submit" onclick="return confirm('Yakin mau hapus brand ini?')">
            Hapus
        </button>
    </form>
</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Belum ada data brand.</td>
            </tr>
        @endforelse

    </table>

</body>
</html>
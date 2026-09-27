<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Brand</title>
</head>
<body>

    <h1>Tambah Brand</h1>

    <form action="{{ route('brands.store') }}" method="POST">
        @csrf

        <label>Nama Brand</label>
        <br>
        <input type="text" name="name" required>

        <br><br>

        <button type="submit">Simpan</button>

        <a href="{{ route('brands.index') }}">Kembali</a>
    </form>

</body>
</html>
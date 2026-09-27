<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Brand</title>
</head>
<body>

    <h1>Edit Brand</h1>

    <form action="{{ route('brands.update', $brand->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Brand</label>
        <br>
        <input type="text" name="name" value="{{ $brand->name }}" required>

        <br><br>

        <button type="submit">Update</button>

        <a href="{{ route('brands.index') }}">Kembali</a>
    </form>

</body>
</html>
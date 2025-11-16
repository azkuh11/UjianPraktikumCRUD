<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Buku</h1>

        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Judul Buku <span class="required">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required>
            </div>

            <div class="form-group">
                <label for="author">Penulis <span class="required">*</span></label>
                <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
            </div>

            <div class="form-group">
                <label for="cover_image">Cover Buku</label>
                @if($book->cover_image)
                    <div class="current-image">
                        <p>Cover saat ini:</p>
                        <img src="{{ asset('storage/covers/' . $book->cover_image) }}" alt="{{ $book->title }}" class="preview-image">
                    </div>
                @endif
                <input type="file" id="cover_image" name="cover_image" accept="image/jpeg,image/png,image/jpg">
                <small class="form-help">Kosongkan jika tidak ingin mengubah cover. Format: JPEG, PNG, JPG. Maksimal 2MB</small>
            </div>

            <div class="form-group">
                <label for="year">Tahun Terbit <span class="required">*</span></label>
                <input type="number" id="year" name="year" value="{{ old('year', $book->year) }}" min="1900" max="{{ date('Y') }}" required>
            </div>

            <div class="form-group">
                <label for="stock">Stok <span class="required">*</span></label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $book->stock) }}" min="0" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>


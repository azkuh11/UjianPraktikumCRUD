<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - {{ $book->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Detail Buku</h1>

        <div class="book-detail">
            <div class="book-detail-cover">
                @if($book->cover_image)
                    <img src="{{ asset('storage/covers/' . $book->cover_image) }}" alt="{{ $book->title }}">
                @else
                    <div class="no-image">
                        <span>Tidak Ada Cover</span>
                    </div>
                @endif
            </div>
            <div class="book-detail-info">
                <h2>{{ $book->title }}</h2>
                <div class="detail-item">
                    <strong>Penulis:</strong>
                    <span>{{ $book->author }}</span>
                </div>
                <div class="detail-item">
                    <strong>Tahun Terbit:</strong>
                    <span>{{ $book->year }}</span>
                </div>
                <div class="detail-item">
                    <strong>Stok:</strong>
                    <span>{{ $book->stock }}</span>
                </div>
                <div class="detail-actions">
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <h1>Daftar Buku</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="actions">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku Baru</a>
        </div>

        @if($books->count() > 0)
            <div class="books-grid">
                @foreach($books as $book)
                    <div class="book-card">
                        @if($book->cover_image)
                            <div class="book-cover">
                                <img src="{{ asset('storage/covers/' . $book->cover_image) }}" alt="{{ $book->title }}">
                            </div>
                        @else
                            <div class="book-cover no-image">
                                <span>Tidak Ada Cover</span>
                            </div>
                        @endif
                        <div class="book-info">
                            <h3>{{ $book->title }}</h3>
                            <p class="author">Penulis: {{ $book->author }}</p>
                            <p class="year">Tahun: {{ $book->year }}</p>
                            <p class="stock">Stok: {{ $book->stock }}</p>
                            <div class="book-actions">
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info">Detail</a>
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>Belum ada buku yang ditambahkan.</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku Pertama</a>
            </div>
        @endif
    </div>
</body>
</html>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-4"><i class="bi bi-book"></i> Daftar Buku</h1>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Buku
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($books->count() > 0)
            <div class="row">
                @foreach($books as $book)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($book->cover_image)
                                <img src="{{ asset('covers/' . $book->cover_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $book->title }}"
                                     style="height: 300px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" 
                                     style="height: 300px;">
                                    <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">
                                    <strong>Penulis:</strong> {{ $book->author }}<br>
                                    <strong>Tahun:</strong> {{ $book->year }}<br>
                                    <strong>Stok:</strong> {{ $book->stock }}
                                </p>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="btn-group w-100" role="group">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="bi bi-info-circle"></i> Belum ada buku. <a href="{{ route('books.create') }}">Tambah buku pertama</a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


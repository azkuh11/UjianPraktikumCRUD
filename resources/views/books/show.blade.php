<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h3 class="mb-0"><i class="bi bi-book"></i> Detail Buku</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-3">
                                @if($book->cover_image)
                                    <img src="{{ asset('covers/' . $book->cover_image) }}" 
                                         class="img-fluid rounded shadow" 
                                         alt="{{ $book->title }}">
                                @else
                                    <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                         style="height: 300px;">
                                        <i class="bi bi-image text-white" style="font-size: 5rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="30%">Judul Buku</th>
                                        <td>{{ $book->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penulis</th>
                                        <td>{{ $book->author }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Terbit</th>
                                        <td>{{ $book->year }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stok</th>
                                        <td>
                                            @if($book->stock > 0)
                                                <span class="badge bg-success">{{ $book->stock }} tersedia</span>
                                            @else
                                                <span class="badge bg-danger">Habis</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ditambahkan</th>
                                        <td>{{ $book->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Diperbarui</th>
                                        <td>{{ $book->updated_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


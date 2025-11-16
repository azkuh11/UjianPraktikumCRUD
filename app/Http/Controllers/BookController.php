<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover_image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::putFileAs('public/covers', $file, $fileName);
            $validated['cover_image'] = $fileName;
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover_image' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('cover_image')) {
            // Hapus file lama jika ada
            if ($book->cover_image && Storage::exists('public/covers/' . $book->cover_image)) {
                Storage::delete('public/covers/' . $book->cover_image);
            }

            // Simpan file baru
            $file = $request->file('cover_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::putFileAs('public/covers', $file, $fileName);
            $validated['cover_image'] = $fileName;
        } else {
            // Jika tidak upload gambar baru, tetap gunakan gambar lama
            $validated['cover_image'] = $book->cover_image;
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        // Hapus file cover_image jika ada
        if ($book->cover_image && Storage::exists('public/covers/' . $book->cover_image)) {
            Storage::delete('public/covers/' . $book->cover_image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}

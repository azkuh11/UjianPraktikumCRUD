<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

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

    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

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

            if ($book->cover_image && Storage::exists('public/covers/' . $book->cover_image)) {
                Storage::delete('public/covers/' . $book->cover_image);
            }

            $file = $request->file('cover_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::putFileAs('public/covers', $file, $fileName);
            $validated['cover_image'] = $fileName;
        } else {
            $validated['cover_image'] = $book->cover_image;
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover_image && Storage::exists('public/covers/' . $book->cover_image)) {
            Storage::delete('public/covers/' . $book->cover_image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}

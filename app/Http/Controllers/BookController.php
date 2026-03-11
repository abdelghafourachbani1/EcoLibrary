<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function booksByCategory($id) {
        $books = Book::where('category_id', $id)->get();
        return response()->json($books);
    }

    public function search(Request $request) {
        $query = $request->q;

        $books = Book::where('title','like','%' . $query . '%')
                    ->orWhereHas('category' , function($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%');
                    })->get();
        
        return response()->json($books);
    }

    public function popular() {
        $books = Book::orderBy('views','desc')->take(3)->get();
        return response()->json($books);
    }

    public function newBooks() {
        $books = Book::orderBy('created_at' , 'desc')->take(10)->get();

        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|in:available,degraded',
            'views' => 'nullable|integer|min:0'
        ]);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'status' => $request->status ?? 'available',
            'views' => $request->views ?? 0
        ]);

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'nullable|in:available,degraded',
            'views' => 'nullable|integer|min:0'
        ]);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'category_id' => $request->category_id,
            'status' => $request->status ?? $book->status,
            'views' => $request->views ?? $book->views
        ]);

        return response()->json([
            'message' => 'Book updated successfully',
            'book' => $book
        ]);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ]);
    }



}

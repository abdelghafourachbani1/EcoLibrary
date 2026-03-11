<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function mostViewed() {
        $books = Book::orderBy('views','desc')->take(5)->get();
        return response()->json($books);
    }

    public function degradedBooks() {
        $count = Book::where('status','degraded')->count();
        return response()->json([
            'degraded_books' => $count
        ]);
    }

    public function collectionStats()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('status','available')->count();
        $degradedBooks = Book::where('status','degraded')->count();

        return response()->json([
            'total_books' => $totalBooks,
            'available_books' => $availableBooks,
            'degraded_books' => $degradedBooks
        ]);
    }
}

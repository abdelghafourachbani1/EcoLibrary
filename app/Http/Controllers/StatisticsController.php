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
}

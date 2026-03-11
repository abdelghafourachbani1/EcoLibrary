<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
 
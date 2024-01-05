<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        //$books = Book::all();
        $books = Book::with('category')->get();
        return response()->json($books);
    }

    public function show($id) {
        $book = Book::with('category')->find($id);
        if ($book == null) {
            return response()->json(['message' => 'No book found'], 404);
        }
        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json('', 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
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

    public function store(BookStoreRequest $request)
    {
        $request->validated($request->all());
        $book = Book::create($request->only(["title", "year", "pages", "ISBN", "category_id"]));
        return response()->json($book, 201);
    }

    public function update(BookUpdateRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validated($request->all());

        $book->update($request->only(["title", "year", "pages", "ISBN", "category_id"]));
        return response()->json($book, 200);
    }
}

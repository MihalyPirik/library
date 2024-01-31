<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        //$books = Book::all();
        //$books = Book::with('category')->get();
        $books = BookResource::collection(Book::all());
        return $books;
    }

    public function show($id) {
        // $book = Book::where('id','=',$id)->get();
        $book = Book::with('category')->find($id);
        if ($book == null) {
            return response()->json(['message' => 'No book found'], 404);
        }
        return new BookResource($book);
        //return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json('', 204);
    }

    public function store(BookStoreRequest $request)
    {
        //$request->validated($request->all());
        $book = Book::create($request->only(["title", "year", "pages", "ISBN", "category_id"]));
        return response(new BookResource($book), 201);
        //return response()->json($book, 201);
    }

    public function update(BookUpdateRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validated($request->all());

        $book->update($request->only(["title", "year", "pages", "ISBN", "category_id"]));
        return new BookResource($book);
        //return response()->json($book, 200);
    }

    public function showByTitle($title)
    {
        $books = Book::where('title', 'like', '%'.$title.'%')->get();
        if (count($books) == 0)
            return response()->json(['message' => 'No book found.'], 404);
        return response()->json($books);
    }

    public function readersOfBook($id)
    {
        $book = Book::find($id);
        if ($book == null)
            return response()->json(['message' => 'No book found.'], 404);
        return response()->json($book->readers);
    }
}

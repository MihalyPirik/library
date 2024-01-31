<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReaderRequest;
use App\Http\Requests\UpdateReaderRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\ReaderResource;
use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReaderResource::collection(Reader::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validated();

        $reader = Reader::create($request->only(['name', 'email', 'password', 'address', 'phone']));

        return response(['data' => new ReaderResource($reader)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reader $reader)
    {
        return new ReaderResource($reader);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reader $reader)
    {
        $request->validated();

        $reader->update($request->only(['name', 'email', 'password', 'address', 'phone']));

        return new ReaderResource($reader);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reader $reader)
    {
        $reader->delete();
        return response()->noContent();
    }

    public function booksOfReader(Reader $reader)
    {
        return BookResource::collection($reader->books);
    }
}

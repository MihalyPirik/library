<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReaderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::delete('books/{id}', [BookController::class, 'destroy']);
Route::post('books', [BookController::class,'store']);
Route::put('books/{id}', [BookController::class, 'update']);
Route::patch('books/{id}', [BookController::class, 'update']);

Route::get('books/search/{title}', [BookController::class, 'showByTitle']);
Route::get('books/{id}/readers', [BookController::class,'readersOfBook']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{id}', [CategoryController::class, 'show']);
Route::post('categories', [CategoryController::class,'store']);
Route::put('categories/{id}', [CategoryController::class, 'update']);
Route::patch('categories/{id}', [CategoryController::class, 'update']);
Route::delete('categories/{id}', [CategoryController::class, 'destroy']);

Route::get('categories/{id}/books', [CategoryController::class, 'booksOfcategory']);

Route::apiResource('authors', AuthorController::class);

Route::apiResource('readers', ReaderController::class);
Route::get('readers/{reader}/books', [ReaderController::class, 'booksOfReader']);
<?php

use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\ProductController;
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

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');

Route::get('/items', [ProductController::class, 'index'])->name('products.index');
Route::get('/items/{product}/description', [ProductController::class, 'show'])->name('products.index');

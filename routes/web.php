<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/',[App\Http\Controllers\ProductInfosController::class,'prodInfos'])->name('prod');

Route::get('specificProduct',[App\Http\Controllers\productInfosController::class,'specificProduct'])->name('specificProduct');
Route::get('specificProdDetails/{id}', [App\Http\Controllers\productInfosController::class, 'specificProdDetails'])->name('specificProdDetails');
Route::get('delete/{id}', [App\Http\Controllers\productInfosController::class, 'delete'])->name('delete');


Route::post('saveArticle',[App\Http\Controllers\ScraperController::class,'saveArticle'])->name('saveArticle');
Route::post('search',[App\Http\Controllers\ScraperController::class,'search'])->name('search');

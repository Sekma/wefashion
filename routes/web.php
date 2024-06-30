<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;



//******* partie admin ***************

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Route ('admin', 'back.welcome'
Route::get('/admin', function () {
    $categories = Category::pluck('name', 'id')->all(); 
    return view('back.welcome', ['categories' => $categories]);
})->middleware(['auth', 'verified'])->name('admin');

// partie admin - produits
Route::resource('admin/clothes', ClothesController::class)->middleware('auth');

// partie admin - catégories
Route::resource('admin/categories', CategoryController::class)->middleware('auth');

//******** partie public **********************

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('article/{id}', [FrontController::class, 'show'])->where(['id' => '[0-9]+'])->name('article');
Route::get('category/{id}', [FrontController::class, 'showClothesByCategory'])->where(['id' => '[0-9]+'])->name('category');
Route::get('sale', [FrontController::class, 'showClothesByStatus'])->where(['id' => '[0-9]+'])->name('sale');
Route::view('front.show', 'front.buy')->name('success');


require __DIR__.'/auth.php';




//Route::get('admin', [ClothesController::class, 'index'])->middleware('auth');
//Route::get('admin/article/{id}', [ClothesController::class, 'show'])->middleware('auth')->name('clothes.show');
//Route::get('admin/article/{id}/edit', [ClothesController::class, 'edit'])->middleware('auth')->name('clothes.edit');
//Route::get('admin/article/{id}/update', [ClothesController::class, 'update'])->middleware('auth')->name('clothes.update');
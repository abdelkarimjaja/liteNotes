<?php

use App\Http\Controllers\LiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrashedNoteController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/notes', );

// Route::get('notes/{note}', )

Route::resource('/notes', LiteController::class)->middleware(['auth']);

// Route::get('/trashed', [TrashedNoteController::class, 'index'])
//     ->middleware(['auth'])
//     ->name('trashed.index');

// Route::get('/trashed/{note}', [TrashedNoteController::class, 'show'])
//         ->withTrashed()
//         ->middleware(['auth'])->name('trashed.show');

// Route::put('/trashed/{note}', [TrashedNoteController::class, 'update'])
//         ->withTrashed()
//         ->withTrashed()
//         ->middleware(['auth'])->name('trashed.update');

// Route::delete('/trashed/{note}', [TrashedNoteController::class, 'destory'])
//     ->withTrashed()
//     ->withTrashed()
//     ->middleware(['auth'])->name('trashed.destory');

// route()
Route::prefix('/trashed')->name('trashed.') ->middleware(['auth'])->group(function(){
    Route::get('/trashed', [TrashedNoteController::class, 'index'])->name('index');
    Route::get('/{note}', [TrashedNoteController::class, 'show'])->name('show')->withTrashed();
    Route::put('/{note}', [TrashNoteController::class, 'update'])->name('update')->withTrashed();
    Route::delete('/{note}', [TrashedNoteController::class, 'destory'])->name('destory')->withTrashed();




});


require __DIR__.'/auth.php';

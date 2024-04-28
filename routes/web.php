<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Models\Character;
use App\Http\Controllers\ContestController;
use App\Models\Contest;

Route::resource('characters', CharacterController::class);
Route::resource('contests', ContestController::class);
//Route::get('/contests/{id}/edit', [ContestController::class, 'edit']);

Route::get('/', function () {
    return redirect()->route('characters.index');
});

Route::get('/list', function () {
    return view('characters.list',['userCharacters' => Character::where('owner_id', Auth::user()->id)->get()]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/details/{id}/', [CharacterController::class, 'details'])->name('details');

// Route::get('/details/{id}', function () {
//     return view('characters.details',['id'->$id]);
// })->middleware(['auth', 'verified'])->name('details');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

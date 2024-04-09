<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LiveChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TalksController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[WebsiteController::class,'homepage']);
Route::get('/talks',[WebsiteController::class,'talks']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','role:admin'])->name('dashboard');
Route::prefix('admin')->middleware(['auth', 'verified','role:admin'])->group(function () {
    Route::resource('categories',CategoriesController::class);
    Route::resource('talks',TalksController::class);
});

Route::middleware(['auth','role:user'])->group(function () {
   Route::post('createOrder',[PaymentController::class,'createOrder']);
   Route::post('verifyOrder',[PaymentController::class,'verifyOrder']);
   Route::get('purchases',[WebsiteController::class,'purchasesPage']);
   Route::get('/talk/chat/{talk_id}',[WebsiteController::class,'conversationPage']);
   Route::get('realTimeChat',[LiveChatController::class,'realTimeChat']);
   Route::post('pusher/auth',[LiveChatController::class,'authUser']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

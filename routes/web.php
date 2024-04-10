<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LiveChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TalksController;
use App\Http\Controllers\WebhookController;
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
   Route::post('createOrderMin',[PaymentController::class,'createOrderMin']);
   Route::post('verifyOrder',[PaymentController::class,'verifyOrder']);
   Route::post('verifyOrderMin',[PaymentController::class,'verifyOrderMin']);
   Route::get('purchases',[WebsiteController::class,'purchasesPage']);
   Route::get('/talk/chat/{talk_id}',[WebsiteController::class,'conversationPage']);
   Route::get('realTimeChat',[LiveChatController::class,'realTimeChat']);
});
Route::middleware(['auth','role:expert','verified'])->group(function () {
    Route::get('/expert/liveChat',[LiveChatController::class,'expertLiveChat']);
 });

 Route::middleware(['auth','role:expert|user','verified'])->group(function () {
    Route::post('pusher/auth',[LiveChatController::class,'authUser']);
 });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('webhook/present',[WebhookController::class,'mark_online']);
Route::post('webhook/absent',[WebhookController::class,'mark_offline']);

require __DIR__.'/auth.php';

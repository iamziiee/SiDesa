<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Route::get('/', [AuthController::class, 'login']);
Route::get('/', [AuthController::class, 'login'])->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'registerView'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'role:Admin,User']);


// Route::get('/resident', [ResidentController::class, 'index'])->middleware('role:Admin');
// Route::get('/resident/create', [ResidentController::class, 'create'])->middleware('role:Admin');
// Route::get('/resident/{id}', [ResidentController::class, 'edit'])->middleware('role:Admin');
// Route::post('/resident', [ResidentController::class, 'store'])->middleware('role:Admin');
// Route::put('/resident/{id}', [ResidentController::class, 'update'])->middleware('role:Admin');
// Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->name('resident.destroy')->middleware('role:Admin');
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/resident', [ResidentController::class, 'index']);
    Route::get('/resident/create', [ResidentController::class, 'create']);
    Route::get('/resident/{id}', [ResidentController::class, 'edit']);
    Route::post('/resident', [ResidentController::class, 'store']);
    Route::put('/resident/{id}', [ResidentController::class, 'update']);
    Route::delete('/resident/{id}', [ResidentController::class, 'destroy'])->name('resident.destroy');
    Route::get('/account-request', [UserController::class, 'index']);
    Route::post('/account-request/approval/{id}', [UserController::class, 'account_approval']);
});

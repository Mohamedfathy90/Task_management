<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard',[TaskController::class, 'index'] )->name('dashboard');
    Route::get('/task/progress/{task}',[TaskController::class, 'progress_task'] );
    Route::get('/task/pending/{task}',[TaskController::class, 'pending_view'] );
    Route::post('/task/pending/{task}',[TaskController::class, 'pending_task'] );
    Route::get('/task/complete/{task}',[TaskController::class, 'complete_view'] );
    Route::post('/task/complete/{task}',[TaskController::class, 'complete_task'] );
    Route::get('/task/assign/{task}',[TaskController::class, 'assign'] );
    Route::post('/task/assign/{task}',[TaskController::class, 'assign_task'] );
    Route::get('/task/issued',[TaskController::class, 'issued_tasks'] )->name('issued');
    Route::get('/task/add',[TaskController::class, 'add_task'] );
    Route::post('/task/add',[TaskController::class, 'issue_task'] );
    Route::get('/task/get_data',[TaskController::class, 'get_task_data'] )->name('autocomplete');
    Route::post('/task/description',[TaskController::class, 'get_equip_desc'] );
    Route::get('/equipment_status',[TaskController::class, 'equip_status_index'] )->name('status');
    Route::post('/get_equip_status',[TaskController::class, 'get_equip_status'] );
    Route::get('/show_equip_status/{equipment:tag}',[TaskController::class, 'show_equip_status'] );
    Route::get('/transaction_details/{transaction_id}',[TaskController::class, 'show_transaction_details']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

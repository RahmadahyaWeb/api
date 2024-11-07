<?php

use App\Http\Controllers\SyncController;
use App\Models\Sync;
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
    echo "rahmad is here";
});

Route::get('/sync', [SyncController::class, 'sync'])->name('sync');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentController;

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

Route::prefix('admin')->group(function () {
    Route::get('/incidents',        [IncidentController::class, 'index'])->name('incidents.index'); 
    Route::get('/incidents/create', [IncidentController::class, 'create'])->name('incidents.create'); 
    Route::post('/incidents/store', [IncidentController::class, 'store'])->name('incidents.store'); 
    Route::get('/incidents/{id}',   [IncidentController::class, 'show'])->name('incidents.show'); 
});


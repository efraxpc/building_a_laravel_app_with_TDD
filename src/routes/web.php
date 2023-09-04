<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentController;
use Illuminate\Http\Request;

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

Route::get('/', function (Request $request) {
    return redirect()->route('incidents.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/incidents',        [IncidentController::class, 'index'])->name('incidents.index'); 
    Route::get('/incidents/create', [IncidentController::class, 'create'])->name('incidents.create'); 
    Route::post('/incidents/store', [IncidentController::class, 'store'])->name('incidents.store'); 
    Route::get('/incidents/{id}',   [IncidentController::class, 'show'])->name('incidents.show'); 
    Route::get('/incidents/destroy/{id}', [IncidentController::class, 'destroy'])->name('incidents.destroy'); 
    Route::post('/incidents/update', [IncidentController::class, 'update'])->name('incidents.update'); 
});


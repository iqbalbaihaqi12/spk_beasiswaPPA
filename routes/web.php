<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\KriteriaController;
use App\Http\Controller\AlternatifController;

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

// Route::get('/',function(){
//     return view('login');
// });

Auth::routes();

 
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('kriteria',App\Http\Controllers\KriteriaController::class)->except(['create']);
Route::resource('alternatif',App\Http\Controllers\AlternatifController::class)->except(['create','show']);
Route::resource('crips',App\Http\Controllers\CripsController::class)->except(['index','create','show']);
Route::resource('penilaian',App\Http\Controllers\PenilaianController::class);
Route::get('/perangkingan', [App\Http\Controllers\AlgoritmaController::class, 'index'])->name('perangkingan.index');



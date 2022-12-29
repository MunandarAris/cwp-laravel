<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth24Controller;
// use App\Http\Controllers\Admin24Controller;
// use App\Http\Controllers\Agama24Controller;
// use App\Http\Controllers\DetailData24Controller;
use App\Http\Controllers\Client\Auth24Controller;
use App\Http\Controllers\Client\Admin24Controller;
use App\Http\Controllers\Client\Agama24Controller;
use App\Http\Controllers\Client\DetailData24Controller;

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



//home
Route::get('/', [Auth24Controller::class, 'index24']);
Route::get('/24', [Auth24Controller::class, 'index24']);

// //auth
Route::get('/register24', [Auth24Controller::class, 'create24']);
Route::post('/register24', [Auth24Controller::class, 'store24']);
Route::get('/login24', [Auth24Controller::class, 'index24']);
Route::post('/login24', [Auth24Controller::class, 'show24']);
Route::get('/profile24', [Auth24Controller::class, 'edit24']);
Route::get('/image24', [Auth24Controller::class, 'editImage24']);
Route::post('/image24', [Auth24Controller::class, 'updateImage24']);
Route::get('/password24', [Auth24Controller::class, 'editPassword24']);
Route::post('/password24', [Auth24Controller::class, 'updatePassword24']);
Route::get('/logout24', [Auth24Controller::class, 'destroy24']);

//agama
Route::get('/agama24', [Agama24Controller::class, 'index24']);
Route::get('/agama24/create', [Agama24Controller::class, 'create24']);
Route::post('/agama24', [Agama24Controller::class, 'store24']);
Route::get('/agama24/{id}/edit', [Agama24Controller::class, 'edit24']);
Route::post('/agama24/{id}', [Agama24Controller::class, 'update24']);
Route::post('/agama24/{id}/delete', [Agama24Controller::class, 'destroy24']);

// //detail_data
Route::get('/detail24', [DetailData24Controller::class, 'index24']);
Route::get('/detail24/create', [DetailData24Controller::class, 'create24']);
Route::post('/detail24', [DetailData24Controller::class, 'store24']);
Route::get('/detail24/{id}', [DetailData24Controller::class, 'edit24']);
Route::post('/detail24/{id}', [DetailData24Controller::class, 'update24']);
Route::post('/detail24/{id}/delete', [DetailData24Controller::class, 'destroy24']);

// //admin
Route::get('/approval24', [Admin24Controller::class, 'indexApproval24']);
Route::post('/approval24', [Admin24Controller::class, 'store24']);
Route::get('/details24', [Admin24Controller::class, 'index24']);
Route::get('/details24/{id}', [Admin24Controller::class, 'show24']);
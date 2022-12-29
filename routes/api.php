<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Auth24Controller;
use App\Http\Controllers\api\Admin24Controller;
use App\Http\Controllers\api\Agama24Controller;
use App\Http\Controllers\api\DetailData24Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register24', [Auth24Controller::class, 'store24']);
Route::post('/password24', [Auth24Controller::class, 'updatePassword24']);
Route::post('/image24', [Auth24Controller::class, 'updateImage24']);

Route::get('/agama24', [Agama24Controller::class, 'index24']);
Route::post('/agama24', [Agama24Controller::class, 'store24']);
Route::get('/agama24/{id}', [Agama24Controller::class, 'show24']);
Route::put('/agama24/{id}', [Agama24Controller::class, 'update24']);
Route::delete('/agama24/{id}', [Agama24Controller::class, 'destroy24']);

Route::get('/detail24/{id}', [DetailData24Controller::class, 'index24']);
Route::post('/detail24', [DetailData24Controller::class, 'store24']);
Route::get('/detail24/{id}/show', [DetailData24Controller::class, 'show24']);
Route::post('/detail24/{id}/edit', [DetailData24Controller::class, 'update24']);
Route::delete('/detail24/{id}', [DetailData24Controller::class, 'destroy24']);

Route::get('/approval24', [Admin24Controller::class, 'indexApproval24']);
Route::post('/approval24', [Admin24Controller::class, 'store24']);
Route::get('/details24', [Admin24Controller::class, 'index24']);
Route::get('/details24/{id}', [Admin24Controller::class, 'show24']);

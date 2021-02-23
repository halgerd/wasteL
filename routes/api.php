<?php

use App\Http\Controllers\Api\BreweriesController;
use Illuminate\Support\Facades\Route;

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

Route::get('breweries', [BreweriesController::class, 'index']);
Route::get('breweries/{breweryId}', [BreweriesController::class, 'show'])
    ->where('breweryId', '[0-9]+');

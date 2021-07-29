<?php

use Illuminate\Support\Facades\Route;

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

Route::post('/webhook/endconversation', [\App\Http\Controllers\WebhookController::class, 'createEntriesCrm']);

Route::post('/messages', [\App\Http\Controllers\MessagesController::class, 'sendMessages']);
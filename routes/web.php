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

Route::get('telegram', 'TelegramController@telegram');
Route::post('/516823442:AAHGu7Ob-0SrThiwYkzf11phgHtWUC8Z35Q/webhook', 'TelegramController@webhook');

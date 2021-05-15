<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout');

Route::post('/cadastro', 'App\Http\Controllers\AuthController@register');

Route::group(['middleware' => ['api', 'auth']], function () {
    Route::group(['prefix' => '/user'], function () {
        Route::get('/', 'App\Http\Controllers\UserController@getUser');

        Route::group(['prefix' => '/cartoes'], function () {
            Route::get('/', 'App\Http\Controllers\CartaoController@getCartoes');
            Route::get('/bandeiras', 'App\Http\Controllers\CartaoController@getBandeiras');
            Route::post('/cadastro', 'App\Http\Controllers\CartaoController@criar');
        });

        Route::group(['prefix' => '/faturas'], function () {
            Route::get('/', 'App\Http\Controllers\FaturaController@getFaturas');
            Route::post('/', 'App\Http\Controllers\FaturaController@simular');
            Route::put('/pagar', 'App\Http\Controllers\FaturaController@pagar');
        });
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/funcionarios', 'App\Http\Controllers\UserController@getFuncionarios');
    });

    Route::group(['prefix' => 'funcionario'], function () {
        Route::get('/usuarios', 'App\Http\Controllers\UserController@getUsers');
        Route::get('/pedidos', 'App\Http\Controllers\CartaoController@getPendentes');
        Route::put('/cartao', 'App\Http\Controllers\CartaoController@update');
        Route::put('/user', 'App\Http\Controllers\UserController@update');
    });
});


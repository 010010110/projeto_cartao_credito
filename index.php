<?php
require 'vendor/autoload.php';

use Middleware\Auth\UserAuth;
use Middleware\Auth\AdminAuth;
use Middleware\Auth\FuncionarioAuth;
use Pecee\SimpleRouter\SimpleRouter as Router;

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 0');
}

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

Router::post('/login', 'UserController@login');
Router::post('/logout', 'UserController@logout');
Router::post('/cadastro', 'UserController@cadastro');

Router::group(['prefix' => '/user', 'middleware' => UserAuth::class], function () {
    Router::get('/', 'UserController@getData');
    Router::post('/', 'UserController@update');

    Router::group(['prefix' => '/faturas'], function () {
        Router::get('/', 'UserController@getFaturas');
        Router::post('/', 'UserController@simularCompra');
        Router::post('/pagar', 'UserController@pagarFatura');
    });

    Router::group(['prefix' => '/cartoes'], function () {
        Router::get('/', 'UserController@getCartoes');
        Router::post('/', 'UserController@updateCartao');
        Router::get('/bandeiras', 'UserController@getBandeiras');
        Router::post('/cadastro', 'UserController@cadastrarCartao');
    });
});

Router::group(['prefix' => '/admin', 'middleware' => AdminAuth::class], function () {
    Router::get('/funcionarios', 'AdminController@getFuncionarios');
});

Router::group(['prefix' => '/funcionario', 'middleware' => FuncionarioAuth::class], function () {
    Router::get('/usuarios', 'FuncionarioController@getUsuarios');
    Router::get('/pedidos', 'FuncionarioController@getCartoes');
    Router::post('/user', 'FuncionarioController@updateUser');
    Router::post('/cartao', 'FuncionarioController@updateCartao');
});

Router::start();
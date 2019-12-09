<?php

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
//rutas de prueba

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ApiAuthMiddleware;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prueba/{nombre?}', function ($nombre = 'Frederick') {
    $texto = '<h2>Texto desde una ruta</h2>';
    $texto .= 'Nombre: ' . $nombre;
    return view('pruebas', array(
        'texto' => $texto
    ));
});
Route::get('/animales', 'PruebasController@index');
Route::get('/test-orm', 'PruebasController@testOrm');

//rutas del API

/**
 * Metodo http para una API REST FULL
 * GET : obtener data
 * POST: guardar data
 * PUT: actualizar data
 * DELETE: eliminar data
 */

//rutas de prueba
//Route::get('/usuario/pruebas', 'UserController@pruebas');
//Route::get('/categoria/pruebas', 'CategoryController@pruebas');
//Route::get('/entrada/pruebas', 'PostController@pruebas');

//rutas del controlador de usuarios
Route::post('/api/register', 'UserController@register');
Route::post('/api/login', 'UserController@login');
Route::put('/api/user/update', 'UserController@update')->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::post('/api/user/upload', 'UserController@upload')->middleware(\App\Http\Middleware\ApiAuthMiddleware::class);
Route::get('/api/user/avatar/{filename}', 'UserController@getImage');
Route::get('/api/user/detail/{id}', 'UserController@detail');

//rutas del controlador de categorias
Route::resource('/api/category', 'CategoryController');

//rutas del controllador de posts
Route::resource('/api/post', 'PostController');
Route::post('/api/post/upload', 'PostController@upload');
Route::get('/api/post/image/{filename}', 'PostController@getImage');
Route::get('/api/post/category/{id}', 'PostController@getPostByCategory');
Route::get('/api/post/user/{id}', 'PostController@getPostByUser');

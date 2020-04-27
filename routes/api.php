<?php

use Illuminate\Http\Request;
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


Route::get('/projetos', 'Api\WordpressController@projetos');
Route::get('/categorias', 'Api\WordpressController@categorias');
Route::get('/projetosPorCategoria/{categoriaid}', 'Api\WordpressController@projetosPorCategoria');
Route::get('/projeto/{id}', 'Api\WordpressController@projetoPorId');
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvidprojetosPorCategoriaer within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/synchronize', 'Api\SynchronizeController@index');

Route::get('/buscaPorProjetos', 'Api\WordpressController@buscaPorProjetos');
Route::get('/projetosPorCategoria/{categoriaid}', 'Api\WordpressController@projetosPorCategoria');
Route::get('/projeto/{id}', 'Api\WordpressController@projetoPorId');
Route::get('/categoriasArquitetura', 'Api\WordpressController@categoriasArquitetura');
Route::post('/feedback', 'Api\FeedbackController@enviarEmail');

Route::get('/delay-textit/{segundos?}', function($segundos = 1) {
    sleep($segundos);
});


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

Auth::routes();

Route::get('/modulos','dashboard\ModulosController@modulos');
Route::get('/modulosapi','dashboard\ModulosController@listado');
Route::post('/modulos/create','dashboard\ModulosController@store');
Route::put('/modulos/update/{id}','dashboard\ModulosController@update');
Route::delete('/modulos/delete/{id}','dashboard\ModulosController@delete');

Route::get('/submodulos/{id}','dashboard\SubmodulosController@temas');
Route::get('/submodulos/despachador/{id}','dashboard\SubmodulosController@despachador');
Route::post('/submodulos/create/{id}','dashboard\SubmodulosController@store');
Route::put('/submodulos/update/{id_modulo}/{id_submodulo}','dashboard\SubmodulosController@update');
Route::delete('/submodulos/delete/{id}','dashboard\SubmodulosController@delete');
//Route::get('/home', 'HomeController@index')->name('home');

Route::post('/temas/create/{id}','dashboard\TemasController@store');
Route::get('/temas/{id}/modulo/{id_modulo}','dashboard\TemasController@index');
Route::get('/temas/despachador/{id}','dashboard\TemasController@despachador');
Route::put('/temas/update/{id_submodulo}/{id_tema}','dashboard\TemasController@update');
Route::delete('/temas/delete/{id}','dashboard\TemasController@delete');

Route::post('/subtemas/create/{id}','dashboard\SubtemasController@store');
Route::put('/subtemas/update/{id_tema}/{id_subtema}','dashboard\SubtemasController@update');
Route::delete('/subtemas/delete/{id}','dashboard\SubtemasController@delete');
Route::post('/subtemas/create_apunte/{id}','dashboard\SubtemasController@create_apunte');
Route::put('/subtemas/update_apunte/{id_subtema}/{id_apunte}','dashboard\SubtemasController@update_apunte');
Route::delete('/subtemas/delete_apunte/{id}','dashboard\SubtemasController@delete_apunte');


Route::post('/elementos/create/{id}','dashboard\ElementosController@store');

Route::post('/bibliografias/create/{id_b}','dashboard\BibliografiasController@store');
Route::post('/bibliografias/update/{id_b}','dashboard\BibliografiasController@update');
Route::delete('/bibliografias/delete/{id_tema}/{id_b}','dashboard\BibliografiasController@delete');

Route::get('/memo', function () {
    //$subtema = App\Subtema::findOrFail(6);
    //$subtema->apuntes()->create(['apunte' => 'memo']);
    
    $elemento = App\Elemento::findOrFail(3);
    $elemento->apuntes()->create(['apunte'=>'esto es un apunte 2']);
    return $elemento;
});

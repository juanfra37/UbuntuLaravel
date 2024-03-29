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

Route::get('/', function () {
    return view('welcome');    
});

Route::get('/greeting', function()
{
    return view('greeting', ['name' => 'Hola mundo!']);
});

Route::get('/departamento', function () {
    return view('departamento');    
});


Route::get('/marcacionIngreso', function () {
    return view('marcacionIngreso');    
});

Route::get('/marcacionSalida', function () {
    return view('marcacionSalida');    
});

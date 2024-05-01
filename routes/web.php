<?php

use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)->name('home');

Route::controller(UserController::class)->group(function(){
    Route::get('/ingresar', 'loginPage')->name('login')->middleware('guest');
    Route::post('/iniciar-sesion','login')->name('iniciar-sesion')->middleware('guest');
    Route::get('/registrarse', 'registerPage')->name('signup')->middleware('guest');
    Route::post('/validar-registro', 'register')->name('register')->middleware('guest');
    Route::post('/cerrar-sesion', 'logout')->name('cerrar-sesion')->middleware('auth');
});

Route::controller(LibrosController::class)->group(function(){
    Route::get('/registro', 'index')->name('libros.index');
    Route::get('/registro/agregar', 'create')->name('libros.create')->middleware('auth');
    Route::post('registro', 'agregar')->name('libros.agregar')->middleware('auth');
    Route::get('/registro/{id}/eliminar', 'eliminarLibro')->name('libros.eliminar')->middleware('auth');
    Route::post('/registro/{id}/estado', 'cambiarEstado')->name('libros.estado')->middleware('auth');
    Route::get('/registro/editar/{libro}', 'editarPage')->name('libros.editarPage');
    Route::post('/regisrto/editar/{id}', 'editar')->name('libros.editar')->middleware('auth');
});

Route::get('/crear-captcha', [CaptchaController::class, 'create'])->name('captcha.create');
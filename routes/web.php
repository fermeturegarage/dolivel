<?php

use Illuminate\Support\Facades\Route;
use Fermeturegarage\Dolivel\Http\Controllers\TestController;

Route::middleware(['web'])->group(function () {

	Route::get('/hi', [TestController::class, 'hello']);

	Route::get('/cart', [TestController::class, 'cart']);

	Route::get('/session/add', function () {
		session()->put('test', 123);
		session()->save();
	});

	Route::get('/session/view', function () {
		return session()->get('test');
	});

	Route::get('/', function () {
		return session()->get("test");
		return view('welcome');
	});

});

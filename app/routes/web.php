<?php

namespace App\Library;

/**
 * Web Routes
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Router\Route;

Route::make('home.index')->url('/')->controller('HomeController')->method('index')->register();
Route::make('product.edit')->url('/products/edit')->controller('ProductController')->method('edit')->register();
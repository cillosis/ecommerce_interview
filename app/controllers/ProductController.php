<?php

namespace App\Controllers;

/**
 * Home Controller
 * 
 * Main index page.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Controller\Controller;
use App\Library\Response\HttpResponse;
use App\Library\View\View;
use App\Models\Product;

class ProductController extends Controller
{
	public function edit()
	{
		$itemId = $this->request()->get('item');
		dd($itemId);
		// // Get all products
		// $products = Product::all();

		// return View::make('home.index', [
		// 	'products' => $products
		// ]);

	}
}
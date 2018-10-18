<?php

namespace App\Library\Response;

/**
 * Base Response Interface
 * 
 * Defines a base response handler that can be extended to
 * create HTML, JSON, etc. as output.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Request\Request;
use App\Library\View\View;

interface ResponseInterface
{
	public function __construct(Request $request, View $view);

	public function render();
}
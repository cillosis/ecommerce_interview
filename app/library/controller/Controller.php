<?php

namespace App\Library\Controller;

/**
 * Base Controller
 * 
 * Defines a base controller implementation for application
 * controllers to extend. Provides common functionality and
 * enforces a specific 
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use Exception;
use App\Library\Request\Request;
use App\Library\Router\Route;

class Controller
{
	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function request()
	{
		return $this->request;
	}
}
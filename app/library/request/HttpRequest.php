<?php

namespace App\Library\Request;

/**
 * Http Request
 * 
 * Defines a request handler for HTTP requests.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Router\Route;

class HttpRequest extends Request
{
	/**
	 * Initialize request
	 */
	public function __construct($args = [])
	{
		parent::__construct($args);
	}

	/**
	 * Determine if Request matches Route
	 * 
	 * @param Route 
	 * @return bool
	 */
	public function matches(Route $route) 
	{
		// Grab HTTP request URI
		$requestUri = $this->server('REQUEST_URI');

		// If it has query string parameters, cut off end
		if (stristr($requestUri, '?')) {
			$requestUri = substr($this->server('REQUEST_URI'), 0, stripos($requestUri, '?'));	
		}
		
		$requestUri = trim($requestUri, '/');
		$route->url = trim($route->url, '/');

		// Exact match
		if ($requestUri == $route->url) {
			return true;
		}

		return false;
	}
}
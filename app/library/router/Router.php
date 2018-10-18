<?php

namespace App\Library\Router;

/**
 * Base Router
 * 
 * Defines a base router that can be used as-is or extended
 * for more specific request routing.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use Exception;
use App\Library\Request\Request;
use App\Library\Router\Route;

class Router {

	/**
	 * Registered routes
	 * 
	 * @var array
	 */
	private $_routes = [];

	/**
	 * Dispatch the current Request
	 * 
	 * @param Request 		Current request
	 * @return Response
	 */
	public function __construct(Request $request) 
	{
		$this->request = $request;
	}

	/**
	 * Register a Route in the router
	 * 
	 * @param Route
	 * @return Router
	 */
	public function registerRoute(Route $route)
	{
		$this->_routes[$route->name] = $route;

		return $this;
	}

	/**
	 * Get registered routes
	 * 
	 * @return array
	 */
	public function getRoutes()
	{
		return $this->_routes;
	}

	public function dispatch() 
	{
		throw new Exception('The dispatch() method must be implemented in child router!');
	}

}
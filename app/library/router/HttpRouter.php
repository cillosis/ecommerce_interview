<?php

namespace App\Library\Router;

/**
 * HTTP Request Router
 * 
 * Defines an HTTP specific router.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Request\Request;
use App\Library\Response\Response;
use App\Library\Response\HttpResponse;
use App\Library\Router\Router;
use App\Library\Router\Route;
use App\Library\Utility\Factory;
use App\Library\View\View;

class HttpRouter extends Router 
{
	/**
	 * Send request to controller
	 * 
	 * @return Response
	 */
	public function dispatch()
	{
		$request = $this->request;

		foreach ($this->getRoutes() as $route) {

			if ($request->matches($route)) {

				// Load controller
				$controller = Factory::make('App\\Controllers\\'.$route->controller, [
					'request' => $request,
				]);

				// Call controller method
				$response = $controller->{$route->method}($request);

				// If response is not a response object, formulate a new one
				if ( ! $response instanceof Response) {

					// Coerce response if it is a View
					if ($response instanceof View) {
						$view = $response;
						$response = new HttpResponse($request, $view);
					}
					// Coerce response if it is a string
					elseif (is_string($response)) {
						$view = (new View())->setContent($response);
						$response = new HttpResponse($request, $view);
					}
					else {
						$response = new HttpResponse($request, new View());
					}

				}

				return $response;

				// We found the matching route and dispatched it. Exit the loop
				break;

			}

		}

		return false;
	}

}
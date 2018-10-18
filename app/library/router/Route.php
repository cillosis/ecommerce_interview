<?php

namespace App\Library\Router;

/**
 * Base Route
 * 
 * Defines a base route data object for the Router to use
 * in dispatching requests.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

class Route
{
	/**
	 * Route Attributes
	 */
	public $url 		= null;
	public $controller 	= null;
	public $method 		= null;
	public $name 		= null;

	/**
	 * Route Factory
	 * 
	 * Generate a new route instance
	 * 
	 * @param string 	Name of route
	 */
	public static function make($name = null)
	{
		$instance = new static();
		$instance->name($name);

		return $instance;
	}

	/**
	 * Set the route URL
	 * 
	 * @param 	string
	 * @return 	Route
	 */
	public function url($url)
	{
		$this->url = '/'.$this->trimTrailing($url);

		return $this;
	}

	/**
	 * Set the route controller
	 * 
	 * @param 	string
	 * @return 	Route
	 */
	public function controller($controller)
	{
		$this->controller = $this->trimTrailing($controller);

		return $this;
	}

	/**
	 * Set the route controller method
	 * 
	 * @param 	string
	 * @return 	Route
	 */
	public function method($method)
	{
		$this->method = trim($method);

		return $this;
	}

	/**
	 * Set the route name
	 * 
	 * @param 	string
	 * @return 	Route
	 */
	public function name($name)
	{
		$this->name = $this->trimTrailing($name);

		return $this;
	}

	/**
	 * Validate the route
	 * 
	 * @return bool|Exception
	 */
	public function validate()
	{
		if (empty($this->url)) {
			throw new Exception('Route missing URL!');
		}

		if (empty($this->controller)) {
			throw new Exception('Route missing Controller!');
		}

		if (empty($this->name)) {
			throw new Exception('Route missing Name!');
		}

		return true;
	}

	/**
	 * Register route in router
	 */
	public function register()
	{
		app('router')->registerRoute($this);
	}

	/**
	 * Trim Trailing 
	 * 
	 * Filter parameters and trim slashes and spaces from ends
	 * 
	 * @param string
	 * @return string
	 */
	private function trimTrailing($value)
	{
		$value = trim($value, '/');
		$value = trim($value, '\\');
		$value = trim($value);

		return $value;
	}
}
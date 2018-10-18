<?php

namespace App\Library\Request;

/**
 * Base Request Interface
 * 
 * Defines a base request handler that can be extended to
 * create HTTP and CLI specific implementations.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Router\Route;

interface RequestInterface
{
	public function __construct($args);

	/**
	 * Retrieve a $_GET variable
	 * 
	 * @param string 	Key in $_GET superglobal
	 * @return mixed
	 */
	public function get($key);

	/**
	 * Retrieve a $_POST variable
	 * 
	 * @param string 	Key in $_POST superglobal
	 * @return mixed
	 */
	public function post($key);

	/**
	 * Retrieve a $_SERVER variable
	 * 
	 * @param string 	Key in $_SERVER superglobal
	 * @return mixed
	 */
	public function server($key);

	/**
	 * Retrieve a $_FILES variable
	 * 
	 * @param string 	Key in $_FILES superglobal
	 * @return mixed
	 */
	public function files($key);

	/**
	 * Retrieve a $_ENV variable
	 * 
	 * @param string 	Key in $_ENV superglobal
	 * @return mixed
	 */
	public function env($key);

	/**
	 * Retrieve a $_SESSION variable
	 * 
	 * @param string 	Key in $_SESSION superglobal
	 * @return mixed
	 */
	public function session($key);

	/**
	 * Retrieve a $_COOKIE variable
	 * 
	 * @param string 	Key in $_COOKIE superglobal
	 * @return mixed
	 */
	public function cookie($key);

	/**
	 * Determine if Request matches Route
	 * 
	 * @param Route 
	 * @return bool
	 */
	public function matches(Route $route);
}
<?php

namespace App\Library\Request;

/**
 * Base Request
 * 
 * Defines a base request handler that can be extended to
 * create HTTP and CLI specific implementations.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Router\Route;

class Request implements RequestInterface
{
	/**
	 * Initialize request
	 * 
	 * Store cached copies of request values
	 * within object.
	 */
	public function __construct($args = [])
	{
		$this->_get 	= $_GET;
		$this->_post 	= $_POST;
		$this->_server 	= $_SERVER;
		$this->_files 	= $_FILES;
		$this->_env 	= $_ENV;
		$this->_session = $_SESSION;
		$this->_cookies = $_COOKIE;
	}

	/**
	 * Retrieve a $_GET variable
	 * 
	 * @param string 	Key in $_GET superglobal
	 * @return mixed
	 */
	public function get($key)
	{
		if (isset($this->_get[$key])) {
			return $this->_get[$key];
		}
	}

	/**
	 * Retrieve a $_POST variable
	 * 
	 * @param string 	Key in $_POST superglobal
	 * @return mixed
	 */
	public function post($key)
	{
		if (isset($this->_post[$key])) {
			return $this->_post[$key];
		}
	}

	/**
	 * Retrieve a $_SERVER variable
	 * 
	 * @param string 	Key in $_SERVER superglobal
	 * @return mixed
	 */
	public function server($key)
	{
		if (isset($this->_server[$key])) {
			return $this->_server[$key];
		}
	}

	/**
	 * Retrieve a $_FILES variable
	 * 
	 * @param string 	Key in $_FILES superglobal
	 * @return mixed
	 */
	public function files($key)
	{
		if (isset($this->_files[$key])) {
			return $this->_files[$key];
		}
	}

	/**
	 * Retrieve a $_ENV variable
	 * 
	 * @param string 	Key in $_ENV superglobal
	 * @return mixed
	 */
	public function env($key)
	{
		if (isset($this->_env[$key])) {
			return $this->_env[$key];
		}
	}

	/**
	 * Retrieve a $_SESSION variable
	 * 
	 * @param string 	Key in $_SESSION superglobal
	 * @return mixed
	 */
	public function session($key)
	{
		if (isset($this->_session[$key])) {
			return$this->_session[$key];
		}
	}

	/**
	 * Retrieve a $_COOKIE variable
	 * 
	 * @param string 	Key in $_COOKIE superglobal
	 * @return mixed
	 */
	public function cookie($key)
	{
		if (isset($this->_cookies[$key])) {
			return$this->_cookies[$key];
		}
	}

	/**
	 * Determine if Request matches Route
	 * 
	 * @param Route 
	 * @return bool
	 */
	public function matches(Route $route)
	{
		// Implement in child class
	}
}
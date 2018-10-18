<?php

namespace App\Library\Config;

/**
 * Base Config
 * 
 * Defines a base config handler for holding app
 * configuration and utilities.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

class Config implements ConfigInterface
{
	/**
	 * Configuration arguments used by concrete implementation.
	 * 
	 * @var mixed
	 */
	private $_args = null;

	/**
	 * Configuration data stored as key/value pairs
	 * 
	 * @var mixed
	 */
	private $_config = [];

	/**
	 * Initialize config
	 * 
	 * @param mixed 	Accepts various input depending on concrete implementation.
	 */
	public function __construct($args) 
	{
		$this->_args = $args;
	}

	/**
	 * Get a configuration value
	 * 
	 * @param string 	Key to access the config value
	 * @return mixed
	 */
	public function get($key)
	{
		if (isset($this->_config[$key])) {
			return $this->_config[$key];
		}

		return null;
	}

	/**
	 * Set a configuration value
	 * 
	 * @param string 	Key to store the config value
	 * @param mixed 	Value to store
	 * @return Config 	Return self for method chaining
	 */
	public function set($key, $value)
	{
		if ( ! empty($key)) {
			$this->_config[$key] = $value;	
		}
		
	}

	public function parse($data)
	{

	}
}
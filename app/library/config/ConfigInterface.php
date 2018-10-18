<?php

namespace App\Library\Config;

/**
 * Base Config Interface
 * 
 * Defines a base config handler for holding app
 * configuration and utilities.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

interface ConfigInterface
{
	public function __construct($args);

	public function get($key);

	public function set($key, $value);

	/**
	 * Parse configuration
	 * 
	 * @param mixed
	 */
	public function parse($data);
}
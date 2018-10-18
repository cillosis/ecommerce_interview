<?php

namespace App\Library\Database;

/**
 * Base Database Connector
 * 
 * Defines a base database implementation.
 * 
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use Exception;
use App\Library\Config\Config;

class Database
{
	/**
	 * Database configuration
	 * @var Config
	 */
	private $_config;

	/**
	 * Initialize database object with configuration data
	 * 
	 * @param Config 	
	 */
	public function __construct(Config $config)
	{
		$this->_config = $config;
	}
}
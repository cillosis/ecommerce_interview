<?php

namespace App\Library\Config;

/**
 * .INI File Configuration
 * 
 * Defines a config handler for .INI file based storage. Expects
 * a data source in the constructor.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use Exception;

final class IniConfig extends Config
{
	/**
	 * Initialize config
	 */
	public function __construct($args)
	{
		parent::__construct($args);

		if (is_string($args) && ! empty($args)) {
			$args = [
				'path' => $args,
			];
		}

		$path = isset($args['path']) ? trim($args['path']) : null;

		if ( ! file_exists($path)) {
			throw new Exception('IniConfig expects valid config file at: ' . $path);
		}

		// Parse config
		$this->parse($path);

		// Return self for method chaining
		return $this;
	}

	/**
	 * Open config file and parse values
	 *
	 * @param string 		Absolute file path
	 * @return IniConfig 	Returns self for method chaining.
	 */
	public function parse($file)
	{
		$data = parse_ini_file($file);
		
		if (is_array($data) && ! empty($data)) {
			foreach ($data as $key => $value) {
				$this->set($key, $value);
			}
		}
	}
}
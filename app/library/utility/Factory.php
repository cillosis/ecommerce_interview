<?php

namespace App\Library\Utility;

/**
 * Object Factory
 * 
 * Creates and stores new object instances.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use Exception;
use ReflectionClass;

class Factory
{
	/**
	 * Shared instances (singleton)
	 * 
	 * @var array
	 */
	private static $_shared = [];

	/**
	 * Make a new class instance
	 * 
	 * @param string 	
	 * @param string 	Class name in dot or namespace notation
	 * @param string 	Array of arguments to class
	 * @return mixed
	 */
	public static function make($class, array $args = [])
	{
		$key = self::classToKey($class);
		$class = self::classToInstantiable($class);

		if (class_exists($class)) {
			$reflection = new ReflectionClass($class);
			self::$_shared[$key] = $reflection->newInstance(...array_values($args));
		} else {
			throw new Exception('Class does not exist: ' . $class);
		}

		return self::$_shared[$key];
	}

	/**
	 * Get shared instance of class. If does not exist, create
	 * a new instance.
	 * 
	 * @param string 	Class name in dot or namespace notation
	 * @return mixed
	 */
	public static function get($class, array $args = [])
	{
		// Cleanup parameters
		$key = self::classToKey($class);

		// Make shared instance if not already instantiated
		if ( ! isset(self::$_shared[$key])) {
			$class = self::classToInstantiable($class);
			return self::make($class, $args);
		}

		return self::$_shared[$key];
	}

	/**
	 * Convert class name to instantiable format
	 * 
	 * @param string 	Name of class in dot or namespace notation
	 * @return string
	 */
	private static function classToInstantiable($class)
	{
		if (stristr($class, '.')) {
			$class = str_replace('.', '\\', $class);
		}

		return trim($class);
	}

	/**
	 * Convert class name to array key format
	 * 
	 * @param string 	Name of class in dot or namespace notation
	 * @return string
	 */
	private static function classToKey($class)
	{
		if (stristr($class, '\\')) {
			$key = str_replace('\\', '.', $class);
		} else {
			$key = $class;
		}

		return trim(strtolower($key));
	}
}
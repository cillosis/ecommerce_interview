<?php

namespace App\Library\Model;

/**
 * Base Model
 * 
 * Defines a base model for representing an object from the
 * database. This is a simple implementation of an ORM system.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use PDO;
use Exception;
use App\Library\Database\Database;

class Model
{
	/**
	 * Database instance
	 * @var Database
	 */
	private $_db;

	/**
	 * Model attributes
	 * @var array
	 */
	private $_attributes = [];

	/**
	 * Table name
	 * @var string
	 */
	public $table = null;

	/**
	 * Initialize model with reference to database
	 * 
	 * @param array 	Optional model instance attributes
	 */
	public function __construct($attributes = [])
	{
		// Grab database service instance
		$this->_db = app('db');

		// Force model to set table name
		if (empty(trim($this->table))) {
			throw new Exception('Table name must be set in model!');
		}

		// Set attributes
		if (is_array($attributes) && ! empty($attributes)) {
			foreach ($attributes as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	/**
	 * Model attribute setter
	 * 
	 * @param string 	Key of attribute
	 * @param string 	Value of attribute
	 * @return Model
	 */
	public function __set($key, $value)
	{
		$this->_attributes[$key] = $value;
	}

	/**
	 * Model attribute getter
	 * 
	 * @param string 	Key of attribute
	 * @return Model
	 */
	public function __get($key)
	{
		return isset($this->_attributes[$key]) ? $this->_attributes[$key] : null;
	}

	/**
	 * Model attribute index set test
	 * 
	 * @param string 	Key of attribute
	 * @param string 	Value of attribute
	 * @return Model
	 */
	public function __isset($key)
	{
		return isset($this->_attributes[$key]) ? true : false;
	}

	/**
	 * Make new instance of model
	 * 
	 * @return Model
	 */
	public static function instance()
	{
		return new static();
	}

	/**
	 * Get all records in table
	 * 
	 * @return array
	 */
	public static function all()
	{
		$results = [];
		$instance = self::instance();
		$query = "SELECT * FROM ".$instance->table;
		$statement = $instance->_db->query($query);

		while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
			$childModel = get_called_class();
			$results[] = new $childModel($result);
		}

		return $results;
	}
}
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

use PDO;
use Exception;
use PDOException;
use App\Library\Config\Config;

class MysqlDatabase extends Database 
{
	/**
	 * PDO Connection instance
	 * @var PDO
	 */
	private $_pdo;

	/**
	 * Initialize database object with configuration data
	 * 
	 * @param Config 	
	 */
	public function __construct(Config $config)
	{
		parent::__construct($config);

		$host = $config->get("DB_HOST");
		$name = $config->get("DB_NAME");
		$user = $config->get("DB_USERNAME");
		$pass = $config->get("DB_PASSWORD");

		$dsn = "mysql:dbname=$name;host=$host";

		$this->_pdo = new PDO($dsn, $user, $pass);
	}

	/**
	 * Parameterized Query
	 * 
	 * Run a parameterized query and return the statement so the model can determine
	 * what to do with the results.
	 * 
	 * @param string 			The SQL query
	 * @param array 			The parameter values
	 * @return PDOStatement
	 */
	public function query($query, $params = [])
	{
		$statement = $this->_pdo->prepare($query);
		$statement->execute($params);

		return $statement;
	}
}
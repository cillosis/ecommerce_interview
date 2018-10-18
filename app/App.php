<?php

namespace App;

/**
 * Root Application
 * 
 * Operates as the "front controller" and handles high
 * level MVC functionality.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use Exception;
use App\Library\Router;
use App\Library\Route;
use App\Library\Config;
use App\Library\Request;
use App\Library\Response;
use App\Library\Utility\Factory;

class App
{
	/**
	 * Bootstrap Config
	 * 
	 * Configurable values required to initialize app
	 * 
	 * @var array
	 */
	protected $_bootstrap = [];

	/**
	 * Registered Service Objects
	 * 
	 * Store service objects registered with app.
	 * 
	 * @var array
	 */
	private $_services = [];

	/**
	 * Initialize App config
	 */
	public function __construct()
	{
		// Localized configuration. You may modify these values as desired.
		$this->_bootstrap = [
			'app.config.path' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.ini',
			'app.routes.web' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'web.php',
			'app.routes.cli' => dirname(__FILE__) . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'cli.php',
		];
	}

	/**
	 * Run web application
	 * 
	 * This is the main entry point to the web application. It is called
	 * from the index.php file at the root of the public directory.
	 */
	public function run()
	{
		// Preload libraries and setup app to handle request
		$this->load();

		// Dispatch request
		$this->dispatch();
	}

	/**
	 * Load web application
	 * 
	 * Handles the initial loading of micro-framework
	 * resources.
	 */
	public function load()
	{
		// Load Services
		$this->loadSession();
		$this->loadConfig();
		$this->loadRequest();
		$this->loadRouter();
		$this->loadDatabase();
	}

	/**
	 * Load Config Service
	 * 
	 * @return App 		Return self instance for method chaining
	 */
	private function loadConfig()
	{
		// Format path
		$configPath = $this->getBootstrapParameter('app.config.path');

		// Handle service registration (will auto init)
		$this->registerService('config', 'App.Library.Config.IniConfig', ['path' => $configPath]);

		return $this;
	}

	/**
	 * Load Request Service
	 * 
	 * @return App 		Return self instance for method chaining
	 */
	private function loadRequest()
	{
		// Handle service registration (will auto init)
		$this->registerService('request', 'App.Library.Request.HttpRequest');

		return $this;
	}

	/**
	 * Load Router Service
	 * 
	 * @return App 		Return self instance for method chaining
	 */
	private function loadRouter()
	{
		// Handle service registration (will auto init)
		$this->registerService('router', 'App.Library.Router.HttpRouter', [
			'request' => app('request'),
		]);

		// Load appropriate route file and register routes
		$this->loadRoutes();

		return $this;
	}

	/**
	 * Load Routes
	 * 
	 * Routes are broken into multiple files to isolate web and CLI actions
	 * 
	 * @return App 		Return self instance for method chaining
	 */
	public function loadRoutes()
	{
		// If request is cli then load those routes, otherwise use web routes
		if (php_sapi_name() == 'cli') {
			require_once($this->getBootstrapParameter('app.routes.cli'));
		} else {
			require_once($this->getBootstrapParameter('app.routes.web'));
		}
	}

	/**
	 * Load Session Service
	 * 
	 * @return App 		Return self instance for method chaining
	 */
	private function loadSession()
	{
		// Handle service registration (will auto init)
		//$this->registerService('session', 'App.Library.Session.HttpSession');
		session_start();
		return $this;
	}

	/**
	 * Load Database Service
	 * 
	 * @return App 		Return self instance for method chaining
	 */
	private function loadDatabase()
	{
		switch (app('config')->get('DB_CONNECTOR')) {
			case 'mysql':
				// Handle service registration (will auto init)
				$this->registerService('db', 'App.Library.Database.MySqlDatabase', [app('config')]);	
				break;
			default:
				throw new Exception('Database connector not defined in configuration file!');
		}
		

		return $this;
	}

	/**
	 * Get bootstrap parameter
	 * 
	 * Some parameters must be defined prior to the config loading
	 * 
	 * @param string 	Key to access parameter
	 * @return string
	 */
	public function getBootstrapParameter($key)
	{
		return $this->_bootstrap[$key];
	}

	/**
	 * Dispatch requests based on routing
	 */
	private function dispatch()
	{
		// Get routing service
		$router = $this->getService('router');

		// Dispatch route
		$response = $router->dispatch();

		// Render response
		$response->render();
	}

	/**
	 * Register a service
	 * 
	 * @param string 	Name of service
	 * @return App 		Return self for method chaining
	 */
	public function registerService($name, $class, $args = [])
	{
		$this->_services[$name] = Factory::get($class, $args);

		return $this;
	}

	/**
	 * Get a registered service
	 * 
	 * @param string 	Name of service
	 * @return mixed 	Service instance
	 */
	public function getService($name)
	{
		return $this->_services[$name];
	}
}
<?php

namespace App\Library\View;

/**
 * Base View
 * 
 * Defines a base view handler that provides templating and
 * UI content functionality.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

class View
{
	/**
	 * View content
	 *
	 * @var string
	 */
	private $_content = '';

	/**
	 * View data
	 *
	 * @var array
	 */
	private $_data = [];

	/**
	 * Initialize view using view name
	 * 
	 * @param string 	Dot notation name of view
	 * @param string 	Optional view data
	 */
	public function __construct($name = null, $data = [])
	{
		$this->_data = $data;

		if (is_string($name) && ! empty($name)) {

			$path = str_replace('.', DIRECTORY_SEPARATOR, $name);
			$path = realpath(__DIR__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$path.'.php';

			if (file_exists($path) && is_readable($path)) {
				return $this->setContent(file_get_contents($path), $data);
			}

		}
	}

	/**
	 * View factory
	 * 
	 * Easier creation of new view instances
	 *
	 * @param string 	Optional view data
	 * @param string 	Dot notation name of view
	 * @return View
	 */
	public static function make($name = null, $data = [])
	{
		return new static($name, $data);
	}

	/**
	 * Set the view content manually
	 * 
	 * @param string 	String content
	 * @param array 	Optional associative array of template data
	 * @return View 	Returns self for method chaining
	 */
	public function setContent($content, $data = [])
	{
		// Set content
		$this->_content = (string) $content;

		// Set data
		$this->_data = $data;

		// Apply templating engine
		$this->renderTemplate();

		return $this;
	}

	/**
	 * Get the content
	 * 
	 * @return string
	 */
	public function getContent()
	{
		return $this->_content;
	}

	/**
	 * Get the data
	 * 
	 * @return array
	 */
	public function getData()
	{
		return (array) $this->_data;
	}

	/**
	 * Render view templating
	 */
	public function renderTemplate()
	{
		$this->templateStringLiterals();
		$this->templateIncludeViews();
	}

	/**
	 * Template: String Literals
	 * 
	 * @return string
	 */
	private function templateStringLiterals()
	{
		$this->_content = str_replace("{{ ", "<?php echo(\"", $this->_content);
		$this->_content = str_replace("{{", "<?php echo(\"", $this->_content);
		$this->_content = str_replace(" }}", "\"); ?>", $this->_content);
		$this->_content = str_replace("}}", "\"); ?>", $this->_content);
	}

	/**
	 * Template: Include Views
	 * 
	 * @return string
	 */
	private function templateIncludeViews()
	{
		
		$this->_content = preg_replace("/@include\(\'(.*)\'\)/i", "<?php require(view_path('$1')); ?>", $this->_content);
	}
}
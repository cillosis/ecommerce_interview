<?php

namespace App\Library\Response;

/**
 * Base Response
 * 
 * Defines a base response handler that can be extended to
 * create HTML, JSON, etc. as output.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Request\Request;
use App\Library\View\View;

class Response
{
	/**
	 * View object
	 */
	private $_view;


	public function __construct(Request $request, View $view)
	{
		$this->_request = $request;
		$this->_view 	= $view;
	}

	public function render() 
	{
		echo "Invalid Response Class";
	}

	/** 
	 * Get the view
	 * 
	 * @return View
	 */
	public function view()
	{
		return $this->_view;
	}
}
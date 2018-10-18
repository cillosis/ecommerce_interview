<?php

namespace App\Library\Response;

/**
 * Http Web Response
 * 
 * Defines a web response handler for HTML, JSON, XML, etc.
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 *******************************************************/

use App\Library\Request\Request;
use App\Library\View\View;

class HttpResponse extends Response
{
	
	public function render()
	{
		// Get the content. This content will have already
		// been sent through the template engine
		$content = $this->view()->getContent();

		// Set any HTTP headers

		// Execute the view and render the output
		extract($this->view()->getData());
		ob_start();
		eval(' ?>'.$content.' <?php ');
		$output = ob_get_clean();
		echo($output);
	}

	public function __toString()
	{
		return (string) $this->view()->getContent();
	}
}
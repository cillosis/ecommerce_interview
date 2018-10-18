<?php

//namespace App;

/**
 * Global utility functions to improve code readability
 *
 * @author 	Jeremy Harris
 * @since 	10/9/2018
 **************************************************************/

/**
 * Get global app instance or singleton service registered with
 * within app factory.
 * 
 * @param string
 * @return mixed
 */
function app($service = null)
{
	global $app;

	// If no service provided, return global app instance
	if (empty($service)) {
		return $app;
	}

	// If service provided, get service instance from app
	return $app->getService($service);
}

/**
 * Common Service Quick Accessors
 */
function request()
{
	return app('request');
}
function config()
{
	return app('config');
}
function router()
{
	return app('router');
}
function session()
{
	return app('session');
}
function db()
{
	return app('database');
}

/**
 * Common Path Quick Accessors
 */
function base_path()
{
	return realpath(dirname(dirname(dirname(__DIR__)))).DIRECTORY_SEPARATOR;
}
function public_path()
{
	return base_path().'public'.DIRECTORY_SEPARATOR;
}
function app_path()
{
	return base_path().'app'.DIRECTORY_SEPARATOR;
}
function view_path($view = null)
{
	$path = app_path().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR;

	// If a dot notation view passed, then resolve full path
	if ( ! empty($view) && stristr($view, '.')) {
		$path .= str_replace('.', DIRECTORY_SEPARATOR, $view);
		$path .= '.php';
	}

	return $path;
}

/**
 * Common Debug Functions
 */
function dd($value)
{
	// Dump and die
	var_dump($value);
	exit;
}
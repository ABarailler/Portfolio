<?php
namespace My;

class Request
{
	/*
	 * $url string HTTP request URI 
	*/
	private $url;
	/*
	 * $method string HTTP request method (GET|POST|PUT|DELETE) 
	*/
	private $method;
	/*
	 * $headers array  HTTP request headers
	*/
	private $headers = array();
	/*
	 * $params array HTTP request params (GET or POST data)
	*/
	private $params = array();
	/*
	 *	$route string Internal route
	 */
	private $route;

	public function __construct()
	{
		$this->url = $_SERVER['REQUEST_URI'];
		$this->method = $_SERVER['REQUEST_METHOD'];
		if (function_exists('apache_request_headers')) {
			$this->headers = apache_request_headers();
		} else {
			$this->headers = false;
		}
		$this->params = $_REQUEST;
	}

	/*
	 * @return $url string HTTP request URI
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/*
	 *	@param $url string HTTP request URI
	 */
	public function setUrl($url)
	{
		$this->url = $url;
		return $this; // pour création de l'interface fluide (fluent) qui permet l'enchainement des appels
	}

	/*
	 * @return $method string HTTP request method
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/*
	 *	@param $method string HTTP request method
	 */
	public function setMethod($method)
	{
		$this->method = $method;
		return $this;
	}

	/*
	 * @return $headers array HTTP request headers
	 */
	public function getHeaders()
	{
		return $this->headers;
	}

	/*
	 *	@param $headers array HTTP request headers
	 */
	public function setHeaders($headers)
	{
		$this->headers = $headers;
		return $this;
	} 

	public function isPost()
	{
		return ($this->method === 'POST');
	}
	/*
	 * @return $params array HTTP request params
	 */
	public function getParams()
	{
		return $this->params;
	}


	/*
	 *	@param $params array HTTP request params
	 */
	public function setParams($params)
	{
		$this->params = $params;
		return $this;
	}

	/*
	 * @return $route string Internal route
	 */
	public function getRoute()
	{
		return $this->route;
	}

	/*
	 *	@param $route string Internal route
	 */
	public function setRoute($route)
	{
		$this->route = $route;
		return $this;
	}

}
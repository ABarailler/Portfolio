<?php
namespace My;

class Response 
{
	/*
	 * $headers array HTTP response headers
	 */
	private $headers = array();
	/*
	 * $body string HTTP response body
	 */
	private $body;
	/*
	 *	$httpResponseCode integer HTTP status code 
	 */
	private $httpResponseCode = 200;
	/*
	 * $httpCodes array List of HTTP status codes
	 */
	private static $httpCodes = array(
		200 => 'OK',
		301 => 'Moved Permanently',
		403 => 'Forbidden',
		404 => 'Not Found',
		500 => 'Internal Server Error'
	);

	// Getters & setters
	public function getHeaders()
	{
		return $this->headers;
	}

	public function setHeaders(Array $headers)
	{
		$this->headers = $headers;
		return $this;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function setBody($body)
	{
		$this->body = $body;
		return $this;
	}

	public function getHttpResponseCode()
	{
		return $this->httpResponseCode;
	}

	public function setHttpResponseCode($httpResponseCode)
	{
		if (!isset(self::$httpCodes[$httpResponseCode])) {
			throw new \Exception('Code HTTP invalide'); // Lever une exception = déclencher une erreur objet
		}
		$this->httpResponseCode = $httpResponseCode;
		return $this;
	}

	public static function getHttpMessage($httpResponseCode) 
	{
		if (!isset(self::$httpCodes[$httpResponseCode])) {
			throw new \Exception('Code HTTP invalide'); // Lever une exception = déclencher une erreur objet
		}
		return self::$httpCodes[$httpResponseCode];
	}

	public function send()
	{
		header("HTTP/1.1 {$this->httpResponseCode} " . self::$httpCodes[$this->httpResponseCode]);

		foreach($this->headers as $header) {
			header($header);
		}

		echo $this->body;
	}
}

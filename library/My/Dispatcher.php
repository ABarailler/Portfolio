<?php
namespace My;

class Dispatcher 
{
	/*
	 * @var $request \My\Request 
	 */
	private $request;
	/*
	 * @var $response \My\Response 
	 */
	private $response;


	public function __construct(\My\Request $request, \My\Response $response) 
	{
		$this->request = $request;
		$this->response = $response;
	}

	/*
	 *
	 */
	public function dispatch()
	{
		$controllerFile = ROOT_PATH . '/application/Controllers/' . ucfirst($this->request->getRoute()) . '.php';
		$controllerClass = '\App\Controllers\\' . ucfirst($this->request->getRoute());

		if (!file_exists($controllerFile)) {
			$this->request->setRoute('error');
			$this->response->setHttpResponseCode(404);
			$controllerClass = '\App\Controllers\Error';
		}

		$controller = new $controllerClass($this->request, $this->response); // Instanciation dynamique
		$controller->run();

	}
}
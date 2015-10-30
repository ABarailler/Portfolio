<?php

namespace My;

abstract class Controller implements \My\ControllerInterface {

	/*
	 * @var $request \My\Request 
	 */
	protected $request;
	/*
	 * @var $response \My\Response 
	 */
	protected $response;
	/*
	 * @var $view \My\View 
	 */
	protected $view;
	/*
	 * @var $layout \My\Layout 
	 */
	protected $layout;

	private $renderView = true;

	public function __construct(\My\Request $request, \My\Response $response) 
	{
		$this->request = $request;
		$this->response = $response;
		$this->view = new \My\View($request);
		$this->layout = new \My\Layout($this->view); 

	}

	public function run()
	{
		$this->action();

		if ($this->renderView) {
			$this->view->render();
			$this->layout->render();
			$this->response->setBody($this->layout->getContent());
		} else {
			$this->response->setBody('');
		}

	}

	public function disableViewRender()
	{
		$this->renderView = false;
		return $this;
	}
}
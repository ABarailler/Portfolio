<?php

namespace My;

class View
{
	private $request;
	private $file;
	private $content;
	private $ext = 'phtml';

	public function __construct(\My\Request $request) 
	{
		$this->request = $request;
		$this->file = VIEW_PATH . $request->getRoute() . '.' . $this->ext;
	}

	public function render()
	{
		ob_start();
			require_once $this->file;
		$this->content = ob_get_clean();
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setExt($ext)
	{
		$this->ext =  (string) $ext;
		return $this;
	}
}
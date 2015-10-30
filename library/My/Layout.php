<?php

namespace My;

class Layout
{
	private $view;
	private $file;
	private $content;
	private $layout = 'layout';
	private $ext = 'phtml';
	private $enable = true;

	public function __construct(\My\View $view)
	{
		$this->view = $view;
		$this->file = LAYOUT_PATH . $this->layout . '.' . $this->ext;
	}

	public function render()
	{
		if ($this->enable) {
			ob_start();
			require_once $this->file;
			$this->content = ob_get_clean();
		} else {
			$this->content = $this->view->getContent();
		}
	}

	public function disable()
	{
		$this->enable = false;
		return $this;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setLayout($layout)
	{
		$this->layout =  (string) $layout;
		$this->file = LAYOUT_PATH . $this->layout . '.' . $this->ext;
		return $this;
	}

	public function setExt($ext)
	{
		$this->ext =  (string) $ext;
		return $this;
	}
}
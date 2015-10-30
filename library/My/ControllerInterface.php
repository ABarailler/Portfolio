<?php

namespace My;

interface ControllerInterface
{
	public function __construct(\My\Request $request, \My\Response $response);
	public function run();
	public function action();
}
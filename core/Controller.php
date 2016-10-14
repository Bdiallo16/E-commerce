<?php

	abstract class Controller
	{
		protected $viewData = [];

		protected function generateView($viewPath, $templatePath = 'default.phtml')
		{
			$view = new View($viewPath, $this->viewData, $templatePath);

			$view->generate();
		}
	}
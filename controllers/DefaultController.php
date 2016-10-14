<?php

	class DefaultController extends Controller
	{
		public function defaultAction()
		{
			$this->generateView('example.phtml');
		}
	}
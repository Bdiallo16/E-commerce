<?php

	header('Content-Type: text/html; charset=utf-8');

	//	Définition des racines
	define('SERVER_ROOT', __DIR__.'/');
	define('CLIENT_ROOT', str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', SERVER_ROOT)));

	//	Préparation de l'autochargement des classes
	spl_autoload_register(function($className)
	{
		//	Si le fichier correspondant à la classe demandée existe dans le dossier « core »
		if(file_exists(SERVER_ROOT.'core/'.$className.'.php'))
		{
			//	Inclusion de la classe demandée
			include SERVER_ROOT.'core/'.$className.'.php';
		}
		//	Sinon, si le fichier correspondant à la classe demandée existe dans le dossier « controllers »
		else if(file_exists(SERVER_ROOT.'controllers/'.$className.'.php'))
		{
			//	Inclusion de la classe demandée
			include SERVER_ROOT.'controllers/'.$className.'.php';
		}
		//	Sinon, si le fichier correspondant à la classe demandée existe dans le dossier « models »
		else if(file_exists(SERVER_ROOT.'models/'.$className.'.php'))
		{
			//	Inclusion de la classe demandée
			include SERVER_ROOT.'models/'.$className.'.php';
		}
	});

	try
	{
		if(array_key_exists('controller', $_GET))
		{
			//	Définition du nom du contrôleur
			$controllerName = ucfirst($_GET['controller']).'Controller';

			//	Si le contrôleur demandé existe
			if(class_exists($controllerName))
			{
				if(array_key_exists('action', $_GET))
				{
					//	Instanciation du contrôleur demandé
					$controller = new $controllerName();

					//	Définition du nom de l'action
					$actionName = $_GET['action'].'Action';

					//	Si l'action demandée existe
					if(is_callable([$controller, $actionName]))
					{
						//	Exécution de l'action demandée
						$controller->$actionName();
					}
					//	Si l'action demandée n'existe pas
					else
					{
						throw new Exception('L\'action <strong>'.$actionName.'</strong> n\'existe pas dans le contrôleur <strong>'.$controllerName.'</strong> ou ne peut être appelée !');
					}
				}
				else
				{
					throw new Exception('Aucune action n\'est fournie !');
				}
			}
			//	Si le contrôleur demandé n'existe pas
			else
			{
				throw new Exception('Le contrôleur <strong>'.$controllerName.'</strong> n\'existe pas !');
			}
		}
		else
		{
			throw new Exception('Aucun contrôleur n\'est fourni !');
		}
	}
	catch(Exception $exception)
	{
		echo '<h1>Erreur</h1>';
		echo '<h2>Message</h2>';
		echo $exception->getMessage();
		echo '<h2>Fichier et ligne</h2>';
		echo '<em>'.$exception->getFile().' : '.$exception->getLine().'</em>';
		echo '<h2>Informations complémentaires</h2>';
		var_dump($exception->getTrace());
	}
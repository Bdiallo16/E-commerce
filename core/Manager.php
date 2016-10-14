<?php

	abstract class Manager
	{
		const DSN = 'mysql:host=localhost;dbname=???;charset=utf8';
		const USER_NAME = 'root';
		const PASSWORD = '';

		private static $PDOInstance;

		protected function getDBConnection()
		{
			if(self::$PDOInstance === null)
			{
				self::$PDOInstance = new PDO
				(
					self::DSN,
					self::USER_NAME,
					self::PASSWORD,
					[
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
					]
				);
			}

			return self::$PDOInstance;
		}
	}
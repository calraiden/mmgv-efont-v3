<?php
return array (
		'db' => array (
				'adapters' => array (
						'Adapter' => array (
								'driver' => 'Pdo',
								'dsn' => 'mysql:dbname=db_name_alterar;host=localhost',
								'username' => 'db_user',
								'password' => 'db_password',
								'driver_options' => array (
										PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' 
								) 
						), 
				) 
		),
		'service_manager' => array (
				'abstract_factories' => array (
						'Zend\Db\Adapter\AdapterAbstractServiceFactory' 
				) 
		) 
);

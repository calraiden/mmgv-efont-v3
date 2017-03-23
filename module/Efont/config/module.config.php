<?php
return array (
		'factories' => array (
				
				'Efont\Model\UserTable' => function ($sm) {
					$dbAdapter = $sm->get ( 'Adapter' );
					return new \Efont\Model\UserTable ( $dbAdapter );
				},
				'Efont\Model\CompanyTable' => function ($sm) {
					$dbAdapter = $sm->get ( 'Adapter' );
					return new \Efont\Model\CompanyTable ( $dbAdapter );
				} 
		) 
);
<?php
return array(
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'primaryLang' => 'id',
		'translateLangs' => array(
			'en' => 'en',
			'id' => 'id',
		),
		
		// timthumb replace url
		'timthumb_url_replace' => 0,		
		'timthumb_url_replace_website' => 'http://ommu.co',	//default http
		// access system *from product
		'product_access_system' => 'sso.bpadjogja.info',
		'server_options' => array(
			'localhost'=> array(
				//production
				'http://192.168.30.100',		//localhost (network)
				'http://localhost',				//localhost
				'http://127.0.0.1',				//localhost
				//development
				'http://192.168.3.13',			//localhost (ommu network)				
			),
			'bpad'=> array(
				//production
				'http://bpadjogja.info',		//live
				'http://103.255.15.100',		//ip static
				'http://192.168.30.100',		//localhost (network)
				'http://localhost',				//localhost
				'http://127.0.0.1',				//localhost
				//development
				'http://192.168.3.13',			//localhost (ommu network)				
			),
		),
		'oauth_server_options' => array(
			//'http://ommu.co',
			//'https://ommu.co',
			'http://localhost/_product_ommu.co',
		),
		'sso_server_options' => array(
			//'http://103.255.15.77/sso',
			'http://localhost',
			'http://192.168.3.13',
		),
		'inlis_address' => 'http://103.255.15.77',
		'inlis_sso_address' => 'http://103.255.15.77/sso',
		'Mikrotik' => array(
			'address' => '192.168.3.254',
			'port'    => '8728',
			'username' => 'wishnu',
			'password' => 'Vicko#21',
		),
	),
);
?>
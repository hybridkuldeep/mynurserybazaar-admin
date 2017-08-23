<?php
	Router::parseExtensions(); 
	CakePlugin::routes();
	require CAKE . 'Config' . DS . 'routes.php';

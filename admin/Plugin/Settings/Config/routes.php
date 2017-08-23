<?php 
	
	//Router::connect('/corporate-sponsors/*', array('plugin' => 'corporatesponsors', 'controller' => 'sponsors', 'action' => 'index'));
	   Router::connect('/app-settings/*',array('plugin' => 'settings', 'controller' => 'settings', 'action' => 'index'));
	   Router::connect('/payment-gateway-credentials/*',array('plugin' => 'settings', 'controller' => 'paymentgatewaycredentials', 'action' => 'index'));
	   Router::connect('/bad-words/*',array('plugin' => 'settings', 'controller' => 'badwords', 'action' => 'index'));
	   Router::connect('/reports-complains-from-users/*',array('plugin' => 'settings', 'controller' => 'complains', 'action' => 'index'));
	   Router::connect('/message-templates/*',array('plugin' => 'settings', 'controller' => 'messagetemplates', 'action' => 'index'));
	   Router::connect('/email-templates/*',array('plugin' => 'settings', 'controller' => 'emailtemplates', 'action' => 'index'));

<?php
/**
 * This file is part of Cms.
 * Routes configuration
 *
 * Author:  Manmohan Singh Meena <manmohan.meena@fullestop.com>
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * Copyright 2012, Gempulse Infotech Pvt. Ltd. (http://www.fullestop.com)
 *
 * @copyright Copyright 2010, Gempulse Infotech Pvt. Ltd. (http://www.fullestop.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 *
 * PHP version 5
 * CakePHP version 1.3
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, Gempulse Infotech Pvt. Ltd. (http://www.fullestop.com)
 * @link          http://www.fullestop.com
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
	
	
/**
 * Routing.prefixes admin 
 */	
	$Routingprefix = 'admin';
		
/**
 * Here, we are connecting 'admin/cms-pages/*' (base path) to plugin frontusers and controller called 'cms_pages' for Routing.prefixes admin,
 * its action called 'admin_index', and we pass a param to select the view file
 * to use (in this case, /app/plugins/frontusers/views/cms_pages/admin_index.ctp)...
 */		 
	Router::connect('/'.$Routingprefix.'/email-templates', array('plugin'=>'email','controller' => 'email_templates', 'action' => 'index',$Routingprefix => true));
	
	


